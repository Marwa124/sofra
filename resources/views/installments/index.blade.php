@extends('layouts.app')

@section('content')

@inject('installments', 'App\Models\Installment');

<div class="card" >
  <div class="card-header">
    <h3 class="card-title"> {{__('العمليات المالية')}}&nbsp;<span class="text-muted" style="font-size:1rem;">عرض العمليات</span></h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

  <a href="{{route('installment.create')}}" class="btn btn-warning btn-sm mb-3"><i class="fa fa-plus"></i> &nbsp; {{__('منطقه جديدة')}}</a>

      <div class="row">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped dataTable" role="grid">
            <thead>
              <tr role="row" style=" font-size:13px;">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-sort="ascending" aria-label="#: activate to sort column descending"
                  style="width: 15px;">#</th>
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-sort="ascending" aria-label="اسم المطعم: activate to sort column descending"
                  style="width: 300px;">اسم المطعم</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="المبلغ: activate to sort column ascending">المبلغ</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="بيان العملية: activate to sort column ascending">بيان العملية</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                aria-label="تعديل: activate to sort column ascending" style="width: 66px;">تعديل</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="حذف: activate to sort column ascending" style="width: 66px;">حذف</th>
              </tr>
            </thead>
            <tbody class="append-data">

              @foreach ($installments->all() as $item)

              <tr role="row" class="text-center ins-after" id="removable{{$item->id}}">


              <td class="text-right">{{$loop->iteration}}</td>
              <td class="text-right">{{$item->restaurant->name}}</td>
              <td class="text-right">{{$item->amount}}</td>
              <td class="text-right">{{$item->date}}</td>
              <td>

                <a href="{{route('installment.edit', $item->id)}}" class="fa fa-edit btn btn-success btn-xs"></a>

              </td>
              <td>
                {!! Form::model($item, ['route' => ['installment.destroy', $item->id],
                'method' => 'delete' ])!!}
                <button type="submit" onclick="return confirm('هل انت متأكد؟')" class="fa fa-trash btn btn-danger btn-xs" ></button>
                {!! Form::close() !!}
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
