@extends('layouts.app')

@section('content')

@inject('restaurants', 'App\Models\Restaurant');

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Table With Full Features</h3>
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
                  aria-sort="ascending" aria-label="#: activate to sort column descending"
                  style="width: 15px;">#</th>
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-sort="ascending" aria-label="الاسم: activate to sort column descending"
                  style="width: 300px;">الاسم</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="المدينه: activate to sort column ascending">المدينه</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="العمولات المستحقة: activate to sort column ascending" style="width: 454px;">العمولات المستحقة</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="حالة المطعم: activate to sort column ascending" style="width: 254px;">حالة المطعم</th>
                  <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="مفعل/غير مفعل: activate to sort column ascending" style="width: 400px;">مفعل/غير مفعل</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="حذف: activate to sort column ascending" style="width: 66px;">حذف</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($restaurants->all() as $item)

              <tr role="row" class="text-center" id="removable{{$item->id}}">
                <td class="text-right">{{$loop->iteration}}</td>
                <td class="sorting_1 text-right">
                  <div class="d-flex justify-content-between">
                    <img src="{{asset($item->image)}}" alt="{{$item->image}}"
                    class=" img-thumbnail rounded-circle ml-3 p-0" width="40px" height="40px">
                    <span class=" flex-wrap align-self-center" style="min-width:250px;">{{$item->name}} kjh kjhlk h</span>

                  </div>
                </td>
                <td class="text-right">{{$item->district->city->name}}</td>
                <td>???!!</td>
                <td>
                @if ($item->is_open == "مفتوح")
                <i class="fa fa-circle-o text-green ml-2" style="color:green;"></i> {{$item->is_open}} </td>
                @else
                <i class="fa fa-circle-o text-red ml-2" style="color:red;"></i> {{$item->is_open}} </td>
                @endif
                <td>A</td>
                <td>
                  <button id="{{$item->id}}" data-token="{{csrf_token()}}" data-route="{{route('restaurants.destroy', $item->id)}}"
                    class="destroy fa fa-trash btn btn-danger btn-xs"></button>
                </td>
              </tr>

              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th rowspan="1" colspan="1">موتور رندر</th>
                <th rowspan="1" colspan="1">مرورگر</th>
                <th rowspan="1" colspan="1">سیستم عامل</th>
                <th rowspan="1" colspan="1">ورژن</th>
                <th rowspan="1" colspan="1">امتیاز</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

    </div>
  </div>
  <!-- /.card-body -->
</div>

@endsection
