@extends('app')

@section('content')

<div class="container">

{!! Form::open(array('url' => '/video/upload', 'files' => true)) !!}

			<div class="form-group">
				<span class="glyphicon glyphicon-user"></span>&nbsp;{!! Form::label('studentName', 'What is your full name?') !!}
				{!! Form::text('studentName', "", ['class' =>'form-control']) !!}
			</div>
			
			<div class="form-group">
				<span class="glyphicon glyphicon-education"></span>&nbsp;{!! Form::label('className', 'Which class are you in?') !!}
				<br>
				{!! Form::select('className', array('RH', 'RM', '1H', '1MS', '2T', '2WR', '3J', '3T', '4C', '4SA', '5K', '5P', '6D', '6GW'), ['class' =>'form-control']) !!}
			</div>
			
			<div class="form-group">
				<span class="glyphicon glyphicon-home"></span>&nbsp;{!! Form::label('houseName', 'Which house are you in?') !!}
				{!! Form::text('houseName', "", ['class' =>'form-control']) !!}
			</div>
			
			<div class="form-group">
				<span class="glyphicon glyphicon-user"></span>&nbsp;{!! Form::label('studentName', 'What is the title of your video?') !!}
				{!! Form::text('title', "", ['class' =>'form-control']) !!}
			</div>
			
			<div class="form-group">
				<span class="glyphicon glyphicon-user"></span>&nbsp;{!! Form::label('studentName', 'Write a short description of what your video is about:') !!}
				{!! Form::textarea('videoDescription', "", ['class' =>'form-control']) !!}
			</div>
			
			<div class="form-group">
				<span class="glyphicon glyphicon-film"></span>&nbsp;{!! Form::label('video', 'Find where you saved your video:') !!}
				{!! Form::file('video') !!}
			</div>
			
			<div class="form-group">
				<span class="glyphicon glyphicon-plus"></span>&nbsp;{!! Form::submit('Add your video!') !!}
			</div>

{!! Form::close() !!}

@endsection('content')
</div>