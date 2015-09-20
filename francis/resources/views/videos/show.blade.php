@extends('app')

@section('content')

<div class="container">
	<div class="embed-responsive embed-responsive-16by9">
		<iframe class="embed-responsive-item" src="{{ $video->videoFile }}"></iframe>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4 text-center"><h3 class="bg-primary">{{ $video->studentName }}, {{ $video->className }}</h3></div>
				<div class="col-xs-12 col-sm-6 col-md-4 text-center"><h3 class="bg-primary"><i>{{ $video->title }}</i></h3></div>
				<div class="col-xs-12 col-sm-12 col-md-4 text-center"><h3 class="bg-primary" id="rating">{{ $video->videoRating }}&nbsp;{{ $video->voteSuffix }}</h3></div>
			</div>
		</div>
		<div class="panel-body"><h5>{{ $video->videoDescription }}</h5></div>
			<ul class="list-group">
				<li class="list-group-item text-center"><h4 class="text-primary">&nbsp;If you really like this video, click the heart to give it your vote! &nbsp; <a onclick="upvote();" class="glyphicon glyphicon-heart"></a></h4><div id="videoRating"></li>
		</ul>
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