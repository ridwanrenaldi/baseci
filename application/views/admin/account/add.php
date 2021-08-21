<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('admin/partials/head.php') ?>
</head>
<body class="hold-transition sidebar-mini <?php if(isset($layout)){echo $layout;} ?>">
<div class="wrapper">

  <?php $this->load->view('admin/partials/navbar.php') ?>

  <?php $this->load->view('admin/partials/sidebar.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php $this->load->view('admin/partials/breadcrumb.php') ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <?php $this->load->view('admin/partials/cardheader.php') ?>
              
              <!-- form start -->
              <?= form_open_multipart('admin/account/add', array('class' => 'form-horizontal')) ?>
                <div class="card-body">
                  <div class="form-group row">
                    <label for="_name_" class="col-sm-3 col-form-label" style="text-align: right;">Name</label>
                    <div class="col-sm-6">
                      <input type="text" name="_name_" class="form-control" id="_name_" placeholder="Name" value="<?php echo set_value('_name_'); ?>" required="required" minlength="4" maxlength="20">
                    </div>
                  </div>

                  <?php if($mode == 'username') { ?>
                  <div class="form-group row">
                    <label for="_username_" class="col-sm-3 col-form-label" style="text-align: right;">Username</label>
                    <div class="col-sm-6">
                      <input type="text" name="_username_" class="form-control" id="_username_" placeholder="Username" value="<?php echo set_value('_username_'); ?>" required="required" minlength="4" maxlength="12">
                    </div>
                  </div>

                  <?php } elseif($mode == 'email') { ?>
                  <div class="form-group row">
                    <label for="_email_" class="col-sm-3 col-form-label" style="text-align: right;">Email</label>
                    <div class="col-sm-6">
                      <input type="text" name="_email_" class="form-control" id="_email_" placeholder="Email" value="<?php echo set_value('_email_'); ?>" required="required" minlength="4" maxlength="100">
                    </div>
                  </div>
                  <?php } ?>

                  <div class="form-group row">
                    <label for="_password_" class="col-sm-3 col-form-label" style="text-align: right;">Password</label>
                    <div class="col-sm-6">
                      <input type="password" name="_password_" class="form-control" id="_password_" placeholder="Password" value="<?php echo set_value('_password_'); ?>" required="required" minlength="4" maxlength="20">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_passconf_" class="col-sm-3 col-form-label" style="text-align: right;">Confirm Password</label>
                    <div class="col-sm-6">
                      <input type="password" name="_passconf_" class="form-control" id="_passconf_" placeholder="Confirm Password" value="<?php echo set_value('_passconf_'); ?>" required="required" minlength="4" maxlength="20">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_level_" class="col-sm-3 col-form-label" style="text-align: right;">Level</label>
                    <div class="col-sm-6">
                      <select name="_level_" id="_level_" class="form-control" required="required">
                        <option selected disabled hidden>- Choose Level -</option>
                        <option value="root" <?php echo  set_select('_level_', "root"); ?>>Root</option>
                        <option value="admin" <?php echo  set_select('_level_', "admin"); ?>>Admin</option>
                        <option value="user" <?php echo  set_select('_level_', "user"); ?>>User</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_file_" class="col-sm-3 col-form-label" style="text-align: right;">Image</label>
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-3">
                          <img src="<?php echo base_url('assets/images/default.png')?>" id="img-preview" alt="Preview Image" class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="_file_" name="_file_" accept="image/*">
                            <input type="hidden" id="_checkfile_" name="_checkfile_" value="_file_">
                            <label class="custom-file-label" for="customFile" id="_filename_" style="overflow: hidden;">Choose file</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                      <button type="button" class="btn btn-warning" onclick="goBack()">Cancel</button>
                      <button type="reset" class="btn btn-info" id="_reset_">Reset</button>
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </div>
                </div>
                <!-- /.card-footer -->
              
              <?= form_close() ?>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('admin/partials/footer.php') ?>
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<?php $this->load->view('admin/partials/javascript.php') ?>

<script>
  $('#_file_').on('change', function() {
    var files = $(this).get(0).files;
    var eks = ['image/jpeg','image/png','image/jpg'];

    if (eks.includes(files[0].type)) {
      $('#_filename_').text(files[0].name);
      img_pathurl($(this).get(0));
    } else {
      $('#_filename_').text('Choose file');
      $('#_file_').val('');
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: 'The filetype you are attempting to upload is not allowed'
      });
    }
  });
</script>
</body>
</html>
