<!-- jQuery -->
<script src="<?= base_url('assets/adminlte') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/adminlte') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/adminlte') ?>/dist/js/adminlte.min.js"></script>
<!-- pace-progress -->
<script src="<?= base_url('assets/adminlte') ?>/plugins/pace-progress/pace.min.js"></script>
<!-- Sweet Alert -->
<script src="<?= base_url('assets/sweetalert2') ?>/dist/sweetalert2.all.min.js"></script>

<?php if(isset($datatables) && $datatables) { ?>
  <!-- DataTables -->
  <script src="<?= base_url('assets/adminlte') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/adminlte') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/adminlte') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('assets/adminlte') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <script src="<?= base_url('assets/adminlte') ?>/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url('assets/adminlte') ?>/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url('assets/adminlte') ?>/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url('assets/adminlte') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url('assets/adminlte') ?>/plugins/datatables-buttons/js/buttons.flash.min.js"></script>
  <script src="<?= base_url('assets/adminlte') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('assets/adminlte') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url('assets/adminlte') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/adminlte') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<?php } ?>

<?php if(isset($switch) && $switch) { ?>
  <!-- Bootstrap Switch -->
  <script src="<?= base_url('assets/adminlte') ?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<?php } ?>

<?php if(isset($select2) && $select2) { ?>
  <!-- Select2 -->
  <script src="<?= base_url('assets/adminlte') ?>/plugins/select2/js/select2.full.min.js"></script>
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2bs4').select2({theme: 'bootstrap4'})
    })
  </script>
<?php } ?>

<?php if(isset($daterange) && $daterange || isset($inputmask) && $inputmask) { ?>
  <!-- moment -->
  <script src="<?= base_url('assets/adminlte') ?>/plugins/moment/moment.min.js"></script>
<?php } ?>

<?php if(isset($daterange) && $daterange) { ?>
  <!-- date-range-picker -->
  <script src="<?= base_url('assets/adminlte') ?>/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url('assets/adminlte') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<?php } ?>

<?php if(isset($inputmask) && $inputmask) { ?>
  <!-- InputMask -->
  <script src="<?= base_url('assets/adminlte') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<?php } ?>

<?php if(isset($colorpicker) && $colorpicker) { ?>
  <!-- bootstrap color picker -->
  <script src="<?= base_url('assets/adminlte') ?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<?php } ?>


<?php if(isset($dropzonejs) && $dropzonejs) { ?>
  <!-- dropzonejs -->
  <script src="<?= base_url('assets/adminlte') ?>/plugins/dropzone/min/dropzone.min.js"></script>
<?php } ?>

<?php if(isset($summernote) && $summernote) { ?>
  <!-- Summernote -->
  <script src="<?= base_url('assets/adminlte') ?>/plugins/summernote/summernote-bs4.min.js"></script>
<?php } ?>




<?php
  if (isset($swal['type']) && $swal['type'] == 'default') {
    $this->load->view('admin/partials/swal.php');
  } elseif (isset($swal['type']) && $swal['type'] == 'button') {
    $this->load->view('admin/partials/swal_goto.php');
  } elseif (isset($swal['type']) && $swal['type'] == 'delete'){
    $this->load->view('admin/partials/swal_delete.php');
  }
?>

<script>
  function goBack() {
    window.history.back();
  }

  function img_pathurl(input){
    $('#img-preview')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
  }

  var csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
  var csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
</script>
