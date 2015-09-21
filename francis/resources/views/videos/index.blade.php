@extends('app')

@section('content')

<div class="container">

	<div class="jumbotron">
	  <h2 class="text-primary">Hello, St Bon's!</h2>
	  <p>These videos are all about science, and are all less than a minute long. Watch them, and if you find one you really like, you can click the heart button <span class="text-primary"><i class="glyphicon glyphicon-heart"></i></span> to give it your vote! The video with the most votes will win an amazing prize! <span class="text-danger"><i class="glyphicon glyphicon-gift"></i></span></p>
	  <br>
	  <p>If you want to add your own science video here for everyone to watch and vote for, click here:&nbsp; <a class="btn btn-primary" href="/video/upload" role="button">Add my video!</a></p>
	</div>
</div>


	
<div class="media">
@foreach($videos as $video)
	<div class="container">
	  <div class="media-left media-middle">
		<a href="/video/show/{{ $video->id }}">
		  <img class="media-object" src="/assets/{{ $video->videoThumbnail }}" width=180px alt="{{ $video->studentName }}" onerror="this.onerror=null;this.src='videoplaceholder.png'">
		</a>
	  </div>
	  <div class="media-body">
		<h2 class= "text-primary" "media-heading"> <a href="/video/show/{{ $video->id }}">{{ $video->title }}</a></h2>
		<h4>A video by {{ $video->studentName }} from Class {{ $video->className }}!</h4>
		<p><h5 class="text-muted"><i>{{ $video->videoDescription }}</i></h5></p>
		<p><h4>{{ $video->videoRating }}&nbsp;<span class="text-primary"><i class="glyphicon glyphicon-heart"></i></span></h4></p>
	  </div>
	  <p><br></p>
	</div>
</div>

@endforeach

@endsection('content')
