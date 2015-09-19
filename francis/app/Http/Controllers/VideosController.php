<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
		foreach(Session::get('user.votes') as $existingVote) {
			if($existingVote == $id) {
				// Video previously voted for
				return Redirect::to('video/show/' . $id)->with('message', 'You have already voted for this video, please choose another!');
			}
		}
		
		// Video not previously voted for
		Videos::where('id', '=', $id)->increment('videoRating');
		Session::push('user.votes', $id);
		
		return Redirect::to('video/show/' . $id)->with('message', 'Thanks for your vote!');
	}
}
