@extends('app')

@section('content')

<div class="container">

{!! Form::open(array('url' => '/video/upload', 'files' => true)) !!}

			<div class="form-group">
				<span class="text-primary"><span class="glyphicon glyphicon-user"></span></span>&nbsp;{!! Form::label('studentName', 'What is your full name?') !!}
				{!! Form::text('studentName', "", ['class' =>'form-control']) !!}
			</div>
			
			<div class="form-group">
				<span class="text-primary"><span class="glyphicon glyphicon-education"></span></span>&nbsp;{!! Form::label('className', 'Which class are you in?') !!}
				<br>
				{!! Form::select('className', array('RH' => 'RH', 'RM' => 'RM', '1H' => '1H', '1MS' => '1MS', '2T' => '2T', '2WR' => '2WR', '3J' => '3J', '3T' => '3T', '4C' => '4C', '4SA' => '4SA', '5K' => '5K', '5P' => '5P', '6D' => '6D', '6GW' => '6GW'), ['class' =>'form-control']) !!}
			</div>
			
			<div class="form-group">
				<span class="text-primary"><span class="glyphicon glyphicon-home"></span></span>&nbsp;{!! Form::label('houseName', 'Which house are you in?') !!}
				<br>
				{!! Form::select('houseName', array('St Andrew' => 'St Andrew', 'St David' => 'St David', 'St George' => 'St George', 'St Patrick' => 'St Patrick'), ['class' =>'form-control']) !!}
			</div>
			
			<div class="form-group">
				<span class="text-primary"><span class="glyphicon glyphicon-film"></span></span>&nbsp;{!! Form::label('studentName', 'What is the title of your video?') !!}
				{!! Form::text('title', "", ['class' =>'form-control']) !!}
			</div>
			
			<div class="form-group">
				<span class="text-primary"><span class="glyphicon glyphicon-pencil"></span></span>&nbsp;{!! Form::label('studentName', 'For your video: What is the big question? What part of the big question are you looking at?') !!}
				{!! Form::textarea('videoDescription', "", ['class' =>'form-control']) !!}
			</div>
			
			<div class="form-group">
				<span class="text-primary"><span class="glyphicon glyphicon-folder-open"></span></span>&nbsp;&nbsp;{!! Form::label('video', 'Find where you saved your video:') !!}
				{!! Form::file('video') !!}
			</div>
			
			<div class="form-group">
				<span class="text-primary"><span class="glyphicon glyphicon-plus"></span></span>&nbsp;{!! Form::submit('Add your video!') !!}
			</div>

{!! Form::close() !!}

@endsection('content')
</div>