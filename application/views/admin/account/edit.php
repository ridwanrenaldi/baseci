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
              <?= form_open_multipart('admin/account/edit/'.$id, array('class' => 'form-horizontal')) ?>
                <div class="card-body">
                  <div class="form-group row">
                    <label for="_name_" class="col-sm-3 col-form-label" style="text-align: right;">Name</label>
                    <div class="col-sm-6">
                      <input type="text" name="_name_" class="form-control" id="_name_" placeholder="Name" value="<?php if(set_value('_name_') != null) {echo set_value('_name_');}else{echo $data['account_name'];} ?>" required="required" minlength="4" maxlength="20">
                    </div>
                  </div>

                  <?php if($mode == 'username') { ?>
                  <div class="form-group row">
                    <label for="_username_" class="col-sm-3 col-form-label" style="text-align: right;">Username</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="text" name="_username_" class="form-control" id="_username_" placeholder="Username" value="<?php if(set_value('_username_') != null) {echo set_value('_username_');}else{echo $data['account_username'];} ?>" disabled required="required" minlength="4" maxlength="12">
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" id="_checkusername_">
                              <label for="_checkusername_" class="custom-control-label"></label>
                            </div>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php } elseif($mode == 'email') { ?>
                  <div class="form-group row">
                    <label for="_email_" class="col-sm-3 col-form-label" style="text-align: right;">Email</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="text" name="_email_" class="form-control" id="_email_" placeholder="Email" value="<?php if(set_value('_email_') != null) {echo set_value('_email_');}else{echo $data['account_email'];} ?>" disabled required="required" minlength="4" maxlength="100">
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" id="_checkemail_">
                              <label for="_checkemail_" class="custom-control-label"></label>
                            </div>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>

                  <div class="form-group row">
                    <label for="_password_" class="col-sm-3 col-form-label" style="text-align: right;">Password</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="password" name="_password_" class="form-control" id="_password_" placeholder="Password" value="<?= set_value('_password_'); ?>" disabled required="required" minlength="4" maxlength="20">
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" id="_checkpassword_">
                              <label for="_checkpassword_" class="custom-control-label"></label>
                            </div>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_passconf_" class="col-sm-3 col-form-label" style="text-align: right;">Confirm Password</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="password" name="_passconf_" class="form-control" id="_passconf_" placeholder="Confirm Password" value="<?= set_value('_passconf_'); ?>" disabled required="required" minlength="4" maxlength="20">
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <div class="custom-control custom-checkbox">
                              <!-- <input class="custom-control-input" type="checkbox" id="_checkpassconf_"> -->
                              <!-- <label for="_checkpassconf_" class="custom-control-label"></label> -->
                            </div>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_level_" class="col-sm-3 col-form-label" style="text-align: right;">Level</label>
                    <div class="col-sm-6">
                      <select name="_level_" id="_level_" class="form-control" required="required">
                        <option selected disabled hidden>- Choose Level -</option>
                        <option value="root" <?php if(set_select('_level_', 'root') != null) {echo set_select('_level_', 'root');}elseif($data['account_level'] == 'root') {echo 'selected';}?> >Root</option>
                        <option value="admin" <?php if(set_select('_level_', 'admin') != null) {echo set_select('_level_', 'admin');}elseif($data['account_level'] == 'admin') {echo 'selected';}?> >Admin</option>
                        <option value="user" <?php if(set_select('_level_', 'user') != null) {echo set_select('_level_', 'user');}elseif($data['account_level'] == 'user') {echo 'selected';}?> >User</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_file_" class="col-sm-3 col-form-label" style="text-align: right;">Image</label>
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-3">
                          <img src="<?= base_url('uploads/account/'.$data['account_image'])?>" id="img-preview" alt="Preview Image" class="img-thumbnail">
                          <?php if ($data['account_image'] != "default.png") { ?>
                            <button type="button" id="img-delete" data-url="<?= site_url('admin/account/deleteimg/'.$id)?>" class="btn btn-default btn-xs btn-block" >Delete Image</button>
                          <?php } ?>
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


  $(document).ready(function(){
    
    $('#_checkusername_ , #_checkemail_ , #_checkpassword_, #_checkpassconf_').on('change', function(){
      var id = $(this).attr('id');

      if (id == '_checkusername_') {

        if ($(this).is(':checked')) {
          $('#_username_').prop('disabled', false);
        } else {
          $('#_username_').prop('disabled', true);
        }
      } else if (id == '_checkemail_'){
        if ($(this).is(':checked')) {
          $('#_email_').prop('disabled', false);
        } else {
          $('#_email_').prop('disabled', true);
        }
      } else if (id == '_checkpassword_' || id == '_checkpassconf_'){
        console.log('Passconf Jalan');
        if ($(this).is(':checked')) {
          $('#_password_').prop('disabled', false );
          $('#_passconf_').prop('disabled', false );
        } else {
          $('#_password_').prop('disabled', true );
          $('#_passconf_').prop('disabled', true );
        }
      }
    });

    $('#img-delete').on('click', function(){
      var url = $(this).data('url');
      // console.log(url);
      $.ajax({
        type: 'POST',
        data: { [csrfName]: csrfHash },
        url: url,
        dataType: 'JSON',
        success: function (data) {
          if (data.status == 'success') {
            $('#img-preview').attr('src','<?= base_url('uploads/account/default.png')?>');
            $('#img-delete').remove();
            Swal.fire({
              icon: 'success',
              title: 'Success...',
              text: data.message
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: data.message
            });
          }
        }
      });
    });


  });
</script>
</body>
</html>
