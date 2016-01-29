@extends('app')

@section('content')

<div class="container">
	<div class="embed-responsive embed-responsive-16by9">
		<iframe class="embed-responsive-item" src="{{ $video->videoFile }}" allowfullscreen></iframe>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4 text-center"><h3 class="bg-primary">{{ $video->studentName }}, {{ $video->className }}</h3></div>
				<div class="col-xs-12 col-sm-6 col-md-4 text-center"><h3 class="bg-primary"><i>{{ $video->title }}</i></h3></div>
				@if(Auth::user()->admin == 1)
					<div class="col-xs-12 col-sm-12 col-md-4 text-center"><h3 class="bg-primary" id="rating">{{ $video->videoRating }}&nbsp;{{ $video->voteSuffix }}</h3></div>
				@else
					<div class="col-xs-12 col-sm-12 col-md-4 text-center"><h3 class="bg-primary" id="rating">Validating votes...</h3></div>
				@endif
			</div>
		</div>
		<div class="panel-body"><h5>{{ $video->videoDescription }}</h5></div>
			<ul class="list-group">
				@if(Config('app.voting_on'))
					<li class="list-group-item text-center"><h4 class="text-primary">&nbsp;If you really like this video, click the heart to give it your vote! &nbsp; <a onclick="upvote();" class="glyphicon glyphicon-heart"></a></h4><div id="videoRating"></li>
				@else
					<li class="list-group-item text-center"><h4 class="text-primary">&nbsp;In January, you will be able to click this heart to give this video your vote! &nbsp; <a class="glyphicon glyphicon-heart"></a></h4><div id="videoRating"></li>
				@endif
				@if(Auth::user()->admin == 1) 
					<a href="/video/delete/{{ $video->id }}" onclick="return confirm('Are you sure you want to delete this video?')" class="glyphicon glyphicon-remove"></a>
				@endif
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
	
	xmlhttp.open("POST","/video/upvote/{{ $video->id }}", true);
	xmlhttp.setRequestHeader("X-CSRF-Token", "{!! csrf_token() !!}");
	xmlhttp.send();
}

</script>