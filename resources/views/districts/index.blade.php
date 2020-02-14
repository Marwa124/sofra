@extends('layouts.app')

@section('content')

@inject('districts', 'App\Models\District');
@inject('cities', 'App\Models\City');

<div class="card">
  <div class="card-header">
    <h3 class="card-title"> المناطق&nbsp;<span class="text-muted" style="font-size:1rem;">عرض المناطق</span></h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
      {{-- <button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i> &nbsp; منطقه جديدة</button> --}}

      <button type="button" id="add-btn" class="btn btn-warning btn-sm mb-3" data-toggle="modal"
        data-target="#addDistrict" data-whatever="{{__('اسم المنطقه')}}">
        <i class="fa fa-plus"></i> &nbsp; {{__('منطقه جديدة')}}</button>

      <div class="modal fade" id="addDistrict" tabindex="-1" role="dialog" aria-labelledby="addDistrictLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addDistrictLabel">{{__('منطقه جديدة')}}</h5>
              <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <input type="text" class="form-control" name="district-name" placeholder="{{__('اسم المنطقه')}}">
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
                  aria-sort="ascending" aria-label="اسم المنطقه: activate to sort column descending"
                  style="width: 300px;">اسم المنطقه</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="المدينه: activate to sort column ascending">المدينه</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="تعديل: activate to sort column ascending" style="width: 66px;">تعديل</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="حذف: activate to sort column ascending" style="width: 66px;">حذف</th>
              </tr>
            </thead>
            <tbody class="append-data">

              @foreach ($districts->all() as $item)

              <tr role="row" class="text-center ins-after" id="removable{{$item->id}}">

                <td class="text-right">{{$loop->iteration}}</td>
                <td class="text-right">{{$item->name}}</td>
                <td class="text-right">{{$item->city->name}}</td>
                <td>
                  <button id="{{$item->id}}" class="edit-btn fa fa-edit btn btn-success btn-xs" data-toggle="modal"
                    data-target="#edit{{$item->id}}"></button>
                  <div class="modal fade" id="edit{{$item->id}}" tabindex="-1" role="dialog"
                    aria-labelledby="edit{{$item->id}}Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="edit{{$item->id}}Label">{{__('تعديل منطقه')}}</h5>
                          <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="form-group">
                              <input type="text" class="form-control dist-update{{$item->id}}" name="name"
                                value="{{ $item->name }}">
                            </div>
                            {!! Form::select('city_id', $cities->pluck('name', 'id')->toArray(), $item->city_id, [
                            'class' => 'form-control city-update'.$item->id,
                            ]) !!}
                          </form>
                        </div>
                        <div class="modal-footer">
                          {{$item->id}}
                          {{$item->city->name}}
                          <button type="button" data-route="{{route('district.update', $item->id)}}"
                            data-token="{{csrf_token()}}" data-id="{{$item->id}}"
                            class="btn-update btn btn-primary">{{__('حفظ')}}</button>
                          <button type="button" class="btn btn-secondary mr-3"
                            data-dismiss="modal">{{__('أغلاق')}}</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                  <button id="{{$item->id}}" data-token="{{csrf_token()}}"
                    data-route="{{route('district.destroy', $item->id)}}"
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

@push('extra-js')

<script>
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })
  //Save Button
  $(".btn-save").on('click', function() {
    var token = $(this).data('token');
    var route = $(this).data('route');
    $.ajax({
      type: 'post',
      url: route,
      data: {
        _token: token,
        name: $('input[name="district-name"]').val(),
        city_id: $('.city-selection option:selected').val(),
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);
        // modalScriptClose();
        var tableRow = '<tr>';
        tableRow += '<td>' + data.district.name + '</td>';
        tableRow += '<td>' + data.district.city.name + '</td>';
        tableRow += `<td>
                  <button id="{{$item->id}}" data-token="{{csrf_token()}}" data-route="{{route('district.edit', $item->id)}}"
                    class="fa fa-edit btn btn-success btn-xs"></button>
                </td>`;
        tableRow += '</tr>';
        // creating view in a new blade and include it here by reference data.row for instance
        // and it's exists in controller store method
        // append(data.row)
        // $(".append-data").prepend(tableRow);
        $(".append-data").prepend(data.row);
        swalWithBootstrapButtons.fire(
          'تم الأنشاء بنجاح',
          'أعد تحميل الصفحه ليظهر أخر تحديث.',
          'success'
        );
        console.log(data.district);
      }
    });
  });
  //End Save Button
  //Edit Button
  $(".btn-update").on('click', function() {
    var route = $(this).data("route");
    var token = $(this).data("token");
    var id = $(this).data("id");
    console.log(route + '\n' + token + '\n' +
      $('.dist-update').val() + '\n' +
      $('.city-update').val());
    // $("#edit"+id).modal('hide');
    $("#edit" + id).addClass('modelToHide');
    $.ajax({
      type: 'post',
      url: route,
      data: {
        _method: 'put',
        _token: token,
        name: $('.dist-update' + id).val(),
        city_id: $('.city-update' + id + ' option:selected').val(),
      },
      dataType: 'json',
      success: function(data) {
        console.log("id is: " + id);
        $(".modalToHide").modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        // modalEditScriptClose();
        // $("#edit"+data.district.id).modal('hide');
        // $(".append-data").prepend(data.row);
        // $("#removable"+data.district.id).remove();
        $("#removable" + id).addClass('prepareFor_delete');
        $(data.row).insertAfter("#removable" + data.district.id);
        $(".prepareFor_delete").remove();
        console.log(data);
      },
      error: function(x, y, z) {
        console.log("  " + y);
      }
    });
  });
</script>
@endpush
@endsection
