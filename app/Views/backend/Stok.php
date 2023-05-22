<?= $this->extend('layout/admin/dashboard_layout') ?>
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
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
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
        <input type="text" name="total" id="stoke-e" class="form-control text ui-widget-content">
      </div>
    </div>
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
  </form>
</div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <div class="xinfo"></div>
                  <h3 class="box-title">Semua Stok</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <input class="mtcsrf" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                  <!-- DATATABLES -->
                  <table id="tabel_serverside" class="table table-bordered table-striped table-condensed" style="width: 100%">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Nama Produk</th>
                        <th>Stok Awal</th>
                        <th>Stok Akhir</th>
                        <th></th>
                      </tr>
                    </thead>
                </table>
              </div><!-- /.box-body -->
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
      'columnDefs': [
        {
          targets: [0],
          data : 'no',
        },
        {
          targets: [1],
          data : 'nama',
        },
        {
          targets: [2],
          data : 'stok_awal',
          title : 'Stok Awal'
        },
        {
          targets: [3],
          data : 'stok_akhir',
          title : 'Stok Akhir'
        },
        {
          data:'id_stok',
          targets: [-1],
          className: "dt-center",
          render: function ( data, type, row ) {
            return '<div class="row"><div class="col-6"><i id="edit-tran" class="fa fa-pencil"></i></div><div class="col-6"></div></div>';
          },
          orderable: false
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
          editTran();
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
      editTran();
      dform.dialog("close");
    });

    // END-DIALOG-EDIT-DATA

    // EDIT-DATA-TRANSAKSI
    $('#tabel_serverside tbody').on('click', 'i.fa-pencil', function(e){
      var d = table.row( $(this).parents('tr') ).data();
      var zz = $("#dialog-form").find('input');
      $(zz[0]).val(d.id_stok);
      $(zz[1]).val(d.nama);
      $(zz[2]).val(d.stok_awal);
      $(zz[3]).val(d.stok_akhir);
      $('.ui-dialog').css("z-index", "6666");
      dform.dialog("open");
    });

    
    function editTran(){
      var id = $('#id-e').val();
      var nama = $('#nama-e').val();
      var qty = $('#stoks-e').val();
      var total = $('#stoke-e').val();
      csrfHash = csrf.val();
       $.ajax({
          url: "<?= site_url('administrator/ajdt/stok/edit') ?>",
          type: 'post',
          data: {
            id : id,
            nama : nama,
            stok_awal : qty,
            stok_akhir : total,
            [csrfName]: csrfHash
          },
          success: function(data){
            csrf.val(data.token);
            table.ajax.reload();
          }
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