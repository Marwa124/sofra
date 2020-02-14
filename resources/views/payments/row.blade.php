<tr role="row" class="text-center" id="removable{{$method->id}}">
  <td class="text-right">{{$method->id}}</td>
  <td class="text-right">{{$method->method}}</td>
  <td>
    <button id="{{$method->id}}" class="edit-btn fa fa-edit btn btn-success btn-xs"
      data-toggle="modal" data-target="#edit{{$method->id}}"></button>
      <div class="modal fade" id="edit{{$method->id}}" tabindex="-1" role="dialog" aria-labelledby="edit{{$method->id}}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="edit{{$method->id}}Label">{{__('تعديل الدفع')}}</h5>
              <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <input type="text" class="form-control method-name" name="name" value="{{ $method->method }}">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" data-route="{{route('payment.update', $method->id)}}" data-token="{{csrf_token()}}"
                class="btn-update btn btn-primary">{{__('حفظ')}}</button>
              <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">{{__('أغلاق')}}</button>
            </div>
          </div>
        </div>
      </div>
  </td>
  <td>
    <button id="{{$method->id}}" data-token="{{csrf_token()}}" data-route="{{route('payment.destroy', $method->id)}}"
      class="destroy fa fa-trash btn btn-danger btn-xs"></button>
  </td>
</tr>
