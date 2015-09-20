@extends('app')

@section('content')

<div class="container">

	<div class="form-group">
		<span class="text-primary"><span class="glyphicon glyphicon-user"></span></span>&nbsp;{!! Form::label('username', 'Provide a username:') !!}
		{!! Form::text('username', "", ['class' =>'form-control']) !!}
	</div>
	
	<div class="form-group">
		<span class="text-primary"><span class="glyphicon glyphicon-plus"></span></span>&nbsp;{!! Form::submit('Create new user') !!}
	</div>

@endsection('content')
</div>