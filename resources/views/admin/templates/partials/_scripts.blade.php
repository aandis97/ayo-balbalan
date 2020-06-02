<script>
    const base_url_admin = "http://localhost:8000/admin"
    const base_url = "http://localhost:8000"

</script>
<!-- jQuery 3 -->
<script src="{{ asset('admin-template/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin-template/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);

</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin-template/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('admin-template/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin-template/bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('admin-template/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('admin-template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('admin-template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin-template/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('admin-template/bower_components/moment/min/moment.min.js') }}"></script>
<!-- <script src="{{ asset('admin-template/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script> -->
<!-- datepicker -->
<!-- <script src="{{ asset('admin-template/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> -->
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('admin-template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('admin-template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('admin-template/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin-template/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin-template/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin-template/dist/js/demo.js') }}"></script>


<script src="{{ asset('admin-template/plugins/dateJs/jquery.ui.core.js') }}"></script>
<script src="{{ asset('admin-template/plugins/dateJs/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('admin-template/plugins/dateJs/jquery.ui.datepicker.js') }}"></script>
<!-- <script src="{{ asset('admin-template/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script> -->
<script src="{{ asset('admin-template/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script src="{{ asset('admin-template/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('admin-template/plugins/dateJs/date.js') }}"></script>

<script src="{{ asset('admin-template/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin-template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="{{ asset('js/global.js') }}" defer></script>
<script>
    $('.select2').select2()
    $('.thedate').datepicker({
        minDate: "+1",
        dateFormat: 'dd-mm-yy'
    });
    $('.thedate').datepicker("setDate", "+3");
    $('.timepicker').timepicker({
        showInputs: false,
        showMeridian: false
    })

</script>
@stack('scripts')
