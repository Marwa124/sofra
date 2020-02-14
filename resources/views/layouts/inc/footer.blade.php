@auth

<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.0.0-alpha
    <strong>CopyLeft &copy; 2018 <a href="http://github.com/mratwan/">محمدرضا عطوان</a>.</strong>
  </div>

</footer>

<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
{{-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> --}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('adminlte/js/demo.js')}}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@include('sweetalert::alert')

<script>
  $(function() {
    $("#example1").DataTable({
      "language": {
        "paginate": {
          "next": "بعدی",
          "previous": "قبلی"
        }
      },
      "info": false,
    });
    $('#example2').DataTable({
      "language": {
        "paginate": {
          "next": "بعدی",
          "previous": "قبلی"
        }
      },
      "info": false,
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "autoWidth": false
    });
  });
  //Ajax delete btn icon
  $(document).on('click', '.destroy', function() {
    var route = $(this).data('route');
    var token = $(this).data('token');
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: route,
          type: 'post',
          data: {
            _method: 'delete',
            _token: token
          },
          dataType: 'json',
          success: function(data) {
            console.log(data);
            if (data.status === 0) {
              console.log("error");
              swalWithBootstrapButtons.fire(
                'Error',
                data.message,
                'error'
              );
            } else {
              console.log("success");
              $("#removable" + data.id).remove();
              swalWithBootstrapButtons.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              );
            }
          }
        });
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          'Your imaginary file is safe :)',
          'error'
        )
      }
    });
  });
  // End Ajax delete btn icon
  console.log($(".sidebar-open"));
  // $(".sidebar-collapse").addClass("collapse-sidebar-caption").removeClass("app-style-caption");
  $("#app").addClass("app-style-caption").removeClass("collapse-sidebar-caption");
  $(".bars-script-aside").on('click', function() {
    $("#app").addClass("collapse-sidebar-caption").removeClass("app-style-caption");
    $(".bars-script-aside").on('click', function() {
      $("#app").addClass("app-style-caption").removeClass("collapse-sidebar-caption");
    });
  });
  $("#print-order").on("click", function(e) {
    e.preventDefault();
    window.print();
  });
</script>

@stack('extra-js')

@endauth
