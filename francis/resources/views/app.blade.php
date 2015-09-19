<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="Scotch">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="logo.png" />

<title>St. Bonaventure's</title>

<!-- load bootstrap from a cdn -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link href="//vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">

<script src="//vjs.zencdn.net/4.12/video.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

</head>

<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Logo and toggle grouped  -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand"  href="#">St Bonaventure's</a>
    </div>

    <!-- Nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-left">
		<li><a href="/"><i class="glyphicon glyphicon-home"></i>&nbsp;&nbsp; Home</a></li>
        <li><a href="/video/upload"><i class="glyphicon glyphicon-film"></i>&nbsp;&nbsp; Add your own video!</a></li>
      </ul>
	  <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Find someone's video!">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

@if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

@yield('content')

<div id="copyright text-right"><p class="text-muted">&nbsp;&nbsp;© Copyright 2015 Ross Harrison</p></div>

</body>
</html>