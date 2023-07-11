<?php 
$ds =[];
$ds = session()->getFlashdata('_ci_validation_errors');
?>
<?= $this->extend('layout/admin/dashboard_layout') ?>
<?= $this->section('content') ?>
    <!-- Main content -->
    <section class="content">
      <section class="content-header m-0 pt-1">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-left">
                         <li class="breadcrumb-item"><a href="<?= base_url("{$l[0]}") ?>">Home</a>
                         </li>
                         <li class="breadcrumb-item "><a href="<?= base_url("{$l[0]}/{$l[1]}/{$l[2]}") ?>">Payment Channel</a>
                         </li>
                         <li class="breadcrumb-item active">
                          Edit Data
                         </li>
                     </ol>
                 </div>
             </div>
         </div>
      </section>
      <div class="container">
          <div class="card">
              <div class="card-header">
                  <h3>Edit <?= $box_title ?></h3>
              </div>
              <div class="card-body">
                  <?= form_open_multipart("administrator/{$url_web}/proses_edit") ?>
                      <input type="hidden" name="id" value="<?= $data->id ?>">

                      <div class="form-group">
                          <label for="nama">Nama <?= $box_title ?></label>
                          <?php if(empty($ds['nama']) ) : ?>
                          <input type="text" id="nama" class="form-control" name="nama" value="<?= $result = old('nama') ?: $data->nama ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="nama" name="nama" value="<?= old('nama') ?>">
                          <div class="invalid-feedback"><?= $ds['nama'] ?></div>
                          <?php endif; ?>
                      </div>


                      <div class="form-group">
                          <label for="gambar">Gambar</label>
                          <?php if (is_null($data->gambar)): ?>
                            <div class="preview w-50 h-50">
                            <label>Saat ini : </label>
                            <i class="fa-solid fa-image fa-5x"></i>
                          </div>
                          <?php else: ?>
                            <div class="preview w-50 h-50">
                            <label>Saat ini : </label>
                            <img src="<?= base_url("uploads/payment_channel/$data->gambar") ?>" class="img-thumbnail">
                          </div>
                          <?php endif ?>
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