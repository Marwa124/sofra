@extends('layouts.app')

@section('content')

<div class="invoice p-3 mb-3">
  <!-- title row -->
  <div class="row">
    <div class="col-12">
      <h4>
        <i class="fa fa-globe"></i>  تفاصيل طلب # {{$order->id}}
        <small class="float-left text-muted" style="font-size:15px;"><i class="fa fa-calendar-o"></i> {{$order->created_at}}</small>
      </h4>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      طلب من:
      <address>
        <strong>{{$order->client->name}}</strong><br>
        {{__('تليفون')}} : {{$order->client->phone}}<br>
        {{__('ایمیل')}} : {{$order->client->email}}<br>
        {{__('العنوان')}} : {{$order->client->accommodation}}
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      المطعم
      <address>
        <strong>{{$order->restaurant->name}}</strong><br>
        {{__('تليفون')}} : {{$order->restaurant->phone}}<br>
        {{__('ایمیل')}} : {{$order->restaurant->email}}<br>
        {{__('العنوان')}} : {{$order->restaurant->district->name}}
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <br>
      <b>کد سفارش :</b> ۴F۳S۸J<br>
      <b>حاله الطلب :</b>{{$order->status}}<br>
      <b>الاجمالي :</b> {{$order->total}}
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-12 table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th>#</th>
          <th>إسم المنتج</th>
          <th>الكمية</th>
          <th>السعر</th>
          <th>ملاحظة</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($order->meals as $item)

          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->pivot->quantity}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->note}}</td>
          </tr>
          @endforeach
          <tr>
            <td>--</td>
            <td>تكلفة التوصيل</td>
            <td>-</td>
            <td>{{$order->restaurant->delivery_fees}}</td>
            <td></td>
          </tr>
          <tr style="background-color:#dff0d8;">
            <td>--</td>
            <td>الإجمالي</td>
            <td>-</td>
            <td>{{$order->total}}</td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-12">
      <a href="" id="print-order" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i> طباعه </a>

      <a href="{{route('orders.pdf', $order->id)}}" target="_blank" type="button" class="btn btn-primary float-left ml-2 btn-sm" style="margin-right: 5px;">
        <i class="fa fa-download"></i> تولید PDF
      </a>
    </div>
  </div>
</div>

@endsection

@push('extra-css')
    <style scoped>
      @page{
      margin: 0%;
      background-color: orange;
      margin-right: -15rem;
    }
    .no-print a:focus{
      border: 0px!important;
      box-shadow: none!important;
    }
    </style>
@endpush