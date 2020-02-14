@if ($errors->any())
    <div class="alert alert-danger mr-auto text-right">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('extra-css')
    <style>
      .alert ul{
        margin: -5px 0rem -.3rem -15px !important;
      }
      .alert{
        margin-right: 20rem;
      }
    </style>
@endsection

