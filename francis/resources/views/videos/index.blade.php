@extends('app')

@section('content')

<div class="container">

<div class="jumbotron">
  <h2>Hello, St Bon's!</h2>
  <p>These videos are all about science, and are all less than a minute long. Watch them, and if you find one you really like, you can click the heart button <i class="glyphicon glyphicon-heart"></i> to give it your vote! The video with the most votes will win an amazing prize! <i class="glyphicon glyphicon-gift"></i></p>
  <p>If you want to dd your own science video here for everyone to vote on, click here:&nbsp; <a class="btn btn-primary btn-lg" href="/upload" role="button">Add my video!</a></p>
</div>

<div class="media">
@foreach($videos as $video)
  <div class="media-left media-middle">
    <a href="/video/show/{{ $video->id }}">
      <img class="media-object" src="/assets/{{ $video->videoThumbnail }}" alt="{{ $video->studentName }}">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">{{ $video->studentName }}</h4>
    A video by {{ $video->studentName }}!
	<i class="glyphicon glyphicon-heart"></i> Upvote!
  </div>
  <p><br></p>
</div>

@endforeach
</div>
	
@endsection('content')