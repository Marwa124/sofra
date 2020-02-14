@inject('cities', 'App\Models\City')

<tr role="row" class="text-center" id="removable{{$district->id}}">

<td class="text-right">{{$district->id}}</td>
<td class="text-right">{{$district->name}}</td>
<td class="text-right">{{$district->city->name}}</td>
<td class="text-center">
  <button id="{{$district->id}}" class="edit-btn fa fa-edit btn btn-success btn-xs"
    data-toggle="modal" data-target="#edit{{$district->id}}"></button>
    <div class="modal fade" id="edit{{$district->id}}" tabindex="-1" role="dialog" aria-labelledby="edit{{$district->id}}Label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="edit{{$district->id}}Label">{{__('منطقه جديدة')}}</h5>
            <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <input type="text" class="form-control dist-update" name="name" value="{{ $district->name }}">
              </div>
              {!! Form::select('city_id', $cities->pluck('name', 'id')->toArray(), $district->city_id, [
                'class' => 'form-control city-update',
                ]) !!}
            </form>
          </div>
          <div class="modal-footer">
            {{$district->id}}
            {{$district->city->name}}
            <button type="button" data-route="{{route('district.update', $district->id)}}" data-token="{{csrf_token()}}"
              class="btn-update btn btn-primary">{{__('حفظ')}}</button>
            <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">{{__('أغلاق')}}</button>
          </div>
        </div>
      </div>
    </div>
</td>
<td class="text-center">
  <button id="{{$district->id}}" data-token="{{csrf_token()}}" data-route="{{route('district.destroy', $district->id)}}"
    class="destroy fa fa-trash btn btn-danger btn-xs"></button>
</td>

</tr>
