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
			
			switch($videoFile->getClientOriginalExtension()) {
				case("mov"):
				case("mp4"):
						$destination = getcwd(). "/videos/";
						
						if(!is_dir($destination)) {
							mkdir($destination);
						}
						
						$videoFile->move($destination, $videoFile->getClientOriginalName());
						
						$video = New Videos();
						$video->title = "";
						$video->videoFile = "/videos/" . $videoFile->getClientOriginalName();
						$video->studentName = $request::input('studentName');
						$video->className = "Test Class";
						$video->houseName = "Test House Name";
						
						$video->save();
						
						return Redirect::to('video/show/' . $video->id)->with('message', 'Thank you for your video! <a class="alert-link" href=\'/\'></a>');
				break;
				default:
					return Redirect::to('video/upload/')->with('error', 'The file type "' . $video->getClientOriginalExtension() . '" is not allowed');
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
					return Redirect::to('video/show/' . $id)->with('error', 'You have already voted for this video, <a class="alert-link" href=\'/\'>please watch another one!</a>');
				}
			}
		}
		
		// Video not previously voted for
		Videos::where('id', '=', $id)->increment('videoRating');
		Session::push('user.votes', $id);
		
		return Redirect::to('video/show/' . $id)->with('message', 'Thank you for your vote! <a class="alert-link" href=\'/\'>Now watch some more videos!</a>');
	}
}
