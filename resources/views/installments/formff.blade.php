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
  <label>انتخاب تاریخ:</label>

  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text">
        <i class="fa fa-calendar"></i>
      </span>
    </div>
    {!! Form::text('date', null, [
      'class' => 'normal-example form-control pwt-datepicker-input-element'
    ]) !!}
    {{-- <input class="normal-example form-control pwt-datepicker-input-element"> --}}
  </div>
  <!-- /.input group -->
</div>


