<?php $ds =[] ;$ds = session()->getFlashdata('_ci_validation_errors') ?>
<?= $this->extend('backend/layout/admin/dashboard_layout') ?>
<?= $this->section('content') ?>
    <!-- Main content -->
    <section class="content">
      <div class="container">
          <div class="card">
              <div class="card-header">
                  <h3>Tambah Kategori</h3>
              </div>
              <div class="card-body">
                <?= form_open_multipart('administrator/proses_tambah_kategori') ?>

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