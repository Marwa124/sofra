@extends('layouts.app')

@section('content')

<div class="container">
@include('layouts.inc.error')
  {!! Form::model(Auth::user(),['route' => ['profile.password.update', app()->getLocale()],
    'method' => 'put'])
  !!}
@csrf

<div class="form-group row">
  <div class="col-sm-10">
    {!! Form::password('old-password', [
      'class' => 'form-control ',
      'placeholder' => __("old password"),
      'id' => 'old-password'
    ]) !!}

  </div>
</div>

  <div class="form-group row">
    <div class="col-sm-10">
      {!! Form::password('password', [
        'class' => 'form-control ',
        'placeholder' => __("password"),
        'id' => 'password'
      ]) !!}

    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10">
      {!! Form::password('password_confirmation', [
        'class' => 'form-control',
        'placeholder' => __("confirm password"),
        'id' => 'password_confirm'
      ]) !!}
    </div>
  </div>

<div class="form-group row">

<button type="submit" class="btn btn-success">{{__('save')}}</button>
<a href="{{route('home')}}" class="btn btn-danger">{{__('close')}}</a>

{!! Form::close() !!}
</div>

@endsection
