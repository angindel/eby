<?php 
$ds =[];
$ds = session()->getFlashdata('_ci_validation_errors');
?>
<?= $this->extend('backend/layout/admin/dashboard_layout') ?>
<?= $this->section('content') ?>
    <!-- Main content -->
    <section class="content">
      <div class="container">
          <div class="card">
              <div class="card-header">
                  <h3>Edit Kategori</h3>
              </div>
              <div class="card-body">
                  <?= form_open_multipart('administrator/proses_edit_kategori') ?>
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
                          <div class="preview w-50 h-50">
                            <label>Saat ini : </label>
                            <img src="<?= base_url("uploads/kategori/$edit->gambar") ?>" class="img-thumbnail">
                          </div>
                          <input type="file" class="form-control" id="gambar" name="gambar" value="<?= old('gambar') ?>">
                      </div>

                      <div class="form-group">
                          <input type="submit" value="Simpan" class="btn btn-info" />
                      </div>

                  </form>
              </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
<?= $this->endSection('content') ?>

<?= $this->section('cdn-foot') ?>
<script type="text/javascript">
  
</script>
<?= $this->endSection() ?>