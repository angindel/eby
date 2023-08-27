<?= $this->extend('backend/layout/admin/dashboard_layout') ?>
<?= $this->section('content') ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col"><h1 class="m-0">Dashboard</h1></div>
      </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Konsumen</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-user"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>
                            <?= $total['kategori_produk'] ?>
                        </h3>
                        <p>Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-sharp fa-solid fa-th-list"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>
                            <?= $total['produk'] ?>
                        </h3>
                        <p>Produk</p>
                    </div>
                    <div class="icon">
                        <i class="fa-sharp fa-solid fa-barcode"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>
                            <?= $total['mtran'] ?>
                        </h3>
                        <p>Transaksi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-sharp fa-solid fa-shopping-cart"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Transaksi Terakhir</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data["transaksi"] as $row) : ?>
                                        <tr>
                                            <td><?= $row->id_mtran ?></td>
                                            <td><?= $row->nama ?></td>
                                            <td><?= $row->qty ?></td>
                                            <td><?= $row->total ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <a href="<?= base_url("administrator/transaksi") ?>" class="btn btn-sm btn-secondary float-right">Lihat Semua Transaksi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?= $this->endSection('content') ?>