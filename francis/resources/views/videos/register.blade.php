@extends('app')

@section('content')

<div class="container">

	<div class="form-group">
		<span class="text-primary"><span class="glyphicon glyphicon-user"></span></span>&nbsp;{!! Form::label('username', 'Provide a username:') !!}
		{!! Form::text('username', "", ['class' =>'form-control']) !!}
	</div>
	
	<div class="form-group">
		<span class="text-primary"><span class="glyphicon glyphicon-envelope"></span></span>&nbsp;{!! Form::label('email', 'Provide an email address:') !!}
		{!! Form::text('email', "", ['class' =>'form-control']) !!}
	</div>
	
	<div class="form-group">
		<span class="text-primary"><span class="glyphicon glyphicon-lock"></span></span>&nbsp;{!! Form::label('password', 'Create a strong password:') !!}
		{!! Form::text('password', "", ['class' =>'form-control']) !!}
	</div>
	
	<div class="form-group">
		<span class="text-primary"><span class="glyphicon glyphicon-check"></span></span>&nbsp;{!! Form::label('confirmPassword', 'Confirm your password:') !!}
		{!! Form::text('confirmPassword', "", ['class' =>'form-control']) !!}
	</div>
	
	<div class="form-group">
		<span class="text-primary"><span class="glyphicon glyphicon-plus"></span></span>&nbsp;{!! Form::submit('Create new user') !!}
	</div>

@endsection('content')
</div>