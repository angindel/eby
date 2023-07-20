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
                  <h3>Edit Produk</h3>
              </div>
              <div class="card-body">
                  <?= form_open_multipart('administrator/produk/proses_edit') ?>
                      <?= csrf_field(); ?>
                      <input type="hidden" name="edit">
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
                          <?php if(empty($ds['nama_produk']) ) : ?>
                          <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $result = old('nama_produk') ?: $edit->nama_produk ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="nama_produk" name="nama_produk" value="<?= old('nama_produk') ?>">
                          <div id="nama_produk" class="invalid-feedback"><?= $ds['nama_produk'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <label for="satuan">Satuan</label>
                          <?php if(empty($ds['satuan']) ) : ?>
                          <input type="text" class="form-control" id="satuan" name="satuan" value="<?= $result = old('satuan') ?: $edit->satuan ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="satuan" name="satuan" value="<?= old('satuan'); ?>">
                          <div id="satuan" class="invalid-feedback"><?= $ds['satuan'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <label for="berat">Berat</label>
                          <?php if(empty($ds['berat']) ) : ?>
                          <input type="text" class="form-control" id="berat" name="berat" value="<?= $result = old('berat') ?: $edit->berat ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="berat" name="berat" value="<?= old('berat'); ?>">
                          <div id="berat" class="invalid-feedback"><?= $ds['berat'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <label for="harga_beli">Harga Beli</label>
                          <?php if(empty($ds['harga_beli']) ) : ?>
                          <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="<?= $result = old('harga_beli') ?: $edit->harga_beli ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="harga_beli" name="harga_beli" value="<?= old('harga_beli'); ?>">
                          <div id="harga_beli" class="invalid-feedback"><?= $ds['harga_beli'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <label for="harga_reseller">Harga Reseller</label>
                          <?php if(empty($ds['harga_reseller']) ) : ?>
                          <input type="text" class="form-control" id="harga_reseller" name="harga_reseller" value="<?= $result = old('harga_reseller') ?: $edit->harga_reseller ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="harga_reseller" name="harga_reseller" value="<?= old('harga_reseller'); ?>">
                          <div id="harga_reseller" class="invalid-feedback"><?= $ds['harga_reseller'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <label for="harga_konsumen">Harga Konsumen</label>
                          <?php if(empty($ds['harga_konsumen']) ) : ?>
                          <input type="text" class="form-control" id="harga_konsumen" name="harga_konsumen" value="<?= $result = old('harga_konsumen') ?: $edit->harga_konsumen ?>">
                          <?php else: ?>
                          <input type="text" class="form-control is-invalid" id="harga_konsumen" name="harga_konsumen" value="<?= old('harga_konsumen'); ?>">
                          <div id="harga_konsumen" class="invalid-feedback"><?= $ds['harga_konsumen'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <label for="keterangan">Keterangan</label>
                          <?php if(empty($ds['keterangan']) ) : ?>
                          <textarea type="text" class="form-control" id="editorket" name="keterangan"><?= $result = old('keterangan') ?: $edit->keterangan ?></textarea>
                          <?php else: ?>
                          <textarea class="form-control is-invalid" id="editorket" name="keterangan"><?= old('keterangan'); ?></textarea>
                          <div id="keterangan" class="invalid-feedback"><?= $ds['keterangan'] ?></div>
                          <?php endif; ?>
                      </div>

                      <div class="form-group">
                          <label for="gambar">Gambar</label>
                          <div class="preview w-50 h-50">
                            <label>Saat ini : </label>
                            <img src="<?= base_url("uploads/produk/$edit->gambar") ?>" class="img-thumbnail">
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
<script type="text/javascript" src="<?= base_url("ckeditor5/ckeditor.js") ?>"></script>
    <script>
    ClassicEditor
      .create( document.querySelector( '#editorket' ), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
      } )
      .then( editor => {
        window.editor = editor;
      } )
      .catch( err => {
        console.error( err.stack );
      } );
  </script>
<?= $this->endSection() ?>