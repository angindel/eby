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
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div id="dialog-form" title="Edit Transaksi"> 
  <form>
    <input type="hidden" id="id-e" name="id">
    <div class="form-group row">
      <label for="nama" class="col-12 col-form-label">Nama Produk :</label>
      <div class="col-12">
        <input type="text" name="nama" id="nama-e" class="form-control text ui-widget-content">
      </div>
    </div>
    <div class="form-group row">
      <label for="qty" class="col-2 col-form-label">Qty</label>
      <div class="col-10">
        <input type="text" name="qty" id="qty-e" class="form-control text ui-widget-content">
      </div>
    </div>
    <div class="form-group row">
      <label for="total" class="col-2 col-form-label">Total</label>
      <div class="col-10">
        <input type="text" name="total" id="total-e" class="form-control text ui-widget-content">
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
                  <h3 class="box-title">Semua Transaksi</h3>
                  <button type="button" class="pull-right btn btn-primary btn-sm" data-toggle="modal" data-target="#modaltran">
                    Transaksi Modal
                  </button>
                  <!-- MODAL -->
                  <div class="modal fade" id="modaltran" tabindex="-1" aria-labelledby="modalTranLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTranLabel">Modal Transaksi</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="id_produk" id="id_produk_t">
                          <div class="form-group">
                            <label>Nama Produk : </label>
                            <input type="text" class="form-control" id="nama_t">
                            <div id="clist"></div>
                          </div>
                          <div class="form-group">
                            <label>Qty : </label>
                            <input type="text" class="form-control" id="qty_t">
                          </div>
                          <div class="form-group">
                            <label>Total : </label>
                            <input type="text" class="form-control" id="total_t">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" id="simpan">Simpan</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- END-MODAL -->
                  <div id="dialog-confirm" title="Hapus Data">
                    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Apakah Anda Yakin Untuk Menghapus Data Ini?</p>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <input class="mtcsrf" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                  <table id="tabel_serverside" class="table table-bordered table-striped table-condensed" style="width: 100%">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Nama Produk</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th></th>
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
          data : 'qty',
        },
        {
          targets: [3],
          data : 'total',
        },
        {
          data:'id_mtran',
          targets: [-1],
          className: "dt-center",
          render: function ( data, type, row ) {
            return '<div class="row"><div class="col-6"><i id="edit-tran" class="fa fa-pencil"></i></div><div class="col-6"><i id="hapus-tran" class="fa fa-trash"></i></div></div>';
          },
          orderable: false
        },
      ],
      order: [[0,'desc']],
      'ajax' : {
        'url' : "<?= site_url('administrator/ajdt/mtran') ?>",
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
      $(zz[0]).val(d.id_mtran);
      $(zz[1]).val(d.nama);
      $(zz[2]).val(d.qty);
      $(zz[3]).val(d.total);
      $('.ui-dialog').css("z-index", "6666");
      dform.dialog("open");
    });

    
    function editTran(){
      var id = $('#id-e').val();
      var nama = $('#nama-e').val();
      var qty = $('#qty-e').val();
      var total = $('#total-e').val();
      csrfHash = csrf.val();
       $.ajax({
          url: "<?= site_url('administrator/ajdt/mtran/edit') ?>",
          type: 'post',
          data: {
            id : id,
            nama : nama,
            qty : qty,
            total : total,
            [csrfName]: csrfHash
          },
          success: function(data){
            csrf.val(data.token);
            table.ajax.reload();
          }
        });
    }
    // END-EDIT-DATA-TRANSAKSI

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
                url: "<?= site_url('administrator/ajdt/mtran/hapus') ?>",
                type: 'post',
                data: {
                  id : d.id_mtran,
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

    // AUTOCOMPLETE-NAMA-PRODUK
    $("#nama_t").autocomplete({
      minLength: 3,
      source:function(request, response){
        csrfHash = csrf.val();
        $.ajax({
          url: "<?= route_to('produk.nama') ?>",
          type:'post',
          dataType: 'json',
          data: {
            nama_s: request.term,
            [csrfName]: csrfHash
          },
          success: function(data){
            csrf.val(data.token);
            response(data.data);
          }
        });
      },
      focus:function(event, ui){
        $("#nama_t").val(ui.item.label);
        return false;
      },
      select: function(event, ui){
        $("#nama_t").val(ui.item.label);
        $("#id_produk_t").val(ui.item.value);
        $("#qty_t").val(1);
        $("#total_t").val(ui.item.harga);
        return false;
      },
      appendTo: "#clist",
    });
    // END-AUTOCOMPLETE-NAMA-PRODUK

    // PROSES-TAMBAH-DATA-TRANSAKSI
    $('#simpan').on('click', function(e) {
      e.preventDefault();
      csrfHash = csrf.val();
      var id_produk_t = $('#id_produk_t').val();
      var nama_t = $('#nama_t').val();
      var qty_t = $('#qty_t').val();
      var total_t = $('#total_t').val();
      $.ajax({
        url: "<?= site_url('administrator/ajdt/mtran/tambah') ?>",
        type: 'post',
        data: {
          id_produk : id_produk_t,
          nama: nama_t,
          qty: qty_t,
          total: total_t,
          [csrfName]: csrfHash
        },
        success: function(data){
          csrf.val(data.token);
          $('#modaltran').modal('hide');
          var alert =`<div class="alert alert-success alert-dismissible fade show" role="alert">Tambah Transaksi Berhasil<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
          $('.xinfo').html(alert);
          setTimeout(function(){
            $('.xinfo').html("");
          },7000);
          table.ajax.reload();
        }
      });
    });

    $('#modaltran').on('hide.bs.modal', function(e){
      $('#id_produk_t').val("");
      $('#nama_t').val("");
      $('#qty_t').val("");
      $('#total_t').val("");
    });

    // END-PROSES-TAMBAH-DATA-TRANSAKSI

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