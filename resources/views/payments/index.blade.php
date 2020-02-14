@extends('layouts.app')

@section('content')

@inject('payments', 'App\Models\PaymentMethod');

<div class="card">
  <div class="card-header">
    <h3 class="card-title"> طرق الدفع &nbsp;<span class="text-muted" style="font-size:1rem;">عرض الكل</span></h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

      <button type="button" id="add-btn" class="btn btn-warning btn-sm mb-3" data-toggle="modal" data-target="#addMethod" data-whatever="{{__('اسم المنطقه')}}">
        <i class="fa fa-plus"></i> &nbsp; {{__('اضف جديد')}}</button>

      <div class="modal fade" id="addMethod" tabindex="-1" role="dialog" aria-labelledby="addMethodLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <form>
                <div class="form-group pt-3">
                  <input type="text" class="form-control" name="method-name" placeholder="{{__('اسم جديد')}}">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" data-route="{{route('payment.store')}}" data-token="{{csrf_token()}}"
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
                  aria-sort="ascending" aria-label="#: activate to sort column descending"
                  style="width: 15px;">#</th>
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-sort="ascending" aria-label="اسم المدينه: activate to sort column descending"
                  style="width: 300px;">اسم المدينه</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="تعديل: activate to sort column ascending" style="width: 66px;">تعديل</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="حذف: activate to sort column ascending" style="width: 66px;">حذف</th>
              </tr>
            </thead>
            <tbody class="add-row">

              @foreach ($payments->all() as $item)

              <tr role="row" class="text-center" id="removable{{$item->id}}">
                <td class="text-right">{{$loop->iteration}}</td>
                <td class="text-right">{{$item->method}}</td>
                <td>
                  <button id="{{$item->id}}" class="edit-btn fa fa-edit btn btn-success btn-xs"
                    data-toggle="modal" data-target="#edit{{$item->id}}"></button>
                    <div class="modal fade" id="edit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="edit{{$item->id}}Label" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="edit{{$item->id}}Label">{{__('تعديل الدفع')}}</h5>
                            <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form>
                              <div class="form-group">
                                <input type="text" class="form-control method-update-btn" name="method" value="{{ $item->method }}">
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" data-route="{{route('payment.update', $item->id)}}" data-token="{{csrf_token()}}"
                              class="btn-update btn btn-primary">{{__('حفظ')}}</button>
                            <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">{{__('أغلاق')}}</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                <td>
                  <button id="{{$item->id}}" data-token="{{csrf_token()}}" data-route="{{route('payment.destroy', $item->id)}}"
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
    <script scoped>

      $(".btn-save").on('click', function(){

      let token = $(this).data('token');
      let route = $(this).data('route');

      $.ajax({
        url: route,
        type: 'post',
        data: {
          _token: token,
          method: $('input[name="method-name"]').val(),
        },
        success: function(data){
          if(data.status != 1){
            Swal.fire({
              icon: 'error',
              text: 'The Name must be unique!',
              timer: 1500,
              showConfirmButton: false,
            })
          }
          console.log(data);
          $(".add-row").prepend(data.row);
        },
        error: function(x, y, z){
          console.log(y);
          console.log(route);
        }
      });
    });

    //On Edit
    $(".btn-update").on('click', function(){

      var route = $(this).data('route');
      var token = $(this).data('token');

      console.log($(".method-update-btn").val());
      $.ajax({
        url: route,
        type: 'post',
        data:{
          _token: token,
          _method: 'put',
          method: $(".method-update-btn").val()
        },
        success: function(data) {
          console.log(data);
        },
        error: function(x, y, z){
          console.log(y);
        }
      });
    });

    </script>
@endpush

@endsection
