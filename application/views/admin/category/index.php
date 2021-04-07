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
      <div class="row">
        <div class="col-12">

          <div class="card card-info">
            <?php $this->load->view('admin/partials/cardheader.php') ?>

            <div class="card-body">
              <table id="_table_" class="table table-bordered table-hover table-striped" width="100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
  var table;
  var title = '<?= $card_title ?>';
  var filename = '<?= $card_title ?>';
  var columns = [0,1,2];

  $(document).ready(function(){
    table = $('#_table_').DataTable({
      ajax: {
        url: '<?= site_url('admin/category/data')?>',
        type: 'POST',
        dataSrc: '',
        data: { [csrfName]: csrfHash },
      },
      scrollX: true,
      dom: '<"row"<"col-sm-12 col-md-3"l><"col-sm-12 col-md-6"B><"col-sm-12 col-md-3"f>>' +
            '<"row"<"col-sm-12"tr>>' +
            '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
      buttons: [
        {
          extend      : 'copy',
          text        : '<i class="far fa-copy"></i> Copy',
          titleAttr   : 'Copy',
          className   : 'btn btn-default btn-sm',
          exportOptions: {
            columns: columns
          },
          title: title,
          footer: true,
        },
        {
          extend      : 'csv',
          title       : title,
          text        : '<i class="far fa-file"></i> CSV',
          titleAttr   : 'CSV',
          className   : 'btn btn-default btn-sm',
          exportOptions: {
            columns: columns
          },
          filename: filename,
          footer: true,
        },
        {
          extend      : 'excel',
          title       : title,
          text        : '<i class="far fa-file-excel"></i> Excel',
          titleAttr   : 'Excel',
          className   : 'btn btn-default btn-sm',
          exportOptions: {
            columns: columns
          },
          filename: filename,
          footer: true,
        },
        {
          extend      : 'pdf',
          title       : title,
          oriented    : 'potrait',
          pageSize    : 'LEGAL',
          // download    : 'open',
          text        : '<i class="far fa-file-pdf"></i> PDF',
          titleAttr   : 'PDF',
          className   : 'btn btn-default btn-sm',
          exportOptions: {
            columns: columns
          },
          filename: filename,
          footer: true,
        },               
        {
          extend      : 'print',
          title       : title,
          text        : '<i class="fas fa-print"></i> Print',
          titleAttr   : 'Print',
          className   : 'btn btn-default btn-sm',
          exportOptions: {
            columns: columns
          },
          footer: true,
        },
        {
          extend      : 'colvis',
          title       : title,
          text        : '<i class="fas fa-columns"></i> Colvis',
          titleAttr   : 'Colvis',
          className   : 'btn btn-default btn-sm',
          exportOptions: {
            columns: columns
          },
          footer: true,
        },
      ],
      columns: [
        {
          data: null,
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          }
        },
        {data: 'category_name'},
        {data: 'category_description'},
        {
          data: 'category_id',
          render: function(data, type, row){
            let url = "'"+"<?= site_url('admin/category/delete/') ?>"+data+"'";
            return '\
              <a href="<?php echo site_url('admin/category/edit/')?>'+data+'" data-toggle="tooltip" title="Edit">\
                  <button type="button" class="btn btn-warning"><i class="fa fa-edit"></i></button>\
              </a>\
              <a onclick="delete_data('+url+')" data-toggle="tooltip" title="Delete">\
                  <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>\
              </a>';
          }
        }
      ],

    });

    // table.on( 'order.dt search.dt', function () {
    //   table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
    //       cell.innerHTML = i+1;
    //   } );
    // } ).draw();

  });
</script>
</body>
</html>
