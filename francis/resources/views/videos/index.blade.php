@extends('app')

@section('content')


<p> Video </p>
	@foreach($videos as $video)
		{{ $video->studentName }}
		<a href="/video/show/{{ $video->id }}">View!</a>
		<img src="/assets/{{ $video->videoThumbnail }}" />
	@endforeach

@endsection('content')