  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url('admin/dashboard/index') ?>" class="brand-link">
      <img src="<?= base_url('assets/adminlte') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Base CI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('uploads/account/'.$session['image']) ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= site_url('admin/dashboard/index') ?>" class="d-block"><?= $session['name'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="<?= site_url('admin/dashboard/index') ?>" class="nav-link <?php if($sidebar=='dashboard'){echo'active';}?>">
              <i class="nav-icon fas fa-th"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <?php $side_account = array('account-index','account-add') ?>
          <li class="nav-item <?php if(in_array($sidebar, $side_account)){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if(in_array($sidebar, $side_account)){echo 'active';}?>">
              <i class="nav-icon fas fa fa-user-circle"></i>
              <p>
                Account
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('admin/account/index') ?>" class="nav-link <?php if($sidebar==$side_account[0]){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('admin/account/add') ?>" class="nav-link <?php if($sidebar==$side_account[1]){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>

          <?php $side_category = array('category-index','category-add') ?>
          <li class="nav-item <?php if(in_array($sidebar, $side_category)){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if(in_array($sidebar, $side_category)){echo 'active';}?>">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('admin/category/index') ?>" class="nav-link <?php if($sidebar==$side_category[0]){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('admin/category/add') ?>" class="nav-link <?php if($sidebar==$side_category[1]){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>

          <?php $side_phone = array('phone-index','phone-add') ?>
          <li class="nav-item <?php if(in_array($sidebar, $side_phone)){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if(in_array($sidebar, $side_phone)){echo 'active';}?>">
              <i class="nav-icon fas fa-phone"></i>
              <p>
                Phone
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('admin/phone/index') ?>" class="nav-link <?php if($sidebar==$side_phone[0]){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('admin/phone/add') ?>" class="nav-link <?php if($sidebar==$side_phone[1]){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>