@extends('layouts.app')

@section('content')

@inject('cities', 'App\Models\City');

<div class="card">
  <div class="card-header">
    <h3 class="card-title"> المدن&nbsp;<span class="text-muted" style="font-size:1rem;">عرض المدن</span></h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

      <button type="button" id="add-btn" class="btn btn-warning btn-sm mb-3" data-toggle="modal"
        data-target="#addDistrict" data-whatever="{{__('اسم المنطقه')}}">
        <i class="fa fa-plus"></i> &nbsp; {{__('مدينه جديدة')}}</button>

      <div class="modal fade" id="addDistrict" tabindex="-1" role="dialog" aria-labelledby="addDistrictLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addDistrictLabel">{{__('مدينه جديدة')}}</h5>
              <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <input type="text" class="form-control" name="district-name" placeholder="{{__('اسم المدينه')}}">
                </div>
                {!! Form::select('city_id', $cities->pluck('name', 'id')->toArray(), null, [
                'class' => 'form-control city-selection',
                'placeholder' => 'أختر المدينه',
                ]) !!}
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" data-route="{{route('district.store')}}" data-token="{{csrf_token()}}"
                class="btn-save btn btn-primary">{{__('حفظ')}}</button>
              <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">{{__('أغلاق')}}</button>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped dataTable" role="grid">
            <thead>
              <tr role="row" style=" font-size:13px;">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 15px;">#</th>
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-sort="ascending" aria-label="اسم المدينه: activate to sort column descending"
                  style="width: 300px;">اسم المدينه</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="تعديل: activate to sort column ascending" style="width: 66px;">تعديل</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="حذف: activate to sort column ascending" style="width: 66px;">حذف</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($cities->all() as $item)

              <tr role="row" class="text-center" id="removable{{$item->id}}">
                <td class="text-right">{{$loop->iteration}}</td>
                <td class="text-right">{{$item->name}}</td>
                <td>
                  <button id="{{$item->id}}" data-token="{{csrf_token()}}"
                    data-route="{{route('city.edit', $item->id)}}" class="fa fa-edit btn btn-success btn-xs"></button>
                </td>
                <td>
                  <button id="{{$item->id}}" data-token="{{csrf_token()}}"
                    data-route="{{route('city.destroy', $item->id)}}"
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
