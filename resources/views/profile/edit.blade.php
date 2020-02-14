@extends('layouts.app')

@section('content')

<div class="container">

  {!! Form::model(Auth::user(),['route' => ['profile.update', Auth::user()->id, app()->getLocale()],
    'method' => 'put', 'files' => true
              ])
  !!}
@csrf

  <div class="form-group row">
    <div class="col-sm-10">
      {!! Form::text('name', null, [
        'class' => 'form-control',
        'id' => 'name'
      ]) !!}
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10">
      {!! Form::text('email', null, [
        'class' => 'form-control',
        'id' => 'email'
      ]) !!}
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10">
      {!! Form::file('image', [
        'class' => 'form-control',
        'id' => 'image',
      ]) !!}
    </div>
  </div>


  <div class="form-group row">
    <div class="col-sm-10">
      <img src="{{asset('uploads/users/52.png')}}" class="img-thumbnail" id="user-img" width="100px" alt="user-img">
    </div>
  </div>

<button type="submit" class="btn btn-success btn-block w-50">{{__('save')}}</button>

{!! Form::close() !!}
</div>

@push('extra-js')
    <script>
      //Jquery Image preview
      $('#image').on('change', function(){
        // this -> using for targeting the element
        if (this.files && this.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            console.log(e.target);
            $('#user-img').attr('src', e.target.result);
          }

          reader.readAsDataURL(this.files[0]);
        }
      });


    </script>
@endpush
@endsection
