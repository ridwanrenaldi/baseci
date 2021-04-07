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
              <?= form_open_multipart('admin/category/add', array('class' => 'form-horizontal')) ?>
                <div class="card-body">

                  <div class="form-group row">
                    <label for="_name_" class="col-sm-3 col-form-label" style="text-align: right;">Name</label>
                    <div class="col-sm-6">
                      <input type="text" name="_name_" class="form-control" id="_name_" placeholder="Name" value="<?php echo set_value('_name_'); ?>" required="required" maxlength="250">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_description_" class="col-sm-3 col-form-label" style="text-align: right;">Description</label>
                    <div class="col-sm-6">
                      <input type="text" name="_description_" class="form-control" id="_description_" placeholder="Description" value="<?php echo set_value('_description_'); ?>" required="required" maxlength="250">
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

</body>
</html>
