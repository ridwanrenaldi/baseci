<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-info navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 new messages
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 friend requests
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 new reports
          <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    
    <li class="nav-item dropdown user-menu border-left">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="<?= base_url('uploads/account/'.$session['image']) ?>" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline"><?= $session['name'] ?></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-primary">
          <img src="<?= base_url('uploads/account/'.$session['image']) ?>" class="img-circle elevation-2" alt="User Image">

          <p>
            <?= $session['name'] ?> - <?= $session['level'] ?>
            <small>Member since <?= $session['created'] ?></small>
          </p>
        </li>

        <!-- Menu Footer-->
        <li class="user-footer">
          <div class="row">
            <div class="col-md-6 text-center border-right">
              <a href="<?= site_url('admin/profile/index') ?>" class="btn btn-info"><i class="fas fa-user"></i> Profile</a>
            </div>
            <div class="col-md-6 text-center">
              <a href="<?= site_url('admin/auth/logout') ?>" class="btn btn-info float-right"><i class="fas fa-sign-out-alt"></i> Sign out</a>
            </div>
          </div>
        </li>
      </ul>
    </li>

  </ul>
</nav>
<!-- /.navbar -->