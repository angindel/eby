<?= $this->extend('backend/layout/admin/dashboard_layout') ?>
<?= $this->section('content') ?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url("administrator") ?>">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
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
        <div class="row bg-secondary p-2">
            <div class="col-md-6 col-sm-7">
                <div class="card bg-dark">
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
            <div class="col-md-6 col-sm-5 p-0">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="info-box mb-2 bg-warning">
                            <!-- <span class="info-box-icon"><i class="fa-solid fa-rupiah-sign"></i></span> -->
                            <div class="info-box-content">
                                <span class="info-box-text text-center">Hari ini</span>
                                <span class="info-box-number text-center"><span class="eltran"><?= is_null($total['transaksi']['hariini']->total) ? 0 : $total['transaksi']['hariini']->total ?></span></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">    
                    <div class="info-box mb-2 bg-warning">
                        <!-- <span class="info-box-icon"><i class="fa-solid fa-rupiah-sign"></i></span> -->
                        <div class="info-box-content">
                            <span class="info-box-text text-center">Minggu ini</span>
                            <span class="info-box-number text-center"><span class="eltran"><?= is_null($total['transaksi']['mingguini']->total) ? 0 : $total['transaksi']['mingguini']->total ?></span></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="info-box mb-2 bg-success">
                        <!-- <span class="info-box-icon"><i class="fa-solid fa-rupiah-sign"></i></span> -->
                        <div class="info-box-content">
                            <span class="info-box-text text-center">Bulan Ini</span>
                            <span class="info-box-number text-center"><span class="eltran"><?= is_null($total['transaksi']['bulanini']->total) ? 0 : $total['transaksi']['bulanini']->total ?></span></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="info-box mb-2 bg-danger">
                        <!-- <span class="info-box-icon"><i class="fa-solid fa-rupiah-sign"></i></span> -->
                        <div class="info-box-content">
                            <span class="info-box-text text-center">Bulan Lalu</span>
                            <span class="info-box-number text-center"><span class="eltran"><?= is_null($total['transaksi']['bulanlalu']->total) ? 0 : $total['transaksi']['bulanlalu']->total ?></span></span>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="info-box mb-2 bg-info">
                        <!-- <span class="info-box-icon"><i class="fa-solid fa-rupiah-sign"></i></span> -->
                        <div class="info-box-content">
                            <span class="info-box-text text-center">Tahun ini</span>
                            <span class="info-box-number text-center"><span class="eltran"><?= is_null($total['transaksi']['tahunini']->total) ? 0 : $total['transaksi']['tahunini']->total ?></span></span>
                        </div>
                    </div>
                </div>

                </div>

            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script type="text/javascript">
    $(document).ready(function(){
        var eltran = document.querySelectorAll(".eltran");
        eltran.forEach(vtran => {
            vtran.textContent = new Intl.NumberFormat('id', { style: "currency", currency: "IDR" }).format(parseInt(vtran.textContent));
        });
    });
</script>
<?= $this->endSection() ?>