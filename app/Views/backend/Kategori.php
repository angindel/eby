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
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($kategori_produk as $row){ ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $row->nama_kategori ?></td>
                        <td>
                          <center>
                            <a class="btn btn-success btn-xs" title="Edit Data" href="<?= base_url("administrator/edit_produk/$row->id_kategori_produk") ?>"">
                              <span class='fa fa-edit'></span>
                            </a>
                            <a class='btn btn-danger btn-xs' title='Delete Data' href="<?= base_url("administrator/delete_produk/$row->id_kategori_produk") ?>"" ><span class='fa fa-remove'></span></a>
                        </center></td>
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
<?= $this->endSection('content') ?>