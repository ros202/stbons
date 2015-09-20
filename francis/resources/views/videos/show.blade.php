@extends('app')

@section('content')

<div class="container">

	<video id="{{ $video->id }}" class="video-js vjs-default-skin vjs-big-play-centered"
	  controls preload="auto" width="960" height="396"
	  poster="{{ $video->videoThumbnail }}"
	  data-setup='{"example_option":true}'>
	 <source src="{{ $video->videoFile }}" type='video/mp4' />
	 <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
	</video>
	
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-12 col-md-9"><h3 class="bg-primary" style="margin-top: 0px;">{{ $video->title }} &nbsp; <i>{{ $video->studentName }}</i></h3></div>
				<div class="col-xs-6 col-md-3"><h3>{{ $video->houseName }}, {{ $video->className }}</h3></div>
			</div>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12 col-md-12"><h4> {{ $video->videoDescription }} </h4>
			</div>
		</div>
	
	<h3 id="rating">{{ $video->videoRating }} {{ $video->voteSuffix }}</h3>
	<h4 class="text-primary">&nbsp;If you really like this video, click the heart to give it your vote! &nbsp; <a onclick="upvote();" class="glyphicon glyphicon-heart"></a></h4>
	<div id="videoRating">
</div>
@endsection('content')
</div>

<script type="text/javascript">

function upvote() {
	var xmlhttp;
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp = new XMLHttpRequest();
	} else {// code for IE6, IE5
	  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	  
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("rating").innerHTML = xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("GET","/video/upvote/{{ $video->id }}", true);
	xmlhttp.send();
}

</script>