<?= $this->extend('backend/layout/admin/dashboard_layout') ?>

<?= $this->section('link') ?>
<link href="<?= site_url('asset/jquery-ui/jquery-ui.min.css') ?>" rel="stylesheet">
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
  #tabel_serverside > thead > tr > th:nth-child(1)
  {
    text-align: left;
    padding-left: 5px;
  }

  #tabel_serverside > tbody > tr > td
  {
    font-size: 0.8em;
    font-weight: 500;
    padding: 10px 0;
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

  #tabel_serverside > tbody > tr > td:nth-child(7)
  {
    padding-left: 5px;
  }

  #tabel_serverside > tbody > tr:hover
  {
    background-color: rgba(9, 209, 255, 0.64);
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Stok</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url("administrator") ?>">Home</a></li>
          <li class="breadcrumb-item active">Stok</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">  
          <div class="card border border-primary">
            <div class="card-header bg-primary">
              <div class="xinfo"></div>
              <h3 class="card-title">Semua Stok</h3>
            </div><!-- /.card-header -->
            <div class="card-body">
              <input class="mtcsrf" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
              <!-- DATATABLES -->
              <div class="row">
                <div class="col-sm-12">
                  <table id="tabel_serverside" class="table table-bordered table-striped table-condensed" style="width: 100%">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Nama Produk</th>
                        <th>Stok Awal</th>
                        <th>Stok Akhir</th>
                        <th>Dibuat</th>
                        <th>Diperbarui</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                </table>
              </div>
            </div>
          </div><!-- /.card-body -->
        </div>
      </div><!-- /.col-sm-12 -->
    </div>
  </div>
</section>
<!-- /.content -->
<div id="dialog-form" title="Edit Stok"> 
  <form>
    <input type="hidden" id="id-e" name="id">
    <div class="form-group row">
      <label for="nama" class="col-12 col-form-label">Nama Produk :</label>
      <div class="col-12">
        <input type="text" name="nama" id="nama-e" class="form-control text ui-widget-content" disabled>
      </div>
    </div>
    <div class="form-group row">
      <label for="qty" class="col-2 col-form-label">Stok Awal</label>
      <div class="col-10">
        <input type="text" name="qty" id="stoks-e" class="form-control text ui-widget-content">
      </div>
    </div>
    <div class="form-group row">
      <label for="total" class="col-2 col-form-label">Stok Akhir</label>
      <div class="col-10">
        <input type="text" name="total" id="stoke-e" class="form-control text ui-widget-content" disabled>
      </div>
    </div>
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
  </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= site_url('asset/jquery-ui/jquery-ui.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url("asset/sweetalert2/sweetalert2.all.min.js") ?>"></script>
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
      'columnDefs': [
        {
          responsivePriority: 1,
          targets: [0],
          data : 'no',
          orderable: false,
          width: '5%'
        },
        {
          responsivePriority: 2,
          targets: [1],
          data : 'nama',
          render: function ( data, type, row ) {
            return '<div>' + data + '</div>';
          },
          width: '30%'
        },
        {
          responsivePriority: 3,
          targets: [2],
          data : 'stok_awal',
          title : 'Stok Awal',
          width: '5%'
        },
        {
          responsivePriority: 4,
          targets: [3],
          data : 'stok_akhir',
          title : 'Stok Akhir',
          width: '5%'
        },
        {
          responsivePriority: 5,
          className: "min-tablet",
          targets: [4],
          data : 'created_at',
          title : 'Dibuat'
        },
        {
          responsivePriority: 6,
          className: "min-tablet",
          targets: [5],
          data : 'updated_at',
          title : 'Diperbarui'
        },
        {
          responsivePriority: 7,
          data:'id_stok',
          targets: [-1],
          className: "min-tablet dt-center",
          render: function ( data, type, row ) {
            return `<div class='d-flex flex-row justify-content-around'>
                      <div class='edit-tran'>
                        <button class='btn btn-success btn-sm' title="Edit Data">
                          <i class='fa-solid fa-edit'></i>
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
        'url' : "<?= site_url('administrator/ajdt/stok') ?>",
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
          $("#tabel_serverside").append('<tbody class="tabel_serverside-error"><tr><th colspan="7">Data Tidak Ditemukan di Server</th></tr></tbody>');
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

    // DIALOG-EDIT-DATA
    var dform, form;
    dform = $( "#dialog-form" ).dialog({
      autoOpen: false,
      maxWidth: 800,
      minWidth: 500,
      fluid: true,
      height: "auto",
      modal: true,
      buttons: {
        "Simpan Perubahan": function() {
          editStok()
            .then((data) => {
              csrf.val(data.token);
              Swal.fire('Stok Berhasil Di Edit','','success');
              table.ajax.reload();
            })
            .catch((error) => {
              Swal.fire('Terjadi Kesalahan, harap me-refresh halaman ini','','error');
            });
          dform.dialog( "close" );
        },
        Cancel: function() {
          dform.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
      }
    });

    form = dform.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      editStok()
        .then((data) => {
          csrf.val(data.token);
          Swal.fire('Stok Berhasil Di Edit','','success');
          table.ajax.reload();
        })
        .catch((error) => {
          Swal.fire('Terjadi Kesalahan, harap me-refresh halaman ini','','error');
        });
      dform.dialog("close");
    });

    // END-DIALOG-EDIT-DATA

    // EDIT-DATA-TRANSAKSI
    $('#tabel_serverside tbody').on('click', '.edit-tran', function(e){
      var d = table.row( $(this).parents('tr') ).data();
      var zz = $("#dialog-form").find('input');
      $(zz[0]).val(d.id_stok);
      $(zz[1]).val(d.nama);
      $(zz[2]).val(d.stok_awal);
      $(zz[3]).val(d.stok_akhir);
      $('.ui-dialog').css("z-index", "6666");
      dform.dialog("open");
    });

    
    function editStok(){
      let id = $('#id-e').val();
      let nama = $('#nama-e').val();
      let qty = $('#stoks-e').val();
      // var total = $('#stoke-e').val();
      csrfHash = csrf.val();
      return new Promise((resolve, reject) => {
        $.ajax({
          url: "<?= site_url('administrator/ajdt/stok/edit') ?>",
          type: 'post',
          data: {
            id : id,
            nama : nama,
            stok_awal : qty,
            // stok_akhir : total,
            [csrfName]: csrfHash
          }
        }).done(resolve).fail(reject);
      });
    }
    // END-EDIT-DATA-TRANSAKSI

    $(window).resize(function () {
      fluidDialog();
    });

    // catch dialog if opened within a viewport smaller than the dialog width
    $(document).on("dialogopen", ".ui-dialog", function (event, ui) {
        fluidDialog();
    });

    function fluidDialog() {
        var $visible = $(".ui-dialog:visible");
        // each open dialog
        $visible.each(function () {
            var $this = $(this);
            var dialog = $this.find(".ui-dialog-content").data("ui-dialog");
            // if fluid option == true
            if (dialog.options.fluid) {
                var wWidth = $(window).width();
                // check window width against dialog width
                if (wWidth < (parseInt(dialog.options.maxWidth) + 50))  {
                    // keep dialog from filling entire screen
                    $this.css("max-width", "90%");
                } else {
                    // fix maxWidth bug
                    $this.css("max-width", dialog.options.maxWidth + "px");
                }
                //reposition dialog
                dialog.option("position", dialog.options.position);
            }
        });

    }

  });
</script>
<?= $this->endSection() ?>