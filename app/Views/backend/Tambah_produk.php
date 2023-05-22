<?php 
$ds =[];
$ds = session()->getFlashdata('_ci_validation_errors');
?>
<?= $this->extend('layout/admin/dashboard_layout') ?>
<?= $this->section('content') ?>
    <!-- Main content -->
    <section class="content">
      <div class="container">
          <div class="card">
              <div class="card-header">
                  <h3>Tambah Produk</h3>
              </div>
              <div class="card-body">
                  <?= form_open_multipart('administrator/proses_tambah_produk') ?>
                      <?= csrf_field(); ?>

                      <div class="form-group">
                          <label for="kategori_produk">Kategori</label>
                          <select name='kategori_produk' class='form-control' required>
                          <option value='' selected>- Pilih Kategori Produk -</option>";
                          <?php foreach ($kategori_produk as $row){ ?>
                          <option value="<?= $row->id_kategori_produk ?>"><?= $row->nama_kategori ?></option>
                          <?php } ?>
                      </select>
                      </div>

                      <div class="form-group">
                          <label for="nama_produk">Nama Produk</label>
                          <?php if(empty($ds['nama_produk']) ) : ?>
                          <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= old('nama_produk') ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="nama_produk" name="nama_produk" value="<?= old('nama_produk') ?>">
                          <div id="nama_produk" class="invalid-feedback"><?= $ds['nama_produk'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <label for="harga_modal">Harga Modal</label>
                          <?php if(empty($ds['harga_modal']) ) : ?>
                          <input type="text" class="form-control" id="harga_modal" name="harga_modal" value="<?= old('harga_modal'); ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="harga_modal" name="harga_modal" value="<?= old('harga_modal'); ?>">
                          <div id="harga_modal" class="invalid-feedback"><?= $ds['harga_modal'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <label for="harga_reseller">Harga Reseller</label>
                          <?php if(empty($ds['harga_reseller']) ) : ?>
                          <input type="text" class="form-control" id="harga_reseller" name="harga_reseller" value="<?= old('harga_reseller'); ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="harga_reseller" name="harga_reseller" value="<?= old('harga_reseller'); ?>">
                          <div id="harga_reseller" class="invalid-feedback"><?= $ds['harga_reseller'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <label for="harga_konsumen">Harga Konsumen</label>
                          <?php if(empty($ds['harga_konsumen']) ) : ?>
                          <input type="text" class="form-control" id="harga_konsumen" name="harga_konsumen" value="<?= old('harga_konsumen'); ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="harga_konsumen" name="harga_konsumen" value="<?= old('harga_konsumen'); ?>">
                          <div id="harga_konsumen" class="invalid-feedback"><?= $ds['harga_konsumen'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <label for="satuan">Satuan</label>
                          <?php if(empty($ds['satuan']) ) : ?>
                          <input type="text" class="form-control" id="satuan" name="satuan" value="<?= old('satuan'); ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="satuan" name="satuan" value="<?= old('satuan'); ?>">
                          <div id="satuan" class="invalid-feedback"><?= $ds['satuan'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <label for="berat">Berat</label>
                          <?php if(empty($ds['berat']) ) : ?>
                          <input type="text" class="form-control" id="berat" name="berat" value="<?= old('berat'); ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="berat" name="berat" value="<?= old('berat'); ?>">
                          <div id="berat" class="invalid-feedback"><?= $ds['berat'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <label for="keterangan">Keterangan</label>
                          <?php if(empty($ds['keterangan']) ) : ?>
                          <textarea type="text" class="form-control" id="editorket" name="keterangan" value="<?= old('keterangan'); ?>"></textarea>
                          <?php else: ?>
                          <textarea class="form-control is-invalid" id="editorket" name="keterangan" value="<?= old('keterangan'); ?>"></textarea>
                          <div id="keterangan" class="invalid-feedback"><?= $ds['keterangan'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <label for="gambar">Gambar</label>
                          <?php if(empty($ds['gambar']) ) : ?>
                          <input type="file" class="form-control" id="gambar" name="gambar" value="<?= old('gambar'); ?>">
                          <?php else: ?>
                          <input type="file" class="form-control is-invalid" id="gambar" name="gambar" value="<?= old('gambar'); ?>">
                          <div id="gambar" class="invalid-feedback"><?= $ds['gambar'] ?></div>
                          <?php endif; ?>
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