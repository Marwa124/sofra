@extends('layouts.app')

@section('content')

@inject('classifications', 'App\Models\Classification');

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Table With Full Features</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
      <div class="row">
        <div class="col-sm-12">
          <table id="example1" class="table table-bordered table-striped dataTable" role="grid">
            <thead>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending"
                  style="width: 146px;">موتور رندر</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="مرورگر: activate to sort column ascending" style="width: 273px;">مرورگر</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="سیستم عامل: activate to sort column ascending" style="width: 254px;">سیستم عامل</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($classifications->all() as $item)

              <tr role="row" class="text-center" id="removable{{$item->id}}">
                <td class="text-right">{{$loop->iteration}}</td>
                <td class="sorting_1 text-right">
                  {{$item->name}}
                </td>
                <td><button data-route="{{route('category.destroy', $item->id)}}" data-token="{{csrf_token()}}"
                  class="destroy fa fa-trash btn btn-danger btn-xs"></button></td>
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
