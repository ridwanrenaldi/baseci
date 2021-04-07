  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Admin">
  <meta name="keywords" content="Admin">
  <meta name="author" content="RID1">
  <meta name="url" content="<?= base_url() ?>">
  <title><?php if(!empty($this->uri->segment(2))){echo 'Base CI : '.$this->uri->segment(2);}else{echo 'Base CI';} ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/dist/css/adminlte.min.css">
  <!-- pace-progress -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/pace-progress/themes/yellow/pace-theme-minimal.css">
  <!-- Style -->
  <link rel="stylesheet" href="<?= base_url('assets/style') ?>/style.css">

  <?php if(isset($icheck) && $icheck) { ?>
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <?php } ?>

  <?php if(isset($datatables) && $datatables) { ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <?php } ?>

  <?php if(isset($select2) && $select2) { ?>
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <?php } ?>

  <?php if(isset($daterange) && $daterange) { ?>
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/daterangepicker/daterangepicker.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <?php } ?>

  <?php if(isset($colorpicker) && $colorpicker) { ?>
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <?php } ?>

  <?php if(isset($dropzonejs) && $dropzonejs) { ?>
    <!-- dropzonejs -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/dropzone/min/dropzone.min.css">
  <?php } ?>

  <?php if(isset($summernote) && $summernote) { ?>
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/summernote/summernote-bs4.min.css">
  <?php } ?>