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

  .ui-autocomplete {
    max-height: 150px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 150px;
  }

.cv-spinner {
  position: absolute;
  background: rgba(0,0,0,0.6);
  z-index: 101;
  height: 150px;
  display: none;
}
.spinner {
  position:absolute;
  display:block;
  width: 40px;
  height: 40px;
  border: 4px #ddd solid;
  border-top: 4px #2e93e6 solid;
  border-radius: 50%;
  animation: sp-anime 0.8s infinite linear;
}
@keyframes sp-anime {
  100% { 
    transform: rotate(360deg); 
  }
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
        <h1>Transaksi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url("administrator") ?>">Home</a></li>
          <li class="breadcrumb-item active">Transaksi</li>
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
            <h3 class="card-title">Semua Transaksi</h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <input class="mtcsrf" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <div class="row">
							<div class="col-sm-12">
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
    	</div>
  	</div>
	</div>
</section>
<!-- /.content -->
<!-- MODAL TRANSAKSI -->
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
          <div id="clist">
            <div class="cv-spinner">
              <span class="spinner"></span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Qty : </label>
          <input type="text" class="form-control" id="qty_t">
          <small id="qty_help" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
          <label>Total : </label>
          <input type="text" class="form-control" id="total_t" disabled>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="simpan" disabled>Simpan</button>
      </div>
    </div>
  </div>
</div>
<!-- END-MODAL -->
<div id="dialog-form" title="Edit Transaksi"> 
  <form>
    <input type="hidden" id="id-e" name="id">
    <div class="form-group row">
      <label for="nama" class="col-12 col-form-label">Nama Produk :</label>
      <div class="col-12">
        <input type="text" name="nama" id="nama-e" class="form-control text ui-widget-content" disabled>
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
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= site_url('asset/jquery-ui/jquery-ui.js') ?>"></script>
<script type="text/javascript" src="<?= base_url("asset/sweetalert2/sweetalert2.all.min.js") ?>"></script>
<script type="text/javascript">
  let csrf = $('.mtcsrf');
  let csrfName = csrf.attr('name');
  let csrfHash = csrf.val();
  $(function(){
    // START-DATATABLES
    var _total;
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
          width : '30%'
        },
        {
        	responsivePriority: 3,
          targets: [2],
          data : 'qty',
          width: '5%'
        },
        {
        	responsivePriority: 4,
          targets: [3],
          data : 'total',
          width: '10%'
        },
        {
        	responsivePriority: 5,
          data:'id_mtran',
          targets: [-1],
          className: "min-tablet dt-center",
          title: 'Action',
          render: function ( data, type, row ) {
            return `<div class='d-flex flex-row justify-content-around'>
											<div class='edit-tran'>
												<button class='btn btn-success btn-sm' title="Edit Data">
													<i class='fa-solid fa-edit'></i>
												</button>
											</div>
											<div class='hapus-tran'>
												<button class='btn btn-danger btn-sm' title='Delete Data'><i class='fa-solid fa-trash'></i>
												</button>
											</div>
									</div>`;
          },
          orderable: false,
          width: '5%'
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
			"dom" : "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [
				{
					text: '<i class="fa-solid fa-plus fa-xl"></i> Transaksi',
					action: (e, dt, node, config) => {
						$('#modaltran').modal('show');
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
          editTran()
            .then((data) => {
                csrf.val(data.token);
                Swal.fire('Transaksi Berhasil Di Edit','','success');
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

    // DI PROSES APABILA MENEKAN ENTER
    form = dform.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      editTran()
        .then((data) => {
            csrf.val(data.token);
            Swal.fire('Transaksi Berhasil Di Edit','','success');
            table.ajax.reload();
        })
        .catch((error) => {
          Swal.fire('Terjadi Kesalahan, harap me-refresh halaman ini','','error');
        });
      dform.dialog("close");
    });

    // END-DIALOG-EDIT-DATA

    // EDIT-DATA-TRANSAKSI
    table.on('click', '.edit-tran', function(){
      let cr = $( this ).parents('tr');
      if( cr.hasClass('child') ) {
        cr = cr.prev()
      }
      let d = table.row( cr ).data();
      let _e = $("#dialog-form").find('input');
      $(_e[0]).val(d.id_mtran);
      $(_e[1]).val(d.nama);
      $(_e[2]).val(d.qty);
      $(_e[3]).val(d.total);
      _total = (d.total > 1 ) ? d.total / d.qty : d.total;
      $('.ui-dialog').css("z-index", "6666");
      dform.dialog("open");
    });

    
    function editTran(){
      let id = $('#id-e').val();
      let nama = $('#nama-e').val();
      let qty = $('#qty-e').val();
      let total = $('#total-e').val();
      csrfHash = csrf.val();
      return new Promise((resolve, reject) => {
        $.ajax({
          url: "<?= site_url('administrator/ajdt/mtran/edit') ?>",
          type: 'post',
          data: {
            id : id,
            nama : nama,
            qty : qty,
            total : total,
            [csrfName]: csrfHash
          }
        }).done(resolve).fail(reject);
      });
    }
    // END-EDIT-DATA-TRANSAKSI


    table.on('click', '.hapus-tran', function(){
      let cr = $( this ).parents('tr');
      if( cr.hasClass('child') ) {
        cr = cr.prev()
      }
      let d = table.row( cr ).data();
      Swal.fire({
        title : 'Yakin Untuk Menghapus Data Ini?',
        icon: 'info',
        html:
        `Nama Produk : <u class="text-danger"><b>${d.nama}</b></u><br>
        Qty : <u class="text-danger"><b>${d.qty}</b></u><br>
        Total : <u class="text-danger"><b>${d.total}</b></u>`,
        showCancelButton: true,
        confirmButtonText: 'Hapus',
      }).then((result) => {
        if(result.isConfirmed) {
          csrfHash = csrf.val();
          // PROMISE
          new Promise((resolve, reject) => {
            $.ajax({
              url: window.location.origin + `/administrator/ajdt/mtran/hapus`,
              type: 'post',
              data: { id : d.id_mtran, [csrfName]: csrfHash }
            }).done(resolve).fail(reject);
          }).then((data) => {
            csrf.val(data.token);
            Swal.fire('Transaksi Berhasil Di Hapus','','success');
            table.ajax.reload();
          }).catch(() => {
            Swal.fire('Terjadi Kesalahan','','error');
          });
        }
      });
    });

    let _t_id_produk, _t_nama_produk, _t_qty, _t_total;
    const initModalTran = () => {
      _t_id_produk = $("#id_produk_t");
      _t_nama_produk = $("#nama_t");
      _t_qty = $("#qty_t");
      _t_total = $("#total_t");
    };
    
    initModalTran();

    // AUTOCOMPLETE-NAMA-PRODUK
    var offsetAutoCompleteAjax = 0, endScroll = false;

    $.widget( "ui.autocomplete", $.ui.autocomplete, {
      options:{
        scroll: false,
      },
      _create: function(){
        this._superApply( arguments );
        this._on( this.menu.element, {
          scroll: "_sendAjaxWhenEndScroll"
        } );
      },
      _sendAjaxWhenEndScroll: function(event){
        let eventUiMenu = event;
        if (this.options.scroll)
          {
            let that = this;
            if (this.menu.active)
            {
              event.preventDefault();
              var scrollTop = $(event.target).scrollTop();
              // const {scrollHeight, scrollTop, clientHeight} = event.target;

              // if (Math.abs(scrollHeight - clientHeight - scrollTop) < 1) {
              //     console.log('scrolled');
              // }
              // console.log(scrollTop + parseInt($(event.target).innerHeight()) + 25 + " >= " + event.target.scrollHeight );
              if(scrollTop + parseInt($(event.target).innerHeight()) + 25  >= event.target.scrollHeight && !endScroll)
              {
                csrfHash = csrf.val();
                $(event.target).unbind("scroll");
                $.ajax({
                  url: "<?= route_to('produk.nama') ?>",
                  type:'post',
                  dataType: 'json',
                  data: {
                    nama_s: _t_nama_produk.val(),
                    offset: offsetAutoCompleteAjax,
                    [csrfName]: csrfHash
                  },
                  beforeSend: function(){
                    that.menu.element.css({
                      "overflow-y": "hidden"
                    });
                    $(".cv-spinner").width(_t_nama_produk.outerWidth());
                    $(".spinner").css({
                      "top" : `${(that.menu.element.outerHeight() - $(".spinner").outerHeight()) / 2}px`,
                      "left" : `${(that.menu.element.outerWidth() - $(".spinner").outerWidth()) / 2 }px`
                    });
                    $(".cv-spinner").show();

                  },
                  success: function(data){
                    ++offsetAutoCompleteAjax;
                    endScroll = data.end;
                    if(data.data)
                    {
                      let ui = that._normalize(data.data);
                      var ul = that.menu.element;
                      that._renderMenu( ul, ui );
                      that.menu.refresh();
                      ul.show();
                      that._resizeMenu();
                      let li = that.menu.element.children("li");
                      let ll = (data.data.length < 6) ? $(li[li.length - data.data.length]) : $(li[li.length - 8]);
                    that.menu.focus(eventUiMenu, ll);
                    }
                    that._on( that.menu.element, {
                      scroll: "_sendAjaxWhenEndScroll"
                    } );
                    csrf.val(data.token);
                    that.menu.element.css({
                        "overflow-y": "auto"
                      });
                    $(".cv-spinner").hide();
                    
                    // console.log("success ui.autocomplete tail : " + endScroll);
                    // that.menu._scrollIntoView(ll);
                    // that.menu._addClass( ll, null, "ui-state-active" );
                    
                    
                    // ul.position( $.extend( {
                    //   of: that.element
                    // }, that.options.position ) );
                    // if ( that.options.autoFocus ) {
                    //   that.menu.next();
                    // }

                    // Listen for interactions outside of the widget (#6642)
                    
                    // that._trigger( "scroll", event, {items: ui} );
                  }
                  // error: function(dxhr, ts, et){
                  //   data = JSON.parse(et);
                  //   csrf.val(data.token);
                  //   endScroll = data.end;
                  // }
                });
              }
            }

          }
      },
    });
    var menu = $("#clist > ul"), spinner = $(".spinner");
    $("#nama_t").autocomplete({
      minLength: 2,
      scroll: true,
      source:function(request, response){
        csrfHash = csrf.val();
        offsetAutoCompleteAjax = 0;
        $.ajax({
          url: "<?= route_to('produk.nama') ?>",
          type:'post',
          dataType: 'json',
          data: {
            nama_s: request.term,
            offset: offsetAutoCompleteAjax,
            [csrfName]: csrfHash
          },
          beforeSend: function(){
            menu.css({
              "overflow-y": "hidden"
            });
            $(".cv-spinner").width($("#nama_t").outerWidth());
            let _top = ( 150 - spinner.outerHeight() ) / 2;
            spinner.css({
              "top" : `${_top}px`,
              "left" : `${($("#nama_t").outerWidth() - spinner.outerWidth()) / 2 }px`
            });
            $(".cv-spinner").show();
          },
          success: function(){
            offsetAutoCompleteAjax += 1;
            menu.css({
                "overflow-y": "auto"
              });
            $(".cv-spinner").hide();
            endScroll = false;
          },
          error: function(xhr, ts, et){
            if(xhr.responseJSON)
            {
              data = xhr.responseJSON;
              csrf.val(data.token);
            }
            endScroll = false;
            response( [] );
          },
          complete: function(xhr, ts)
          {
            if(xhr.responseJSON)
            {
              let data = xhr.responseJSON;
              // console.log(data.data);
              csrf.val(data.token);
              response(data.data);
            }
            else
            {
              response([]);
            }
          }
        });
      },
      focus:function(event, ui){
        // $("#nama_t").val(ui.item.label);
        return false;
      },
      select: function(event, ui){
        $("#nama_t").val(ui.item.label);
        $("#id_produk_t").val(ui.item.value);
        const promiseSA = fetch("http://ebykarya.local/administrator/ambil_sa/"+ui.item.value);
        promiseSA.then(res => {
          if (res.ok) {
            return res.json();
          }
          throw new Error("Stok Tidak Ada/ Terjadi Kesalahan Pada saat mengambil data Stok");
        }).then(stok => {
          if(parseInt(stok.stok_akhir) === 0)
          {
            $("#qty_t").prop("disabled", true);
            $("#qty_help").html(`<div class="text-danger">tidak ada stok tersedia untuk produk ini.!!!, harap tambahkan stok untuk bisa menambahkan transaksi.</div>`);
            $("#total_t").val("");
          }
          else
          {
            $("#qty_t").prop("disabled", false);
            $("#qty_t").val(1);
            $("#qty_help").html(`<div class="text-info">stok untuk produk ini tersisa : <b>${stok.stok_akhir}</b> , jgn input melebihi stok yang ada.</div>`);
            $("#total_t").val(ui.item.harga);
            $("#simpan").prop("disabled", false);
          }          
        }).catch(error => {
          $("#qty_t").prop("disabled", true);
          $("#qty_help").html(`<div class="text-danger">${error}</div>`);
          $("#total_t").val("");
        });
        
        _total = ui.item.harga;
        return false;
      },
      appendTo: "#clist",
    }).focus(function() {
      if($(this).val().trim() === "")
      {
        $(this).autocomplete("search", $(this).val());
      }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
      let _lb = item.lbl;
      // _lb = _lb.toLowerCase().replace(/(?<!<[^>]*)\b[a-z]/g, function(_lb) {
      //   return _lb.toUpperCase();
      // });
      // _lb = _lb.replace(/#/gi, '<b>').replace(/%/gi, '</b>');
      return $( "<li>" )
        .append( "<div>" + _lb + "</div>" )
        .appendTo( ul );
    };
    // END-AUTOCOMPLETE-NAMA-PRODUK

    $('#modaltran').on('hide.bs.modal', function(e){
      $('#id_produk_t').val("");
      $('#nama_t').val("");
      $('#qty_t').val("");
      $('#total_t').val("");
      $("#qty_help").html("");
      $('#simpan').prop('disabled', true);
    });
    $('#modaltran').on('shown.bs.modal', function(e){
      $("#nama_t").trigger("focus");
    });


    $("#qty_t").on("change paste keyup", function() {
      var _v = $(this);
      if( !(!$.trim($("#qty_t").val())) || _v.val() === '' )
      {
        ( Number.isInteger( parseInt(_v.val()) ) ) ? $("#total_t").val( _total * parseInt(_v.val()) ) : $("#total_t").val("");
      }
    });

    $("#qty-e").on("change paste keyup", function() {
      var _v = $(this);
      if( !(!$.trim(_v.val())) || _v.val() === '' )
      {
        ( Number.isInteger( parseInt(_v.val()) ) ) ? $("#total-e").val( _total * parseInt(_v.val()) ) : $("#total-e").val("");
      }
    });

    function cekInput(e) {
      let nama_t = $('#nama_t').val().trim();
      let qty_t = $('#qty_t').val().trim();
      let total_t = $('#total_t').val().trim();
      let status = $('#simpan').prop('disabled');
      if(nama_t === '')
      {
        $('#qty_t').val("");
        $('#total_t').val("");
      }
      if(nama_t === '' || qty_t === '' || total_t === '' || parseInt(qty_t) === 0)
      {
        // console.log("kosong : " + status);
        (!status) ? $('#simpan').prop('disabled', true) : status;
      }
      else
      {
        // console.log("false : " + status);
        (status) ? $('#simpan').prop('disabled', false) : status;
      }
    };
    $('#modaltran .form-group input').on('keyup', cekInput );
    $('#clist > ul').on('click', cekInput );

    // PROSES-TAMBAH-DATA-TRANSAKSI
    $('#simpan').on('click', function(e) {
      e.preventDefault();
      let id_produk_t = $('#id_produk_t').val();
      let nama_t = $('#nama_t').val();
      let qty_t = $('#qty_t').val();
      let total_t = $('#total_t').val();
      Swal.fire({
        title : 'Yakin Untuk Menambahkan Transaksi Ini?',
        html:
        `Nama Produk : <b>${nama_t}</b><br>Qty : <b>${qty_t}</b><br>Total : <b>${total_t}</b><br>`,
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Tambahkan',
        denyButtonText: 'Batalkan',
      }).then((result) => {
        if(result.isConfirmed) {
          csrfHash = csrf.val();
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
              Swal.fire('Transaksi Berhasil Di Tambahkan','','success');
              $('#modaltran').modal('hide');
              var alert =`<div class="alert alert-success alert-dismissible fade show" role="alert">Tambah Transaksi Berhasil<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
              $('.xinfo').html(alert);
              setTimeout(function(){
                $('.xinfo').html("");
              },7000);
              table.ajax.reload();
            }
          });
        } else if (result.isDenied) {
          Swal.fire('Perubahan Belum Di Tambahkan','','info');
          $('#modaltran').modal('hide');
        }
      });
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