@extends('layouts.app')

@inject('clients', 'App\Models\Client')
@inject('restaurants', 'App\Models\Restaurant')
@inject('offers', 'App\Models\Offer')
@inject('cities', 'App\Models\City')
@inject('orders', 'App\Models\Order')


@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 col-sm-6 col-12">
        <a class="info-box" href="{{route('restaurants.index', app()->getLocale())}}">
          <span class="info-box-icon" style="background-color: #00c0ef;"><i class="fa fa-cutlery text-white"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">{{__('المطاعم')}}</span>
            <span class="info-box-number">{{$restaurants->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-12">
        <a class="info-box" href="{{route('clients.index', app()->getLocale())}}">
          <span class="info-box-icon text-white" style="background-color: #00a65a ;"><i class="fa fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">المستخدمين</span>
            <span class="info-box-number">{{$clients->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-12">
        <a class="info-box" href="#">
          <span class="info-box-icon text-white" style="background-color: #00a65a ;"><i class="fa fa-building-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">المناطق</span>
            <span class="info-box-number">{{$cities->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-12">
        <a class="info-box" href="{{route('orders.index', app()->getLocale())}}">
          <span class="info-box-icon text-white" style="background-color: #dd4b39 ;"><i class="fa fa-tasks"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">الطلبات</span>
            <span class="info-box-number">{{$orders->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-4 col-sm-6 col-12">
        <a class="info-box" href="{{route('offers.index', app()->getLocale())}}">
          <span class="info-box-icon text-white" style="background-color: #00c0ef;"><i class="fa fa-list-ol text-white"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">العروض</span>
            <span class="info-box-number">{{$offers->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-4 col-sm-6 col-12">
        <a class="info-box" href="{{route('restaurants.index', app()->getLocale())}}">
          <span class="info-box-icon text-white" style="background-color: #dd4b39;"><i class="fa fa-envelope text-white"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">الرسائل</span>
            <span class="info-box-number">{{$restaurants->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

    </div>
  </div>
</div>
@endsection
