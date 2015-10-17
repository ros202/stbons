<?php

namespace App\Http\Controllers;

use Request;
use Session;
use Illuminate\Support\Facades\Redirect;

use App\Videos;

use Aws\S3\S3Client;
use Aws\Common\Credentials\Credentials;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
		$videos = Videos::orderBy('videoRating', 'DESC')->get();
		foreach($videos as $video) {
			if(!substr($video->videoThumbnail, 0, 4) == "http") {
				$video->videoThumbnail = "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/" . $video->videoThumbnail;
			}
		}
		
		return view('videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
		return view('videos.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
		if(Request::hasFile('video')) {
			$videoFile = Request::file('video');
			$fileExt = $videoFile->getExtension();
			$ext = strtolower($videoFile->getClientOriginalExtension());
			
			switch($ext) {
				case("mov"):
				case("m4v"):
				case("mp4"):						
						$video = New Videos();
						$video->videoFile = VideosController::saveFileToS3($videoFile);
						$video->videoThumbnail = VideosController::createThumbnail($videoFile);
						
						$video->title = $request::input('title');
						$video->studentName = $request::input('studentName');
						$video->className = $request::input('className');
						$video->houseName = $request::input('houseName');
						$video->videoDescription = $request::input('videoDescription');
						
						$video->save();
						
						// Large files may be rejected if apache config is configured with a low limit:
						// upload_max_filesize = 4096;
						// post_max_size = 4096;
						VideosController::slack($video->studentName . ' from ' . $video->className . ' has successfully uploaded a video called ' . $video->title . '. http://www.stbons.co.uk/video/show/' . $video->id . '/', 'StBons.co.uk', 'movie_camera');
						return Redirect::to('video/show/' . $video->id)->with('message', 'Thank you for your video!');
				break;
				default:
					return Redirect::to('video/upload/')->with('error', 'The file type "' . $videoFile->getClientOriginalExtension() . '" is not allowed');
				break;
			}
			
		} else {
			return Redirect::to('video/upload/')->with('error', 'Please choose a video to upload');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
		$video = Videos::where('id', '=', $id)->first();
		$video->voteSuffix = ($video->videoRating != 1 ? "votes": "vote");
		
		if(!substr($video->videoFile, 0, 4) == "http") {
			$video->videoFile = "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/" . $video->videoFile;
		}
		
		if(!substr($video->videoThumbnail, 0, 4) == "http") {
			$video->videoThumbnail = "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/" . $video->videoThumbnail;
		}
		
		return view('videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
	
	// Upvote video
	public function upvote($id) {
		if(Config('app.voting_on')) {
			$video = Videos::where('id', '=', $id)->first();
			$video->voteSuffix = ($video->videoRating != 1 ? "votes": "vote");
							
			if(null !== Session::get('user.votes')) {
				if(count(Session::get('user.votes')) < 2) {
				
					foreach(Session::get('user.votes') as $existingVote) {
						if($existingVote == $id) {
							// Video previously voted for
							return $video->videoRating . " " . $video->voteSuffix . " &ndash; You've already voted!";
						}
					}
					
				}
			} else {
				return $video->videoRating . " " . $video->voteSuffix . " &ndash; You've  run out of votes!";
			}
			
			// Video not previously voted for
			Videos::where('id', '=', $id)->increment('videoRating');
			Session::push('user.votes', $id);
			
			$video = Videos::where('id', '=', $id)->first();
			$video->voteSuffix = ($video->videoRating != 1 ? "votes": "vote");
			return $video->videoRating . " " . $video->voteSuffix . " &ndash; You have " . 2 - count(Session::get('user.votes')) . " left";
		}
	}
	
	public function getUploadProgress() {
		$s = $_SESSION['upload_progress_'.intval($_GET['PHP_SESSION_UPLOAD_PROGRESS'])];
		$progress = array(
			'lengthComputable' => true,
			'loaded' => $s['bytes_processed'],
			'total' => $s['content_length']
		);
		echo json_encode($progress);
	}
	
	function saveFileToS3($file) {
			$s3Client = S3Client::factory(array(
				'version' => 'latest',
				'region' => 'eu-west-1',
				'key'    => getenv('AWS_KEY'),
				'secret' => getenv('AWS_SECRET')
			));

			$result = $s3Client->putObject(array(
				'ACL' => 'public-read',
				'Bucket' => 'stbons',
				'Key' => $file->getClientOriginalName(),
				'Body' => fopen($file->getRealPath(), 'r'),
				'ContentType' => $file->getMimeType()
			));

		return "https://s3-eu-west-1.amazonaws.com/stbons/" .  urlencode($file->getClientOriginalName());
	}
	
	function createThumbnail($file) {
		$guid = uniqid();
		$file->move('/tmp', $file->getClientOriginalName());
		$return = array();
		$return[0] = '/usr/local/bin/ffmpeg -i /tmp/' . $file->getClientOriginalName() . ' -vf  "thumbnail,scale=640:360" -frames:v 1 /tmp/' . $guid . '.png';
		$return[1] = shell_exec($return[0]);

		sleep(5);
	
		$s3Client = S3Client::factory(array(
			'version' => 'latest',
			'region' => 'eu-west-1',
			'key'    => getenv('AWS_KEY'),
			'secret' => getenv('AWS_SECRET')
		));

		if(file_exists('/tmp/' . $guid . '.png')) {
			$result = $s3Client->putObject(array(
				'ACL' => 'public-read',
				'Bucket' => 'stbons',
				'Key' => $guid . '.png',
				'Body' => fopen('/tmp/' . $guid . '.png', 'r'),
				'ContentType' => 'image/jpeg'
			));

			unlink('/tmp/' . $guid . '.png');
			unlink('/tmp/' . $file->getClientOriginalName());

			return "https://s3-eu-west-1.amazonaws.com/stbons/" .  urlencode($guid . '.png');
		} else {
			return "";
		}
	}
	
	public static function slack($message, $username, $icon) {

		$payload = array(
			'text'=>$message,
			'username'=>$username,
			'icon_emoji'=>$icon
			);

		$url = 'https://hooks.slack.com/services/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';
		$fields = array(
					'payload' => json_encode($payload)
				);

		//url-ify the data for the POST
		$fields_string = "";
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
	}
}


