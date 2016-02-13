@extends('app')

@section('content')

<style>
.jumbotron {
	padding-right: 20px;
	padding-left: 20px
}
</style>

<div class="container">

	<div class="jumbotron">
	  <h2 class="text-primary">Hello, St Bon's!</h2>
		  <p>These videos all answer a big science question. Watch them, and if you find one you really like, you can give it your vote! </p> 
		  <p>You only have one vote, so use it well! The top three videos from each Key Stage will be judged by a panel, and the best video will win an iPad!&nbsp;<span class="text-danger"><i class="glyphicon glyphicon-gift"></i></span></p>
	</div>
</div>


	
<div class="media">
@foreach($videos as $video)
	<div class="container">
	  <div class="media-left media-middle">
		<a href="/video/show/{{ $video->id }}">
		  <img class="media-object" src="{{ $video->videoThumbnail }}" width=180px alt="{{ $video->studentName }}" onerror="this.onerror=null;this.src='videoplaceholder.png'">
		</a>
	  </div>
	  <div class="media-body">
		<h2 class= "text-primary" "media-heading"> <a href="/video/show/{{ $video->id }}">{{ $video->title }}</a></h2>
		<h4>A video by {{ $video->studentName }} from Class {{ $video->className }}!</h4>
		<p><h5 class="text-muted"><i>{{ $video->videoDescription }}</i></h5></p>
		@if(Auth::user()->admin == 1)
		<p><h4>{{ $video->videoRating }}&nbsp;<span class="text-primary"><i class="glyphicon glyphicon-heart"></i></span></h4></p>
		@endif
	  </div>
	  <p><br></p>
	</div>
</div>

@endforeach

@endsection('content')
