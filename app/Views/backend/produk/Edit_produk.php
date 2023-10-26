<?php 
$ds = session()->getFlashdata("error");
?>
<?= $this->extend('backend/layout/admin/dashboard_layout') ?>

<?= $this->section('link') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url("asset/sweetalert2/sweetalert2.min.css") ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Produk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url("administrator") ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url("administrator/produk") ?>">Produk</a></li>
                    <li class="breadcrumb-item active">Edit Produk</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="card border border-primary">
			<div class="card-header bg-primary">
				<h3 class="card-title">Edit Produk</h3>
			</div>
			<div class="card-body">
				<div class="row">
      		<div class="col-sm-12">
      			<?= form_open_multipart() ?>
      				<input type="hidden" name="id" value="<?= $edit->id_produk ?>">

              <div class="form-group">
              	<label for="kategori_produk">Kategori</label>
              	<select name='kategori_produk' class='form-control' required>
              		<option value='' selected>- Pilih Kategori Produk -</option>";
              		<?php foreach ($kategori_produk as $row) : ?>
              		<?php if($row->id_kategori_produk == $edit->id_kategori_produk) : ?>
              		<option value="<?= $row->id_kategori_produk ?>" selected> <?= $row->nama_kategori ?></option>
                  <?php else : ?>
                  <option value="<?= $row->id_kategori_produk ?>"> <?= $row->nama_kategori ?></option>
                  <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $edit->nama_produk ?>">
              </div>

              <div class="form-group">
                <label for="harga_beli">Harga Beli</label>
                <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="<?= $edit->harga_beli ?>">
              </div>

              <div class="form-group">
                <label for="harga_reseller">Harga Reseller</label>
                <input type="text" class="form-control" id="harga_reseller" name="harga_reseller" value="<?= $edit->harga_reseller ?>">
              </div>

              <div class="form-group">
                <label for="harga_konsumen">Harga Konsumen</label>
                <input type="text" class="form-control" id="harga_konsumen" name="harga_konsumen" value="<?= $edit->harga_konsumen ?>">
              </div>

              <div class="form-group">
                <label for="satuan">Satuan</label>
                <input type="text" class="form-control" id="satuan" name="satuan" value="<?= $edit->satuan ?>">
              </div>

              <div class="form-group">
                <label for="stok">Stok</label>
                <input type="text" class="form-control" id="stok" name="stok" value="<?= $edit->stok ?>">
              </div>

              <div class="form-group">
                <label for="berat">Berat</label>
                <input type="text" class="form-control" id="berat" name="berat" value="<?= $edit->berat ?>">
              </div>

              <div class="form-group f-item">
                <label for="warna">Warna</label>
                <div class="row">
                  <div class="col">
                      <input class="form-control i-item">
                  </div>
                  <div class="col">
                    <button type="button" class="form-control btn btn-info bt-item" onclick="myTes(this)">Add
                    </button>
                  </div>
                </div>
                <div class="d-flex flex-wrap text-center data-item">
                <?php
                    if( is_array($edit->warna) )
                    {
                        foreach($edit->warna as $val)
                        {
                            echo <<<EOT
                            <div class="d-flex mr-2">
                                <div class="border border-2 rounder bg-primary p-2 v-item">$val</div>
                                <button class="fa fa-close b-item"></button>
                            </div>
                            <input type="hidden" name="warna[]" value="$val">
                            EOT;
                        }
                    }
                    else
                    {
                      if(!empty($edit->warna))
                      {
                        echo <<<EOT
                            <div class="d-flex mr-2">
                                <div class="border border-2 rounder bg-primary p-2 v-item">$edit->warna</div>
                                <button class="fa fa-close b-item"></button>
                            </div>
                            <input type="hidden" name="warna[]" value="$edit->warna">
                            EOT;
                      }
                    }
                ?>
                </div>
              </div>

              <div class="form-group f-item">
                <label for="size">Size</label>
                  <div class="row">
                    <div class="col">
                        <input class="form-control i-item">
                    </div>
                    <div class="col">
                      <button type="button" class="form-control btn btn-info bt-item" onclick="myTes(this)">Add</button>
                    </div>
                  </div>
                  <div class="d-flex flex-wrap text-center data-item">
                  <?php
                      if( is_array($edit->size) )
                      {
                          foreach($edit->size as $val)
                          {
                              echo <<<EOT
                              <div class="d-flex mr-2">
                                  <div class="border border-2 rounder bg-primary p-2 v-item">$val</div>
                                  <button class="fa fa-close b-item"></button>
                              </div>
                              <input type="hidden" name="size[]" value="$val">
                              EOT;
                          }
                      }
                      else
                      {
                        if(!empty($edit->size))
                        {
                          echo <<<EOT
                              <div class="d-flex mr-2">
                                  <div class="border border-2 rounder bg-primary p-2 v-item">$edit->size</div>
                                  <button class="fa fa-close b-item"></button>
                              </div>
                              <input type="hidden" name="size[]" value="$edit->size">
                              EOT;
                        }
                      }
                  ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea class="form-control" id="keterangan" name="keterangan"><?= $edit->keterangan ?></textarea>
                </div>

	              <div class="form-group">
                  <label for="gambar">Gambar</label>
                  <div class="preview w-50 h-50">
                    <label>Saat ini : </label>
                    <img src="<?= base_url("uploads/produk/$edit->gambar") ?>" class="img-thumbnail">
                  </div>
                  <input type="file" class="form-control" id="gambar" name="gambar">
              </div>

              <div class="form-group">
                <input type="button" id="bt-proses" value="Simpan" class="btn btn-info" />
              </div>
            <?= form_close() ?>
          </div>
        </div>
      </div><!-- /.card-body -->
    </div>
  </div>
</section>
  <!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script type="text/javascript" src="<?= base_url("ckeditor5/ckeditor.js") ?>"></script>
<script type="text/javascript" src="<?= base_url("asset/sweetalert2/sweetalert2.all.min.js") ?>"></script>
<script type="text/javascript">
  const d = {warna: [], size: []}
  let csrf = $(`input[name="<?= csrf_token() ?>"]`);
  let csrfName = csrf.attr('name');
  let csrfHash = csrf.val();

  function myTes(_this){
      var _tipe = $(_this).parents(".f-item").children("label").text().toLowerCase();
      var _item = $(_this).parents(".f-item").find(".i-item");
      var _v = _item.val().trim();
      _v = (_tipe == "warna") ?_v.charAt(0).toUpperCase() + _v.slice(1) : _v.toUpperCase();
      var _x = (_tipe == "warna") ? d.warna : d.size;
      if( !(_x.length === 0) ){
        if($.inArray(_v, _x ) != -1 || _v == "")
        {
          (_v == "" ) ? alert("tidak boleh kosong") : alert("data sudah ada");
          _item.val("");
          _item.trigger("focus");
          return false;
        }
      }
      _x.push(_v);
      $(_this).parents(".f-item").find(".data-item").append(`<div class="d-flex mr-2"><div class="border border-2 rounder bg-primary p-2 v-item">${_v}</div><button class="fa fa-close b-item"></button></div><input type='hidden' name='${_tipe}[]' value="${_v}">`);
      _item.val("");
      _item.trigger("focus");
  }

  $(document).ready(function(){
    let editor;

    ClassicEditor
      .create( document.querySelector( '#keterangan' ), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
      } )
      .then( newEditor => {
        editor = newEditor;
      } )
      .catch( err => {
        console.error( err.stack );
      } );

    $("input").keypress(function(e){
        var key = e.keyCode || e.which;
        if(key == 13)
        {
            e.preventDefault();
        }
    });

    $(".f-item").on("click", ".b-item", function(){
        var tipe = $(this).parents(".f-item").children("label").text().toLowerCase();
        var x = (tipe == "warna") ? d.warna : d.size;

      var z = $(this).parent().find('.v-item').text() 
      x.splice($.inArray(z, x ), 1);
      $(this).parents('.f-item').find(`input[value="${z}"]`).remove();
      $(this).parent().remove();
    });

    $('.i-item').on('keydown', function(e){
      var keyCode = e.keyCode || e.which;
      if(keyCode == 13){
        e.preventDefault();
        $(this).parents(".f-item").find(".bt-item").trigger("click");
      }
    });

    $('#bt-proses').on('click', function(e){
      e.preventDefault();
      csrfHash = csrf.val();

      var _id = $('input[name="id"]').val();
      var _kt = $('select[name="kategori_produk"]').find(":selected").val();
      var _np = $('input[name="nama_produk"]').val();
      var _hb = $('input[name="harga_beli"]').val();
      var _hr = $('input[name="harga_reseller"]').val();
      var _hk = $('input[name="harga_konsumen"]').val();
      var _sa = $('input[name="satuan"]').val();
      var _st = $('input[name="stok"]').val();
      var _b = $('input[name="berat"]').val();
      var _warna = $('input[name="warna[]"]');
      var _w = new Array();
      if( _warna.length > 0 )
      {
        for(let i = 0; i < _warna.length; i++) {
          _w.push( $(_warna[i]).val() );
        }
      }
      var _size = $('input[name="size[]"]');
      var _s = new Array();
      if( _size.length > 0 )
      {
        for(let i = 0; i < _size.length; i++) {
          _s.push( $(_size[i]).val() );
        }
      }
      const _ket = editor.getData();
      var _g = $('#gambar').prop('files')[0];
      let formdata = new FormData();
      formdata.append('edit', 1);
      formdata.append('id', _id);
      formdata.append('kategori_produk', _kt);
      formdata.append('nama_produk', _np);
      formdata.append('harga_beli', _hb);
      formdata.append('harga_reseller', _hr);
      formdata.append('harga_konsumen', _hk);
      formdata.append('satuan', _sa);
      formdata.append('stok', _st);
      formdata.append('berat', _b);
      formdata.append('warna', _w);
      formdata.append('size', _s);
      formdata.append('keterangan', _ket);
      formdata.append('gambar', _g);
      formdata.append(`${csrfName}`, csrfHash);
      
      $.ajax({
        url: "<?= base_url('administrator/produk/proses_edit') ?>",
        type: "POST",
        data: formdata,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(data){
          csrf.val(data.token);
          Swal.fire({
            title: 'Berhasil',
            text: 'Data Berhasil Di Simpan',
            icon: 'success',
            confirmButtonText: 'Lanjutkan'
          }).then((result) => {
            if(result.isConfirmed) {
              window.location.href= data.uri;
            }
          });
        },
        error: function(e){
          var _msg = e.responseJSON.messages;
          csrf.val(_msg.token);
          Swal.fire({
            title: 'Peringatan!',
            html: _msg.error,
            icon: 'warning',
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonColor: '#d33',
            cancelButtonText: 'Kembali',
          });
        }
      });

    });

  });
</script>

<?= $this->endSection('content') ?>