@extends('layouts.app')

@section('content')

@inject('offers', 'App\Models\Offer');
<?php
use Carbon\Carbon;

?>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">العروض &nbsp;
      <span class="text-muted" style="font-size:1rem;">عرض العروض</span></h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

      <div class="row">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped dataTable" role="grid">
            <thead>
              <tr role="row" style=" font-size:13px;">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 15px;">#</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="الصوره: activate to sort column ascending">الصوره</th>
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-sort="ascending" aria-label="الاسم: activate to sort column descending" style="width: 300px;">
                  الاسم</th>
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-sort="ascending" aria-label="المطعم: activate to sort column descending" style="width: 300px;">
                  المطعم</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="بدايه العرض: activate to sort column ascending" style="width: 454px;">بدايه العرض</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="نهايه العرض: activate to sort column ascending" style="width: 254px;">نهايه العرض</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="متاح/غير متاح: activate to sort column ascending" style="width: 400px;">متاح/غير متاح</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="حذف: activate to sort column ascending" style="width: 66px;">حذف</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($offers->all() as $item)

              <tr role="row" class="text-center" id="removable{{$item->id}}">
                <td class="text-right">{{$loop->iteration}}</td>
                <td class="sorting_1 text-right">
                  <div class="d-flex justify-content-between">
                    <img src="{{asset($item->photo)}}" alt="{{$item->photo}}"
                      class=" img-thumbnail rounded-circle ml-3 p-0" width="40px" height="40px">
                  </div>
                </td>
                <td class="text-right">{{$item->title}}</td>
                <td class="text-right">{{$item->restaurant->name}}</td>
                <td>{{$item->from}}</td>
                <td>{{$item->to}}</td>
                <td>
                  @if ($item->to > Carbon::now())
                  <i class="fa fa-2x fa-check" style="color:#00a65a; font-size:1.5rem"></i>
                  @else
                  <i class="fa fa-2x fa-close" style="color:#dd4b39; font-size:1.5rem"></i>
                  @endif
                </td>
                <td>
                  <button id="{{$item->id}}" data-token="{{csrf_token()}}"
                    data-route="{{route('offers.destroy', $item->id)}}"
                    class="destroy fa fa-trash btn btn-danger btn-xs"></button>
                </td>
              </tr>

              @endforeach
            </tbody>
            <tfoot>

            </tfoot>
          </table>
        </div>
      </div>

    </div>
  </div>
  <!-- /.card-body -->
</div>

@endsection
