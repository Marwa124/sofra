@extends('layouts.app')

{{-- @inject('orders', 'App\Models\Order') --}}

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">جدول ۱</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive">
    <table class="table table-bordered">
      <tbody><tr>
        <th style="width: 10px">#</th>
        <th>رقم الطلب</th>
        <th>الإجمالى</th>
        <th>ملاحظات</th>
        <th>الحالة</th>
        <th>وقت الطلب</th>
        <th style="width: 40px">عرض</th>
      </tr>
      <tr>

        @foreach ($orders as $item)

        <td><a href="{{route('orders.show' , $item->id)}}">#{{$item->id}}</a></td>
        <td>{{$item->restaurant->name}}</td>
        <td>{{$item->total}}</td>
        <td>{{$item->notes}}</td>
        <td>{{$item->status}}</td>
        <td>{{$item->created_at}}</td>
        <td><a href="{{route('orders.show' , $item->id)}}" class="badge btn btn-success">عرض الطلب</a></td>
      </tr>


        @endforeach
    </tbody></table>
  </div>
  <!-- /.card-body -->
  <div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
      {{$orders->links()}}
    </ul>
  </div>
</div>

@endsection
