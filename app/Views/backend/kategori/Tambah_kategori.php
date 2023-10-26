<?php $ds =[] ;$ds = session()->getFlashdata('_ci_validation_errors') ?>
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
          <li class="breadcrumb-item active">Tambah Kategori</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<!-- Main content -->
      <div class="container-fluid">
          <div class="card border border-primary">
              <div class="card-header bg-primary">
                  <h3 class="card-title">Tambah Kategori</h3>
              </div>
              <div class="card-body">
              	<div class="row">
              		<div class="col-sm-12">
                <?= form_open_multipart('administrator/kategori/add/process') ?>

                      <div class="form-group">
                          <label for="nama_kategori">Nama Kategori</label>
                          <?php if(empty($ds['nama_kategori']) ) : ?>
                          <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= old('nama_kategori') ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="nama_kategori" name="nama_kategori" value="<?= old('nama_kategori') ?>">
                          <div id="nama_kategori" class="invalid-feedback"><?= $ds['nama_kategori'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
	                        <label for="gambar">Gambar</label>
	                        <div class="preview w-50 h-50">
	                          <img id="img-preview" src="" class="img-thumbnail">
	                        </div>
	                        <input type="file" class="form-control " id="gambar" name="gambar" value="<?= old('gambar') ?>" >
	                  	</div>

                      <div class="form-group">
                          <div class="text-center">
                          	<input id="simpan" type="submit" value="Simpan" class="btn btn-lg btn-info" />
                          </div>
                      </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
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