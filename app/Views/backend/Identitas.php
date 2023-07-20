<?= $this->extend('backend/layout/admin/dashboard_layout') ?>
<?= $this->section('content') ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="card mb-3">
              <div class="card-header">
                <?php if (!empty(session()->getFlashdata('msg'))) : ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <?php echo session()->getFlashdata('msg'); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <?php endif; ?>
                <div class="row flex-between-end">
                  <div class="col-auto align-self-center">
                    <h5 class="mb-0">Edit Identitas</h5>
                  </div>
                </div>
              </div>
              <div class="card-body py-0 border-top">
                <div class="card shadow-none">
                  <div class="card-body p-0 pb-0">
                    <div class="my-3">
                      <?= form_open_multipart(route_to('admin.identitas.edit')) ?>
                      <input type="hidden" name="id" value="<?= $row['id_identitas'] ?>">
                      <div class="form-group">
                          <label for="nama_website">Nama Website</label>
                          <input type="text" class="form-control" name="nama_website" value="<?= $row['nama_website'] ?>">
                      </div>
                      <div class="form-group">
                          <label for="email">Email</label>
                          <input type="text" class="form-control" name="email" value="<?= $row['email'] ?>">
                      </div>
                      <div class="form-group">
                          <label for="url">Url</label>
                          <input type="text" class="form-control" name="url" value="<?= $row['url'] ?>">
                      </div>
                      <div class="form-group">
                          <label for="facebook">Facebook</label>
                          <input type="text" class="form-control" name="facebook" value="<?= $row['facebook'] ?>">
                      </div>
                      <div class="form-group">
                          <label for="instagram">Instagram</label>
                          <input type="text" class="form-control" name="instagram" value="<?= $row['instagram'] ?>">
                      </div>
                      <div class="form-group">
                          <label for="no_telp">No Telp</label>
                          <input type="text" class="form-control" name="no_telp" value="<?= $row['no_telp'] ?>">
                      </div>
                      <div class="form-group">
                          <label for="kota_id">Kota ID</label>
                          <input type="text" class="form-control" name="kota_id" value="<?= $row['kota_id'] ?>">
                      </div>
                      <div class="form-group">
                          <label for="alamat">Alamat</label>
                          <input type="text" class="form-control" name="alamat" value="<?= $row['alamat'] ?>">
                      </div>
                      <div class="form-group">
                          <label for="meta_deskripsi">Meta Deskripsi</label>
                          <input type="text" class="form-control" name="meta_deskripsi" value="<?= $row['meta_deskripsi'] ?>">
                      </div>
                      <div class="form-group">
                          <label for="meta_keyword">Meta Keyword</label>
                          <input type="text" class="form-control" name="meta_keyword" value="<?= $row['meta_keyword'] ?>">
                      </div>
                       <div class="form-group">
                          <label for="favicon">Favicon</label>
                          <div class="preview w-50 h-50">
                            <label>Saat ini : </label>
                            <img src="<?= base_url("uploads/produk/".$row['favicon']) ?>" class="img-thumbnail">
                          </div>
                          <input type="file" class="form-control" id="favicon" name="favicon">
                      </div>
                      <div class="form-group">
                          <label for="maps">Maps</label>
                          <input type="text" class="form-control" name="maps" value="<?= $row['maps'] ?>">
                      </div>

                      <div class="form-group">
                          <input type="submit" value="Simpan" class="btn btn-info" />
                      </div>

                  </form>
                    </div>                    
                  </div>
                </div>                
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