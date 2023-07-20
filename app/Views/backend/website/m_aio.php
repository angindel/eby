<?= $this->extend('backend/layout/admin/dashboard_layout') ?>
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
                         <li class="breadcrumb-item active">
                          <?= $box_title ?>
                         </li>
                     </ol>
                 </div>
             </div>
         </div>
      </section>
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
                  <a class='pull-right btn btn-primary btn-sm' href='<?= base_url("administrator/aio/{$url_web}/tambah") ?>'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example" class="table table-bordered table-striped table-condensed" style="width: 100%">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Nama <?= $box_title ?></th>
                        <th style='width:140px'>Gambar</th>
                        <th style='width:100px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($data as $row){ ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $row->nama ?></td>
                        <?php if (is_null($row->gambar)): ?>
                        <td class="p-0">
                          <center>
                            <i class="fa-solid fa-image fa-5x"></i>
                          </center>
                        </td>
                        <?php else: ?>
                          <td class="p-0">
                            <center>
                              <img src="<?= base_url("uploads/{$url_web}/$row->gambar") ?>" class="img-thumbnail">
                            </center>
                          </td>
                        <?php endif ?>
                          <td>
                          <center>
                            <a class="btn btn-success btn-xs" title="Edit Data" href="<?= base_url("administrator/aio/{$url_web}/edit/$row->id") ?>">
                              <i class='fa fa-edit fa-xl'></i>
                            </a>
                            <a class='btn btn-danger btn-xs' title='Delete Data' href="<?= base_url("administrator/aio/{$url_web}/delete/$row->id") ?>" ><i class='fa fa-remove fa-xl'></i></a>
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