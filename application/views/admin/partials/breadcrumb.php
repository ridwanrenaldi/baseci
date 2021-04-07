    <!-- Content Header (Page header) -->
    <div class="content-header">
      <?php if(isset($breadcrumb)){ ?>
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php if(isset($title)){echo $title;} ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <?php $i=0; $end=count($breadcrumb)-1 ; foreach ($breadcrumb as $key => $value) { 
                if ($i != $end) {?>
                <li class="breadcrumb-item"><a href="<?= $value ?>"><?= $key ?></a></li>
              <?php } else { ?>
                <li class="breadcrumb-item active"><?= $key ?></li>
              <?php } $i++; } ?>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <?php } ?>
    </div>
    <!-- /.content-header -->