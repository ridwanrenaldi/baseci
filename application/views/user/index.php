<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('admin/partials/head.php') ?>
</head>
<body class="hold-transition login-page" style="
        background-image: url(<?= base_url('assets/images/background/bg1.jpg')?>);
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height: 100%;
        position: fixed;
        z-index: -10;
        top: 0;
        left: 0;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-info">
    <div class="card-header text-center">
      <a href="<?= site_url('admin/auth/login') ?>" class="h1"><b>Base</b>CI</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Template Multi Level Login</p>


      

      <div class="row mb-3">
        <div class="col-12">
          <a href="https://www.instagram.com/rid1bdbx/" target="_blank">
            <button type="button" class="btn btn-primary btn-block">
              <i class="fab fa-instagram"></i>
              <span class="border-left" style="margin-right: 5px; margin-left: 5px;"></span>
              CONTACT ME
            </button>
          </a>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-12">
          <a href="https://github.com/L200160026/baseci>" target="_blank">
            <button type="button" class="btn btn-primary btn-block">
              <i class="fab fa-github-alt"></i>
              <span class="border-left" style="margin-right: 5px; margin-left: 5px;"></span>
              GITHUB
            </button>
          </a>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-12">
          <a href="<?= site_url('admin') ?>">
            <button type="button" class="btn btn-primary btn-block">
              <i class="fas fa-user-cog"></i>
              <span class="border-left" style="margin-right: 5px; margin-left: 5px;"></span>
              GO TO ADMIN
            </button>
          </a>
        </div>
      </div>




    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<?php $this->load->view('admin/partials/javascript.php') ?>

</body>
</html>