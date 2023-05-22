<?= $this->extend('layout/home/home_layout') ?>

<?= $this->section('cdn-head') ?>
    <?= $this->include('assets/local/bs_css-5.3.0') ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/style-local.css') ?>">
<?= $this->endSection('cdn-head') ?>

<?= $this->section('cdn-foot') ?>
    <?= $this->include('assets/local/bs_js-5.3.0') ?>
<?= $this->endSection('cdn-head') ?>

<?= $this->section('content') ?>
<body>
<nav class="navbar sticky-top navbar-expand-md bg-light" data-bs-theme="light">
    <?= $this->include('layout/home/navbar') ?>
</nav>
<main class="container">
        <div id="product-detail" class="card my-5 border border-0">
            <div class="row g-0">
                <div class="col-sm-12 col-md-4">
                    <a href="">
                        <img src="<?= base_url() ?>uploads/produk/<?= $produk->gambar ?>" class="img-fluid rounded-start w-75 h-auto mx-auto d-block" alt="...">
                    </a>
                </div>
                <div class="col-sm-12 col-md-8 font-monospace">
                    <div class="card-header p-0 mx-2 border border-0">
                        <h5 class="pd-h"><?= $produk->nama_produk ?></h5>
                    </div>
                    <div class="card-body m-0">
                        <p class="rp card-text m-0 font-monospace">Rp <?= $produk->harga_konsumen ?></p>
                        <div class="row px-0 mx-0">
                            <div class="card-text row px-0 border-bottom">
                                <small class="m-0 col-4">Stok</small>
                                <small class="m-0 col-8 fw-bold text-danger ">48</small>
                            </div>
                            <div class="card-text row px-0 border-bottom">
                                <small class="m-0 col-4 fw-bold text-secondary-emphasis">Berat</small>
                                <small class="m-0 col-8 fw-bold text-danger "><?= $produk->berat ?></small>
                            </div>
                            <div class="card-text row px-0 border-bottom">
                                <small class="m-0 col-4 fw-bold text-secondary-emphasis">Warna</small>
                                <small class="m-0 col-8 fw-bold text-danger ">Hitam | Merah | Biru</small>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    <div class="row">
            <div class="card-header">
                <h5 class="pd-h mt-5">Deskripsi Produk</h5>
            </div>
        <div class="col-sm-12 col-md-8">
            <div class="card-body m-0" style="font-family: Roboto;">
                <p class="card-text">
                    <?= $produk->keterangan ?>
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card-header">
            <h5 class="pd-h mt-5">Penilaian Produk</h5>
        </div>
        <div class="col-sm-12 col-md-8">
            <div class="card-body m-0">
                <p class="card-text">
                    SEMUA | 5 BINTANG | 4 BINTANG | 3 BINTANG | 2 BINTANG | 1 BINTANG | 
                </p>
                <p class="card-text">| KOMENTAR |</p>
                <p class="card-text">| KOMENTAR |</p>
                <p class="card-text">| KOMENTAR |</p>
                <p class="card-text">| KOMENTAR |</p>
                <p class="card-text">| KOMENTAR |</p>
                <p class="card-text">| KOMENTAR |</p>
                <p class="card-text">| KOMENTAR |</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div>PRODUK TERKAIT</div>
        </div>
        <div class="col">
            <div>PRODUK TERKAIT</div>
        </div>
        <div class="col">
            <div>PRODUK TERKAIT</div>
        </div>
        <div class="col">
            <div>PRODUK TERKAIT</div>
        </div>
    </div>
</main>
</body>
<?= $this->endSection() ?>