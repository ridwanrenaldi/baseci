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
                  <?php if(isset($mode) && $mode == 'email'){ ?>
                    <th>Email</th>
                  <?php } else { ?>
                    <th>Username</th>
                  <?php } ?>
                  <th>Level</th>
                  <th>CreateAt</th>
                  <th>ModifyAt</th>
                  <th>IsActive</th>
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
  var columns = [0,1,2,3,4,5];

  function set_switch(id,isactive){
    $.ajax({
      type: 'POST',
      data: { 
          [csrfName]: csrfHash,
          id: id,
          isactive: isactive,
      },
      url: '<?php echo site_url('admin/account/switch')?>',
      dataType: 'JSON',
      success: function (data) {
        if (data.status == 'success') {
          table.ajax.reload();
          Swal.fire({
            icon: 'success',
            title: 'Success...',
            text: data.message
          });
        } else {
          table.ajax.reload();
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data.message
          })
        }
      },
      error: function (ajaxContext) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'The action you have requested is not allowed.',
        })
      }
    });
  }

  $(document).ready(function(){
    table = $('#_table_').DataTable({
      ajax: {
        url: '<?= site_url('admin/account/data')?>',
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
        {data: 'account_name'},
        {
          data: 'account_id',
          render: function(data, type, row){
            let mode = '<?php if(isset($mode) && $mode == 'email'){echo $mode;}else{echo 'username';} ?>';
            if (mode == 'email') {
              return row.account_email;
            } else {
              return row.account_username;
            }
          }
        },
        {data: 'account_level'},
        {data: 'account_created'},
        {data: 'account_modified'},
        {
          data: 'account_isactive',
          render: function(data, type, row){
            if (data != 0) {
              return '<input type="checkbox" class="isactive" data-id="'+row.account_id+'" data-isactive="'+data+'" checked data-bootstrap-switch>';
            } else {
              return '<input type="checkbox" class="isactive" data-id="'+row.account_id+'" data-isactive="'+data+'" data-bootstrap-switch>';
            }
          }
        },
        {
          data: 'account_id',
          render: function(data, type, row){
            let url = "'"+"<?= site_url('admin/account/delete/') ?>"+data+"'";
            return '\
              <a href="<?php echo site_url('admin/account/edit/')?>'+data+'" data-toggle="tooltip" title="Edit">\
                  <button type="button" class="btn btn-warning"><i class="fa fa-edit"></i></button>\
              </a>\
              <a onclick="delete_data('+url+')" data-toggle="tooltip" title="Delete">\
                  <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>\
              </a>';
          }
        }
      ],
      createdRow: function (row, data, index) {
        var elems = Array.prototype.slice.call($(row).find('.isactive'));
        elems.forEach(function (html) {
          $(html).bootstrapSwitch();
        });
      },
    });

    // table.on( 'order.dt search.dt', function () {
    //   table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
    //       cell.innerHTML = i+1;
    //   } );
    // } ).draw();

    table.on('switchChange.bootstrapSwitch', '.isactive', function(event, state) {
      set_switch($(this).data("id"), $(this).data("isactive"));
    });


  });
</script>
</body>
</html>
