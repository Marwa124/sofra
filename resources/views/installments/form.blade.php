@inject('installments', 'App\Models\Installment')
@inject('restaurants', 'App\Models\Restaurant')

<div class="form-group">
  <label for="">	اسم المطعم</label>
  {!! Form::select('restaurant_id', $restaurants->pluck('name', 'id')->toArray(), null, [
    'placeholder' => 'choose',
    'class' => 'form-control'
  ]) !!}
</div>

<div class="form-group">
  <label for="">المبلغ</label>
  {!! Form::text('amount', null, [
    'class' => 'form-control'
  ]) !!}
</div>

<div class="form-group">
  <label for="example-datetime-local-input" class="col-form-label">Date and time</label>
  <div class="col-10">
    {!! Form::date('date', \Carbon\Carbon::now(), [
      'class' => 'form-control'
    ]); !!}
    {{-- <input class="form-control" type="datetime-local" value="2011-08-19T13:45:00" id="example-datetime-local-input"> --}}
  </div>
</div>


