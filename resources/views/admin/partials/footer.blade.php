
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
       <!--    <b>Version</b> 2.0 -->
        </div>
        <strong>Copyright &copy; Meat Empire - 2020 <a href="#">Meat Empire-</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
<script src="{{asset('assets/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!---- Select 2 ---->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!------ end select 2-->
    <!-- DATA TABES SCRIPT -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.js')}}" type="text/javascript"></script> 
<script src="{{asset('assets/js/sweetalert.js')}}"></script>

   <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
    
<!--- js validation --->
 <script src="{{asset('assets/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script> 
<!--- End js validation --->

    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
   <!--- toastar msg -->
   <script src="{{asset('assets/toaster/js/toastr.min.js')}}"></script>
   <!--- end toastar msg -->
    <script src="{{asset('assets/plugins/ckeditor/ckeditor.js')}}" type="text/javascript"></script>    

    <script src="{{asset('assets/plugins/ckeditor/styles.js')}}" type="text/javascript"></script>   

    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>    

    <!-- Sparkline -->
    <script src="{{asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <!-- jvectormap -->

    <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <!-- Slimscroll -->
    <script src="{{asset('assets/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{asset('assets/plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/app.min.js')}}" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/dist/js/demo.js')}}" type="text/javascript"></script>

    <!--- toastar msg -->
<script src="{{asset('assets/toaster/js/toastr.min.js')}}"></script>
<!--- end toastar msg -->
    <script>
  @if(Session::has('success'))
      toastr.success("{{ Session::get('success') }}");
      <?php Session::forget('success');?>
  @endif

  @if(Session::has('info'))
      toastr.info("{{ Session::get('info') }}");
        <?php Session::forget('info');?>
  @endif

  @if(Session::has('warning'))
      toastr.warning("{{ Session::get('warning') }}");
       <?php Session::forget('warning');?>
  @endif

  @if(Session::has('error'))
      toastr.error("{{ Session::get('error') }}");
       <?php Session::forget('error');?>
  @endif
  </script>