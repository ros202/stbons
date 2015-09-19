@extends('app')

@section('content')

<div class="container">

{!! Form::open(array('url' => '/video/upload', 'files' => true)) !!}

			<div class="form-group">
				{!! Form::label('studentName', 'Name:') !!}
				{!! Form::text('studentName', "", ['class' =>'form-control']) !!}
			</div>
			
			<div class="form-group">
				{!! Form::label('className', 'Class name:') !!}
				{!! Form::text('className', "", ['class' =>'form-control']) !!}
			</div>
			
			<div class="form-group">
				{!! Form::label('houseName', 'House name:') !!}
				{!! Form::text('houseName', "", ['class' =>'form-control']) !!}
			</div>
			
			<div class="form-group">
				{!! Form::label('video', 'Your video:') !!}
				{!! Form::file('video') !!}
			</div>
			
			<div class="form-group">
				{!! Form::submit('Save Changes') !!}
			</div>

{!! Form::close() !!}

@endsection('content')
</div>