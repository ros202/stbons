<?php

namespace App\Http\Controllers;

use Request;
use Session;
use Illuminate\Support\Facades\Redirect;

use App\Videos;

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
		$videos = Videos::get();
		
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
						$destination = getcwd(). "/videos/";
						
						if(!is_dir($destination)) {
							mkdir($destination);
						}
						
						$videoFile->move($destination, $videoFile->getClientOriginalName());
						
						$video = New Videos();
						$video->videoFile = "/videos/" . $videoFile->getClientOriginalName();
						
						$video->title = $request::input('title');
						$video->studentName = $request::input('studentName');
						$video->className = $request::input('className');
						$video->houseName = $request::input('houseName');
						$video->videoDescription = $request::input('videoDescription');
						
						$video->save();
						
						// Large files may be rejected if apache config is configured with a low limit:
						// upload_max_filesize = 4096;
						// post_max_size = 4096;
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
		if(null !== Session::get('user.votes')) {
			foreach(Session::get('user.votes') as $existingVote) {
				if($existingVote == $id) {
					// Video previously voted for
					$video = Videos::where('id', '=', $id)->first();
					$video->voteSuffix = ($video->videoRating != 1 ? "votes": "vote");
					return $video->videoRating . " " . $video->voteSuffix . " &ndash; You've already voted for this video!";
				}
			}
		}
		
		// Video not previously voted for
		Videos::where('id', '=', $id)->increment('videoRating');
		Session::push('user.votes', $id);
		
		$video = Videos::where('id', '=', $id)->first();
		$video->voteSuffix = ($video->videoRating != 1 ? "votes": "vote");
		return $video->videoRating . " " . $video->voteSuffix;
	}
}
