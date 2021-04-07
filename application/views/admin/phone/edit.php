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
              <?= form_open_multipart('admin/phone/edit/'.$id, array('class' => 'form-horizontal')) ?>
                <div class="card-body">

                  <div class="form-group row">
                    <label for="_category_" class="col-sm-3 col-form-label" style="text-align: right;">Category</label>
                    <div class="col-sm-6">
                      <select name="_category_" id="_category_" class="form-control">
                        <?php foreach ($category as $key => $value) { if ($data['category_id'] == $value['category_id']) {?>
                          <option value="<?= $value['category_id'] ?>" <?= set_select('_category_', $value['category_id']); ?> selected><?= $value['category_name'] ?></option>
                        <?php } else { ?>
                          <option value="<?= $value['category_id'] ?>" <?= set_select('_category_', $value['category_id']); ?>><?= $value['category_name'] ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_number_" class="col-sm-3 col-form-label" style="text-align: right;">Number</label>
                    <div class="col-sm-6">
                      <input type="text" name="_number_" class="form-control" id="_number_" placeholder="Number" value="<?php if(set_value('_number_') != null) {echo set_value('_number_');}else{echo $data['phone_number'];} ?>" required="required" maxlength="250">
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
