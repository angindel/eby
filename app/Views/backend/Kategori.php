<?= $this->extend('layout/admin/dashboard_layout') ?>
<?= $this->section('content') ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <?php if (!empty(session()->getFlashdata('msg'))) : ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <?php echo session()->getFlashdata('msg'); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <?php endif; ?>
                  <h3 class="box-title">Semua Kategori</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_kategori'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example" class="table table-bordered table-striped table-condensed" style="width: 100%">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Nama Kategori</th>
                        <th style='width:140px'>Gambar</th>
                        <th style='width:100px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($kategori_produk as $row){ ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $row->nama_kategori ?></td>
                        <?php if (is_null($row->gambar)): ?>
                        <td class="p-0"><center><i class="fa-solid fa-image fa-5x"></i></center></td>
                        <td>
                        <?php else: ?>
                          <td class="p-0"><center>
                            <img src="<?= base_url("uploads/kategori/$row->gambar") ?>" class="img-thumbnail">
                          </center></td>
                          <td>
                        <?php endif ?>
                          <center>
                            <a class="btn btn-success btn-xs" title="Edit Data" href="<?= base_url("administrator/edit_kategori/$row->id_kategori_produk") ?>">
                              <i class='fa fa-edit fa-xl'></i>
                            </a>
                            <a class='btn btn-danger btn-xs' title='Delete Data' href="<?= base_url("administrator/delete_produk/$row->id_kategori_produk") ?>" ><i class='fa fa-remove fa-xl'></i></a>
                          </center>
                        </td>
                      </tr>
                  <?php 
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
<?= $this->endSection() ?>