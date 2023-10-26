<?php 
$ds =[];
$ds = session()->getFlashdata('_ci_validation_errors');
?>
<?= $this->extend('backend/layout/admin/dashboard_layout') ?>
<?= $this->section('content') ?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Kategori</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url("{$l[0]}") ?>">Home</a></li>
          <li class="breadcrumb-item "><a href="<?= base_url("{$l[0]}/{$l[1]}") ?>">Kategori</a></li>
          <li class="breadcrumb-item active">Edit Kategori</li>
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
            <h3 class="card-title">Edit Kategori</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
            <?= form_open_multipart('administrator/kategori/edit/process') ?>
              <input type="hidden" name="id" value="<?= $edit->id_kategori_produk ?>">
              <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <?php if(empty($ds['nama_kategori']) ) : ?>
                <input type="text" id="nama_kategori" class="form-control" name="nama_kategori" value="<?= $result = old('nama_kategori') ?: $edit->nama_kategori ?>">
                <?php else: ?>
                <input type="text" class="form-control is-invalid" id="nama_kategori" name="nama_kategori" value="<?= old('nama_kategori') ?>">
                <div class="invalid-feedback"><?= $ds['nama_kategori'] ?></div>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="gambar">Gambar</label>
                <div class="preview">
                  <div class="row">
                    <div class="col-6">
                      <div class="row">
                        <div class="col-12">
                          <label>Saat ini : </label>
                        </div>
                        <div class="col-12">
                          <img src="<?= base_url("uploads/kategori/$edit->gambar") ?>" class="img-thumbnail">
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="row">
                        <div class="col-12">
                          <label>Diganti Dengan : </label>
                        </div>
                        <div class="col-12">
                          <img id="img-preview" class="img-thumbnail">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="file" class="form-control" id="gambar" name="gambar" value="<?= old('gambar') ?>">
              </div>


              <div class="form-group">
                <input id="simpan" type="submit" value="Simpan" class="btn btn-info" />
              </div>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div><!-- /.card -->
  </div><!-- /.container-fluid -->
</section><!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('link') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url("asset/sweetalert2/sweetalert2.min.css") ?>">
<?= $this->endSection() ?>

<?= $this->section("script") ?>
<script type="text/javascript" src="<?= base_url("asset/sweetalert2/sweetalert2.all.min.js") ?>"></script>
<script type="text/javascript">
  $(() => {
    $('#gambar').on('change', function(e){
        e.preventDefault();
        console.log(e);
        var reader = new FileReader();
        reader.onload = function(event){
            $('#img-preview').attr("src", event.target.result);
            console.log(event);
        };
        reader.readAsDataURL(event.target.files[0]);
        $("#img-preview").addClass("border border-primary");

    });

    $("#simpan").on("click", (e) => {
      e.preventDefault();
      var nk = $("#nama_kategori").val();
      var _g = $('#gambar').prop('files')[0];
      if(nk.trim() == '' || typeof _g == "undefined")
      {
        Swal.fire({
          title: 'Peringatan!',
          html: "<b>Harap Isi Semua Form nya.!!!",
          icon: 'warning',
          showCancelButton: true,
          showConfirmButton: false,
          cancelButtonColor: '#d33',
          cancelButtonText: 'Kembali',
        });
      }
      else
      {
        $("#simpan").unbind('click').click();
      }
    });
  });
</script>

<?= $this->endSection() ?>