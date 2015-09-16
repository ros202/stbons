<html>
<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="Scotch">

<title>St. Bons</title>

<!-- load bootstrap from a cdn -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link href="//vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">

<script src="//vjs.zencdn.net/4.12/video.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <a id="logo" href="/">Single Malt</a>
        <ul class="nav">
            <li><a href="/">Home</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/projects">Projects</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>
    </div>
</div>

@yield('content')

<div id="copyright text-right">© Copyright 2013 Scotchy Scotch Scotch</div>

</body>
</html>