<!DOCTYPE html>
<html dir="rtl">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{config('app.name') ?? 'lsd'}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/css/adminlte.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables/dataTables.bootstrap4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  {{-- <link href="https://fonts.googleapis.com/css?family=Markazi+Text&display=swap" rel="stylesheet"> --}}
  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="{{asset('adminlte/css/bootstrap-rtl.min.css')}}">

  <link rel="shortcut icon" href="{{ asset('uploads/img/egypt.png') }}">
  <!-- template rtl version -->
  <link rel="stylesheet" href="{{asset('adminlte/css/custom-style.css')}}">

  <style>
    .card {
      border-top: .25rem solid #3c8dbc !important;
    }

    aside {
      height: 100vh !important;
      overflow-y: scroll;
    }

    .sidebar {
      /* overflow-y: scroll; */
      /* height:calc(100% - 4rem) !important; */
    }

    .app-style-caption {
      width: 80% !important;
      padding-left: 9px;
      padding-right: 0%;
      margin-left: 0%;
    }

    .collapse-sidebar-caption,
    #app {
      width: 95% !important;
      padding-left: 15px;
      padding-right: 20px;
      float: left;
      /* margin-left: 0% ; */
      /* background-color: #ccc; */
    }

    .modal {
      overflow-y: auto !important;
      top: 10% !important;
    }

    .user-panel img {
      width: 5rem !important;
    }
  </style>
  @stack('extra-css')

</head>

<body class="hold-transition sidebar-mini">

  @include('layouts.inc.header')

  <div id="app">
    @auth
    <main class="py-4">
      <div>
        @yield('content')
      </div>
    </main>

    @endauth
  </div>

  @include('layouts.inc.footer')

</body>

</html>
