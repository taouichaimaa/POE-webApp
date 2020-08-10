
@extends('layouts.app')
@section('content')
@if(!empty($nofile))
<div class="alert alert-danger"> {{ $nofile }}</div>
@endif

{!!  Form::open(['url' => route('file.publish'),'filep'=>'store', 'method' => 'post', 'files' => true]) !!}
  <div class="form-row">
    <div class="form-group col-md-9">
      <label for="inputEmail4">Email</label>
      <input type="email" name="email" class="form-control" id="inputEmail4">
    </div>
    <div class="form-group col-md-9">
      <label for="fullname">Full name</label>
      <input type="text" class="form-control" name="fullname" id="fullname">
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-9">
    <label for="phone">Phone Number</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="06523142">
  </div>
  <div class="form-group col-md-9">
    <label for="message">Message</label>
    <input type="text" class="form-control" id="message" name="message" placeholder="This is proof of existence of this document">
  </div>
 {!! Form::file('filep') !!}
  <button type="submit" class="btn btn-primary">Finish transaction</button>
</div>

  
{!! Form::close() !!}     

@endsection
