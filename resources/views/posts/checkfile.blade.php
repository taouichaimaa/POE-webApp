@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 50px">
<h1>Upload file to check</h1>
<div class="container" style="margin-top: 50px">
{!!  Form::open(['url' => route('file.check'),'filep'=>'file_check', 'method' => 'post', 'files' => true]) !!}
{!! Form::file('filep') !!}
  <button type="submit" class="btn btn-primary">Finish transaction</button>
  {!! Form::close() !!} 
</div>
</div>
@endsection