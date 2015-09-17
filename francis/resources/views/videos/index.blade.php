@extends('app')

@section('content')

<h3>Here are all the videos for you to vote on!</h3>

	@foreach($videos as $video)
		{{ $video->studentName }}
		<a href="/video/show/{{ $video->id }}">View!</a>
		<img src="/assets/{{ $video->videoThumbnail }}" />
		<p><i class="glyphicon glyphicon-heart"></i> Upvote!</a></li>
	@endforeach
	
@endsection('content')