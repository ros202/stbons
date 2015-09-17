@extends('app')

@section('content')

<div class="container-fluid">

<h2> {{ $video->title }} </h2>
<h3><i class="text-muted">{{ $video->studentName }}</i></h3>
	<video id="example_video_1" class="video-js vjs-default-skin"
	  controls preload="auto" width="1280" height="528"
	  poster="http://video-js.zencoder.com/oceans-clip.png"
	  data-setup='{"example_option":true}'>
	 <source src="{{ $video->videoFile }}" type='video/mp4' />
	 <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
	</video>
	
	<h3 class="text-primary"><i class="glyphicon glyphicon-heart"></i>&nbsp;If you really like this video, click the heart to give it your vote!</h3>

@endsection('content')
</div>