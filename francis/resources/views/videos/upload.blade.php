@extends('app')

@section('content')

<div class="container-fluid">

<form>
  <div class="form-group">
    <label for="studentName">What is your name and surname?</label>
    <input type="text" class="form-control" id="studentName">
  </div>
  <label for="className">Which class are you in?</label>
  <select class="form-control" id="className">
  <option>RM</option>
  <option>RH</option>
  <option>1MS</option>
  <option>1H</option>
  <option>2WK</option>
  <option>2T</option>
  <option>3J</option>
  <option>3T</option>
  <option>4SA</option>
  <option>4C</option>
  <option>5K</option>
  <option>5P</option>
  <option>6GW</option>
  <option>6D</option>
</select>
<label for="houseName">Which house are you in?</label>
<select class="form-control" id="houseName">
  <option>St Andrew</option>
  <option>St David</option>
  <option>St George</option>
  <option>St Patrick</option>
  <div class="form-group">
    <label for="title">What is the title for your video?</label>
    <input type="text" class="form-control" id="title">
  </div>
  <label for="videoDescription">Write a short description of what you video is about.</label>
  <textarea class="form-control" id="videoDescription" rows="3"></textarea>
  <div class="form-group">
    <label for="inputVideo">Add your video:</label>
    <input type="file" id="inputVideo">
    <p class="help-block">Find where your video is saved.</p>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
	
@endsection('content')
</div>