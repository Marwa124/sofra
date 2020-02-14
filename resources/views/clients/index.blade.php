@extends('layouts.app')

@section('content')

@inject('clients', 'App\Models\Client');

<div class="card">
  <div class="card-header">
    <h3 class="card-title">العملاء &nbsp;<span class="text-muted" style="font-size:1rem;">طالبي الطعام</span></h3>
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
                  style="width: 2 00px;">الاسم</th>
                  <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="الايميل: activate to sort column ascending" style="width: 254px;">الايميل</th>
                  <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="الهاتف: activate to sort column ascending" style="width: 254px;">الهاتف</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                    aria-label="المدينه: activate to sort column ascending">المدينه</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="حذف: activate to sort column ascending" style="width: 66px;">حذف</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($clients->all() as $item)

              <tr role="row" class="text-right" id="removable{{$item->id}}">
                <td>{{$loop->iteration}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->phone}}</td>
                <td>{{$item->district->name}} {{$item->district->city->name}}</td>
                <td class="text-center">
                  <button id="{{$item->id}}" data-token="{{csrf_token()}}"
                    data-route="{{route('clients.destroy', $item->id)}}" class="fa fa-trash btn btn-danger btn-xs destroy"></button>
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
