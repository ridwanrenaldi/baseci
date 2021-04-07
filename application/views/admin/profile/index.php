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
      <div class="container">
        <div class="row">

          <div class="col-md-4">
            <!-- Profile Image -->
            <div class="card card-info card-outline">
              <div class="card-body box-profile">
                  <div class="text-center">

                  <img class="profile-user-img img-fluid img-circle"
                      src="<?= base_url('uploads/account/default.png')?>"
                      alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center"><?= $data['account_name'] ?></h3>

                  <p class="text-muted text-center">My Profile</p>

                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Username</b> <a class="float-right"><?= $data['account_username'] ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Level</b> <a class="float-right"><?= $data['account_level'] ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Is Active</b> <a class="float-right"><?php if($data['account_isactive']){echo 'True';}else{echo 'False';} ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Modified</b> <a class="float-right"><?= $data['account_modified'] ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Created</b> <a class="float-right"><?= $data['account_created'] ?></a>
                    </li>
                  </ul>

                  <a href="<?= site_url('admin/profile/edit') ?>" class="btn btn-info btn-block"><b>Edit Profile</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

        </div>
      </div>
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
