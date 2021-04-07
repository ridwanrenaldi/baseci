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
              <?= form_open('admin/phone/index', array('class' => 'form-horizontal', 'id'=>'_filter_')) ?>
                <div class="row">

                  <div class="col-5">
                    <select name="_type_" id="_type_" class="form-control select2bs4">
                      <option value="month" <?= set_select('_type_', 'month'); ?> selected>Month</option>
                      <option value="year" <?= set_select('_type_', 'year'); ?>>Year</option>
                      <option value="custom" <?= set_select('_type_', 'custom'); ?>>Custom</option>
                    </select>
                  </div>
                  <div class="col-5">
                    <div id="container_filter">
                    
                      <div class="form-group">
                          <div class="input-group date" id="datetime_picker" data-target-input="nearest">
                            <div class="input-group-prepend" data-target="#datetime_picker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                            <input type="text" name="_date_" class="form-control datetimepicker-input" data-target="#datetime_picker" data-toggle="datetimepicker" readonly="readonly">
                          </div>
                      </div>
                      
                    </div>
                  </div>

                  <div class="col-2">
                    <button type="submit" class="btn btn-block btn-success"><i class="fas fa-search"></i> Filter</button>
                  </div>

                </div>
              <?= form_close() ?>

            </div>

            <div class="card-body">
              <table id="_table_" class="table table-bordered table-hover table-striped" width="100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Category</th>
                  <th>Number</th>
                  <th>Created</th>
                  <th>Modified</th>
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

  function initializeDatatable( r_columns, r_filters ) {
    var markups = [{
    "mRender": function( data, type, row ){     },"aTargets":[1] ,
    }], resp = createDataTable("#tbl_qc", r_columns, r_filters );
    resp.create( "/qc/list", "POST", markups );
    resp.action()
  }

  $(document).ready(function(){


    // https://xdsoft.net/jqplugins/datetimepicker/
    // https://getdatepicker.com/4/
    $('#datetime_picker').datetimepicker({
        format      : 'MM/YYYY',
        viewMode    : 'months',
        minViewMode : 'months',
        defaultDate : {
          year: '<?= date('Y') ?>',
          month: '<?= date('m') - 1 ?>'
        }
    });
    $('#datetime_picker').keydown(function(event) {
        return false;
    });

    $('#_type_').on('change', function(){
      var type = $(this).val();
      var datetimepicker = '<div class="form-group">\
                      <div class="input-group date" id="datetime_picker" data-target-input="nearest">\
                        <div class="input-group-prepend" data-target="#datetime_picker" data-toggle="datetimepicker">\
                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>\
                        </div>\
                        <input type="text" name="_date_" class="form-control datetimepicker-input" data-target="#datetime_picker" data-toggle="datetimepicker" readonly="readonly">\
                      </div>\
                  </div>';

      var daterangepicker = '<div class="form-group">\
                    <div class="input-group">\
                      <div class="input-group-prepend">\
                        <span class="input-group-text">\
                          <i class="far fa-calendar-alt"></i>\
                        </span>\
                      </div>\
                      <input type="text" name="_date_" class="form-control float-right" id="datetime_picker" readonly="readonly">\
                    </div>\
                  </div>';


      if (type == 'month') {
        $('#container_filter').html(datetimepicker);
        $('#datetime_picker').datetimepicker({
            format      : 'MM/YYYY',
            viewMode    : 'months',
            minViewMode : 'months',
            defaultDate : {
              year: '<?= date('Y') ?>',
              month: '<?= date('m') - 1 ?>'
            }
        });
      } else if(type == 'year'){
        $('#container_filter').html(datetimepicker);
        $('#datetime_picker').datetimepicker({
            format      : 'YYYY',
            viewMode    : 'years',
            minViewMode : 'years',
            defaultDate : {
              year: '<?= date('Y') ?>'
            }
        });
      } else if(type == 'custom') {
        $('#container_filter').html(daterangepicker);
        $('#datetime_picker').daterangepicker({
          locale: {
            format: 'YYYY/MM/DD',
            separator: ' to '
          }
        });
      }
      $('#datetime_picker').keydown(function(event) {
        return false;
      });
      
    });
    

    $('#_filter_').submit(function( event ) {
      event.preventDefault();
      table.ajax.reload();
    });

    
    table = $('#_table_').DataTable({
      ajax: {
        url: '<?= site_url('admin/phone/data')?>',
        type: 'POST',
        dataSrc: '',
        data: function ( d ) {
          var data = $('#_filter_').serializeArray();
          d[data[0].name] = data[0].value;
          d[data[1].name] = data[1].value;
          d[data[2].name] = data[2].value;
        }
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
        {data: 'phone_number'},
        {data: 'phone_created'},
        {data: 'phone_modified'},
        {
          data: 'phone_id',
          render: function(data, type, row){
            let url = "'"+"<?= site_url('admin/phone/delete/') ?>"+data+"'";
            return '\
              <a href="<?php echo site_url('admin/phone/edit/')?>'+data+'" data-toggle="tooltip" title="Edit">\
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
