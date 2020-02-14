@extends('layouts.app')

@section('content')

@inject('installments', 'App\Models\Installment')

<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title"> إضافة عملية مالية</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->

  {!! Form::model($install, ['route' => [
    'installment.update',
    $install->id
  ],
  'method' => 'put']) !!}

    <div class="card-body">
      @include('layouts.inc.error')
      @include('installments.form')
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">ارسال</button>
    </div>
  {!! Form::close() !!}
</div>

@endsection
