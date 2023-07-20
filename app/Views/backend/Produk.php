<?= $this->extend('backend/layout/admin/dashboard_layout') ?>
<?= $this->section('link') ?>
<link href="<?= site_url('asset/jquery-ui/jquery-ui.min.css') ?>" rel="stylesheet">
<style type="text/css">
  #hapus-tran, #edit-tran {
    cursor: pointer;
  }
  #dialog-confirm, #dialog-form{
    display: none;
  }
  .ui-widget-overlay {
    opacity: 0.9;
    background-color: black;
  }
  #tabel_serverside > thead > tr > th
  {
    font-size: 0.8em;
    font-weight: bold;
    padding: 10px 0;
    margin: 0;
    text-align: center;
  }
  #tabel_serverside > tbody > tr > td
  {
    font-size: 0.8em;
    font-weight: 500;
    padding: 10px 0;
    margin: 0;
    text-align: center;
  }
  #tabel_serverside > tbody > tr > td:nth-child(2)
  {
    text-align: left;
    max-width: 100px;
    white-space: nowrap;
    padding: 5px 5px 0 10px;
  }
  #tabel_serverside > tbody > tr > td:nth-child(2) div
  {
    overflow-x: scroll;
    overflow-y: hidden;
    padding-bottom: 17px;
    box-sizing: content-box;
    scrollbar-color: blue white;
    scrollbar-width: auto;
  }
  #tabel_serverside > tbody > tr:hover
  {
    background-color: rgba(9, 209, 255, 0.64);
  }
  #tabel_serverside > tbody > tr> td:hover
  {
    background-color: #f4f6f9;
    border-left: 6px solid #ccc;
    border-color: #2196F3;
  }
  #tabel_serverside > tbody > tr > td:nth-child(8)
  {
    border: none;
  }
  #tabel_serverside > tbody > tr > td:nth-child(8) > div.row > div.col-6
  {
    padding: 5px 0;
    cursor : pointer;
    transition: transform .2s;
  }
  #tabel_serverside > tbody > tr > td:nth-child(8) > div.row > div.col-6:hover {
    transform: scale(1.5);
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <div class="xinfo"></div>
                  <h3 class="box-title">Semua Produk</h3>
                  <a class='pull-right btn btn-primary btn-sm mb-3' href='<?php echo base_url(); ?>administrator/produk/tambah'>
                    Tambahkan Data
                  </a>
                  <div id="dialog-confirm" title="Hapus Data">
                    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Apakah Anda Yakin Untuk Menghapus Data Ini?</p>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body pb-5">
                  <input class="mtcsrf" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                  <table id="tabel_serverside" class="table table-bordered table-striped table-condensed" style="width: 100%">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Nama Produk</th>
                        <th>Harga Modal</th>
                        <th>Harga Reseller</th>
                        <th>Harga Konsumen</th>
                        <th>Satuan</th>
                        <th>Berat</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                </table>
              </div>
            </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= site_url('asset/jquery-ui/jquery-ui.min.js') ?>"></script>
<script type="text/javascript">
  let csrf = $('.mtcsrf');
  let csrfName = csrf.attr('name');
  let csrfHash = csrf.val();
  $(function(){
    // START-DATATABLES
    var table = $('#tabel_serverside').DataTable({
      'processing' : true,
      'serverSide' : true,
      'serverMethod' : 'post',
      'searchDelay' : 2000,
      "autoWidth": false,
      'columnDefs': [
        {
          targets: [0],
          data : 'no',
          width : '5%'
        },
        {
          targets: [1],
          data : 'nama_produk',
          render: function ( data, type, row ) {
            return '<div>' + data + '</div>';
          },
          width: '30%'
        },
        {
          targets: [2],
          data : 'harga_beli',
          width: '5%'
        },
        {
          targets: [3],
          data : 'harga_reseller',
          width: '5%'
        },
        {
          targets: [4],
          data : 'harga_konsumen',
          width: '5%'
        },
        {
          targets: [5],
          data : 'satuan',
          width: '5%'
        },
        {
          targets: [6],
          data : 'berat',
          width: '5%'
        },
        {
          data:'id_produk',
          targets: [-1],
          render: function ( data, type, row ) {
            return `<center>
                      <a class="btn btn-success btn-xs" title="Edit Data" href="<?= base_url("administrator/produk/edit/") ?>${data}">
                        <span class='fa fa-edit'></span>
                      </a>
                      <a class='btn btn-danger btn-xs' title='Delete Data' href="<?= base_url("administrator/produk/delete/") ?>${data}" ><span class='fa fa-remove'></span>
                      </a>
                  </center>`;
          },
          orderable: false,
          width: '5%'
        },
      ],
      order: [[0,'desc']],
      'ajax' : {
        'url' : "<?= site_url('administrator/ajdt/produk') ?>",
        'type' :'post',
        'data': function(data){
          csrfHash = csrf.val();
          return {
            data : data,
            [csrfName]: csrfHash
          };
        },
        dataSrc:function(data){
          csrf.val(data.token);
          return data.data;
        },
        error: function(){  // error handling
          $(".tabel_serverside-error").html("");
          $("#tabel_serverside").append('<tbody class="tabel_serverside-error"><tr><th colspan="5">Data Tidak Ditemukan di Server</th></tr></tbody>');
          $(".dataTables_processing").css("display","none");
        },
      },
      "oLanguage": {
          "sLengthMenu": "Tampilkan _MENU_ data per halaman",
          "sSearch": "Pencarian: ",
          "sZeroRecords": "Maaf, tidak ada data yang ditemukan",
          "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
          "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
          "sInfoFiltered": "(di filter dari _MAX_ total data)",
          "oPaginate": {
              "sFirst": "<<",
              "sLast": ">>",
              "sPrevious": "< Sebelumnya",
              "sNext": "Selanjutnya >"
         }
      },
    });
    // END-DATATABLES


    // HAPUS-DATA-TRANSAKSI
    var dialog = $("#dialog-confirm").dialog({
        resizable: false,
        autoOpen: false,
        height: "auto",
        width: 400,
        modal: true,
      });

    $('#tabel_serverside tbody').on('click', 'i.fa-trash', function(){
      var d = table.row( $(this).parents('tr') ).data();
      dialog.dialog( "option", "buttons", 
        [
          {
            text: "Hapus",
            icon: "ui-icon-trash",
            click: function(){
              csrfHash = csrf.val();
              $.ajax({
                url: "<?= site_url('administrator/ajdt/produk/hapus') ?>",
                type: 'post',
                data: {
                  id : d.id_produk,
                  [csrfName]: csrfHash
                },
                success: function(data){
                  csrf.val(data.token);
                  dialog.dialog("close");
                  table.ajax.reload();
                }
              });
            }
          },
          {
            text: "Close",
            icon: "ui-icon-close",
            click: function() {
              $( this ).dialog( "close" );
            }
          }
        ]
      );
      dialog.dialog("open");
    });


  });
</script>
<?= $this->endSection() ?>