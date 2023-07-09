<?php $ds =[] ;$ds = session()->getFlashdata('_ci_validation_errors') ?>
<?= $this->extend('layout/admin/dashboard_layout') ?>
<?= $this->section('content') ?>
    <!-- Main content -->
    <section class="content">
      <div class="container">
          <div class="card">
              <div class="card-header">
                  <h3>Tambah Payment Channel</h3>
              </div>
              <div class="card-body">
                <?= form_open_multipart("administrator/{$url_web}/proses_tambah") ?>

                      <div class="form-group">
                          <label for="nama_kategori">Nama <?= $box_title ?></label>
                          <?php if(empty($ds['nama']) ) : ?>
                          <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="nama" name="nama" value="<?= old('nama') ?>">
                          <div id="nama" class="invalid-feedback"><?= $ds['nama'] ?></div>
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