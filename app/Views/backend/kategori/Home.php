<?= $this->extend('backend/layout/admin/dashboard_layout') ?>
<?= $this->section('link') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url("asset/sweetalert2/sweetalert2.min.css") ?>">
<?= $this->endSection() ?>

<?= $this->section('style') ?>
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
    font-size: 0.9em;
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
    border-left: 4px solid #ccc;
    border-color: #2196F3;
  }
  #tabel_serverside > tbody > tr > td:nth-child(8)
  {
    border: none;
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Kategori</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url("administrator") ?>">Home</a></li>
          <li class="breadcrumb-item active">Kategori</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
          <div class="card border border-primary">
            <div class="card-header bg-primary">
              <div class="xinfo"></div>
              <h3 class="card-title">Semua Kategori</h3>
            </div><!-- /.box-header -->
            <div class="card-body">
              <input class="mtcsrf" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
              <div class="row">
                <div class="col-sm-12">
                  <table id="tabel_serverside" class="table table-bordered table-striped table-condensed" style="width: 100%">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Nama Kategori</th>
                        <th>Gambar</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div><!-- /.card-body -->
          </div>
        </div>
      </div>
  </div>
</section>
<!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script type="text/javascript" src="<?= base_url("asset/sweetalert2/sweetalert2.all.min.js") ?>"></script>
<!-- <script type="text/javascript" src="<?= base_url("asset/datatables/DataTables-1.13.5/js/jquery.dataTables.min.js") ?>"></script> -->
<script type="text/javascript" src="<?= base_url("asset/datatables/Responsive-2.5.0/js/dataTables.responsive.js") ?>"></script>
<script type="text/javascript">
  let csrf = $('.mtcsrf');
  let csrfName = csrf.attr('name');
  let csrfHash = csrf.val();
  $(function(){
    // START-DATATABLES
    var table = $('#tabel_serverside').DataTable({
      'responsive' : true,
      'processing' : true,
      'serverSide' : true,
      'serverMethod' : 'post',
      'searchDelay' : 1000,
      "autoWidth": false,
      'columnDefs': [
        {
          responsivePriority: 1,
          targets: [0],
          data : 'no',
          width : '5%',
          orderable: false,
        },
        {
          responsivePriority: 2,
          targets: [1],
          data : 'nama_kategori',
          render: function ( data, type, row ) {
            return '<div>' + data + '</div>';
          },
          width: '30%'
        },
        {
          responsivePriority: 3,
          className: "min-tablet",
          targets: [2],
          data : 'gambar',
          title : 'Gambar',
          render: function(data, type, row) {
            return `<center>
                      <img src="<?= base_url("uploads/kategori/") ?>${data}" class="img-thumbnail w-75" style="height:100px">
                    </center>`;
          },
          width: '10%',
          visible: false
        },
        {
          responsivePriority: 4,
          data:'id_kategori_produk',
          targets: [-1],
          render: function ( data, type, row ) {
            return `<div class='d-flex flex-row justify-content-around'>
                      <div class='edit-produk'>
                        <button class='btn btn-success btn-sm' title="Edit Data">
                          <i class='fa-solid fa-edit'></i>
                        </button>
                      </div>
                      <div class='hapus-produk'>
                        <button class='btn btn-danger btn-sm' title='Delete Data'><i class='fa-solid fa-trash'></i>
                        </button>
                      </div>
                  </div>`;
          },
          orderable: false,
          width: '10%'
        },
      ],
      order: [[0,'desc']],
      'ajax' : {
        'url' : "<?= site_url('administrator/ajdt/kategori') ?>",
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
      "dom" : "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      buttons: [
        {
          text: '<i class="fa-solid fa-plus fa-xl"></i> Kategori',
          action: (e, dt, node, config) => {
            window.location.href = "<?= base_url("administrator/kategori/add") ?>"
          },
          className: 'bg-primary'
        },
        {
          extend: 'colvis',
          text: '<i class="fa-solid fa-eye"></i>',
          className: "bg-warning"
        },
        {
          extend: 'excel',
          text: '<i class="fa-solid fa-file-excel fa-xl"></i>',
          className: 'bg-success'
        },
        {
          extend: 'pdf',
          text: '<i class="fa-solid fa-file-pdf fa-xl"></i>',
          className: 'bg-danger'
        },
      ]
    });
    // END-DATATABLES


    // HAPUS-DATA-PRODUK
    $('#tabel_serverside tbody').on('click', '.hapus-produk', function(){
      var d = table.row( $(this).parents('tr') ).data();
      Swal.fire({
        title : 'Yakin Untuk Menghapus Data Ini?',
        icon: 'info',
        html:
        `Nama Kategori : <b>${d.nama_kategori}</b>`,
        showCancelButton: true,
        confirmButtonText: 'Hapus',
      }).then((result) => {
        if(result.isConfirmed) {
          csrfHash = csrf.val();
          $.ajax({
            url: window.location.href + `/delete`,
            type: 'post',
            data: {
              id_kategori_produk : d.id_kategori_produk,
              [csrfName]: csrfHash
            },
            success: function(data){
              csrf.val(data.token);
              Swal.fire('Kategori Berhasil Di Hapus','','success');
              table.ajax.reload();
            }
          });
        }
      });
    });

    // EDIT-DATA-PRODUK
    $('#tabel_serverside tbody').on('click', '.edit-produk',function(){
      let e = table.row( $(this).parents('tr') ).data();
      window.location.href = window.location.href + `/edit/${e.id_kategori_produk}`;
    });

  });
</script>
<?= $this->endSection() ?>