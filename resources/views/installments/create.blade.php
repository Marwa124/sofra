@extends('layouts.app')

@section('content')

@inject('installments', 'App\Models\Installment');

<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title"> إضافة عملية مالية</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->

  {!! Form::model($installments, ['route' => 'installment.store']) !!}
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

@push('extra-js')
  <!-- Select2 -->
<script src="{{asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('adminlte/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('adminlte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('adminlte/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('adminlte/plugins/iCheck/icheck.min.js')}}"></script>
<!-- Persian Data Picker -->
<script src="{{asset('adminlte/js/persian-date.min.js')}}"></script>
<script src="{{asset('adminlte/js/persian-datepicker.min.js')}}"></script>
<script>

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()


    $('.normal-example').persianDatepicker();

  });
</script>

<div class="colorpicker dropdown-menu colorpicker-hidden"><div class="colorpicker-saturation" style="background-color: rgb(255, 0, 0);"><i style="top: 100px; left: 0px;"><b></b></i></div><div class="colorpicker-hue"><i style="top: 100px;"></i></div><div class="colorpicker-alpha" style="background-color: rgb(0, 0, 0);"><i style="top: 0px;"></i></div><div class="colorpicker-color" style="background-color: rgb(0, 0, 0);"><div style="background-color: rgb(0, 0, 0);"></div></div></div>
<div class="colorpicker dropdown-menu colorpicker-hidden"><div class="colorpicker-saturation" style="background-color: rgb(255, 0, 0);"><i style="top: 100px; left: 0px;"><b></b></i></div><div class="colorpicker-hue"><i style="top: 100px;"></i></div><div class="colorpicker-alpha" style="background-color: rgb(0, 0, 0);"><i style="top: 0px;"></i></div><div class="colorpicker-color" style="background-color: rgb(0, 0, 0);"><div style="background-color: rgb(0, 0, 0);"></div></div></div>

<div id="plotId" class="datepicker-plot-area  datepicker-state-no-meridian   datepicker-persian">
  <div data-navigator="" class="datepicker-navigator">
    <div class="pwt-btn pwt-btn-next">&lt;</div>
    <div class="pwt-btn pwt-btn-switch">۱۳۹۸ بهمن</div>
    <div class="pwt-btn pwt-btn-prev">&gt;</div>
  </div>
  <div class="datepicker-grid-view">
    <div class="datepicker-day-view">
      <div class="month-grid-box">
        <div class="header">
          <div class="title"></div>
          <div class="header-row">
            <div class="header-row-cell">ش</div>
            <div class="header-row-cell">ی</div>
            <div class="header-row-cell">د</div>
            <div class="header-row-cell">س</div>
            <div class="header-row-cell">چ</div>
            <div class="header-row-cell">پ</div>
            <div class="header-row-cell">ج</div>
          </div>
        </div>
        <table cellspacing="0" class="table-days">
          <tbody>

            <tr>
              <td data-date="1398,10,28" data-unix="1579298400000">
                <span class="other-month">۲۸</span>
              </td>

              <td data-date="1398,10,29" data-unix="1579384800000">
                <span class="other-month">۲۹</span>
              </td>

              <td data-date="1398,10,30" data-unix="1579471200000">
                <span class="other-month">۳۰</span>
              </td>

              <td data-date="1398,11,1" data-unix="1579609425222">
                <span class="">۱</span>
              </td>

              <td data-date="1398,11,2" data-unix="1579695825222">
                <span class="">۲</span>
              </td>

              <td data-date="1398,11,3" data-unix="1579782225222">
                <span class="">۳</span>
              </td>

              <td data-date="1398,11,4" data-unix="1579868625222">
                <span class="">۴</span>
              </td>

            </tr>

            <tr>
              <td data-date="1398,11,5" data-unix="1579955025222">
                <span class="">۵</span>
              </td>

              <td data-date="1398,11,6" data-unix="1580041425222">
                <span class="">۶</span>
              </td>

              <td data-date="1398,11,7" data-unix="1580127825222">
                <span class="">۷</span>
              </td>

              <td data-date="1398,11,8" data-unix="1580214225222">
                <span class="">۸</span>
              </td>

              <td data-date="1398,11,9" data-unix="1580300625222">
                <span class="">۹</span>
              </td>

              <td data-date="1398,11,10" data-unix="1580387025222">
                <span class="">۱۰</span>
              </td>

              <td data-date="1398,11,11" data-unix="1580473425222">
                <span class="">۱۱</span>
              </td>

            </tr>

            <tr>
              <td data-date="1398,11,12" data-unix="1580559825222">
                <span class="">۱۲</span>
              </td>

              <td data-date="1398,11,13" data-unix="1580646225222">
                <span class="">۱۳</span>
              </td>

              <td data-date="1398,11,14" data-unix="1580732625222">
                <span class="">۱۴</span>
              </td>

              <td data-date="1398,11,15" data-unix="1580819025222" class="selected">
                <span class="">۱۵</span>
              </td>

              <td data-date="1398,11,16" data-unix="1580905425222">
                <span class="">۱۶</span>
              </td>

              <td data-date="1398,11,17" data-unix="1580991825222">
                <span class="">۱۷</span>
              </td>

              <td data-date="1398,11,18" data-unix="1581078225222">
                <span class="">۱۸</span>
              </td>

            </tr>

            <tr>
              <td data-date="1398,11,19" data-unix="1581164625222" class="today">
                <span class="">۱۹</span>
              </td>

              <td data-date="1398,11,20" data-unix="1581251025222">
                <span class="">۲۰</span>
              </td>

              <td data-date="1398,11,21" data-unix="1581337425222">
                <span class="">۲۱</span>
              </td>

              <td data-date="1398,11,22" data-unix="1581423825222">
                <span class="">۲۲</span>
              </td>

              <td data-date="1398,11,23" data-unix="1581510225222">
                <span class="">۲۳</span>
              </td>

              <td data-date="1398,11,24" data-unix="1581596625222">
                <span class="">۲۴</span>
              </td>

              <td data-date="1398,11,25" data-unix="1581683025222">
                <span class="">۲۵</span>
              </td>

            </tr>

            <tr>
              <td data-date="1398,11,26" data-unix="1581769425222">
                <span class="">۲۶</span>
              </td>

              <td data-date="1398,11,27" data-unix="1581855825222">
                <span class="">۲۷</span>
              </td>

              <td data-date="1398,11,28" data-unix="1581942225222">
                <span class="">۲۸</span>
              </td>

              <td data-date="1398,11,29" data-unix="1582028625222">
                <span class="">۲۹</span>
              </td>

              <td data-date="1398,11,30" data-unix="1582115025222">
                <span class="">۳۰</span>
              </td>

              <td data-date="1398,12,1" data-unix="1582235999000">
                <span class="other-month">۱</span>
              </td>

              <td data-date="1398,12,2" data-unix="1582322399000">
                <span class="other-month">۲</span>
              </td>

            </tr>

            <tr>
              <td data-date="1398,12,3" data-unix="1582408799000">
                <span class="other-month">۳</span>
              </td>

              <td data-date="1398,12,4" data-unix="1582495199000">
                <span class="other-month">۴</span>
              </td>

              <td data-date="1398,12,5" data-unix="1582581599000">
                <span class="other-month">۵</span>
              </td>

              <td data-date="1398,12,6" data-unix="1582667999000">
                <span class="other-month">۶</span>
              </td>

              <td data-date="1398,12,7" data-unix="1582754399000">
                <span class="other-month">۷</span>
              </td>

              <td data-date="1398,12,8" data-unix="1582840799000">
                <span class="other-month">۸</span>
              </td>

              <td data-date="1398,12,9" data-unix="1582927199000">
                <span class="other-month">۹</span>
              </td>

            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <div class="toolbox">
    <div class="pwt-btn-today">امروز</div>
    <div class="pwt-btn-calendar">February</div>
  </div>
</div>
@endpush
@endsection
