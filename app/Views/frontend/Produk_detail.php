<?= $this->extend('layout/home/home_layout') ?>

<?= $this->section('cdn-head') ?>
    <?= $this->include('assets/local/bs_css-5.3.0') ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/style-local.css') ?>">
    <style type="text/css">
        #dgambar  div  img {
            width: 100%;
            height: 100%;
        }
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
  color: var(--bs-nav-tabs-link-active-color);
  background-color: var(--bs-success-border-subtle);
}
    </style>
<?= $this->endSection() ?>

<?= $this->section('cdn-foot') ?>
    <?= $this->include('assets/local/bs_js-5.3.0') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<body>
<nav class="navbar sticky-top navbar-expand-md bg-light" data-bs-theme="light">
    <?= $this->include('layout/home/navbar') ?>
</nav>
<main class="container-fluid px-5">
        <div id="product-detail" class="card my-5 border border-0">
            <div id="dgambar" class="row g-0">
                <div class="col-sm-12 col-md-4 p-0 m-0">
                    <img src="<?= base_url() ?>uploads/produk/<?= $produk->gambar ?>" class="rounded-start mx-auto d-block" alt="...">
                </div>
                <div class="col-sm-12 col-md-8 font-monospace">
                    <div class="card-body m-0">
                        <h5 class="pd-h"><?= $produk->nama_produk ?></h5>
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
                                <small class="col-md-8 col-lg-8 fw-bold text-danger m-0">
                                    <div id="pwarna" class="d-flex flex-wrap">
                                        <div class="p-1 m-1 rounded-1 border border-2 border-secondary ">Hitam</div>
                                        <div class="p-1 m-1 rounded-1 border border-2 border-secondary">Merah</div>
                                        <div class="p-1 m-1 rounded-1 border border-2 border-secondary">Biru</div>
                                        <div class="p-1 m-1 rounded-1 border border-2 border-secondary ">Kuning</div>
                                        <div class="p-1 m-1 rounded-1 border border-2 border-secondary">Hijau</div>
                                        <div class="p-1 m-1 rounded-1 border border-2 border-secondary">Merah Muda</div>
                                        <div class="p-1 m-1 rounded-1 border border-2 border-secondary">Abu - Abu</div>
                                    </div>
                                </small>
                            </div>
                            <div class="card-text row px-0 border-bottom">
                                <small class="m-0 col-4 fw-bold text-secondary-emphasis">Size</small>
                                <small class="col-md-8 col-lg-8 fw-bold text-danger m-0">
                                    <div id="psize" class="d-flex flex-wrap">
                                        <div class="py-1 px-3 m-1 rounded-1 border border-2 border-secondary ">S</div>
                                        <div class="py-1 px-3 m-1 rounded-1 border border-2 border-secondary">M</div>
                                        <div class="py-1 px-3 m-1 rounded-1 border border-2 border-secondary">L</div>
                                    </div>
                                </small>
                            </div>
                            <div class="card-text row px-0">
                                <button class="btn btn-lg btn-success"><svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg> Beli via WhatsApp</button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
<div class="row">
        <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-detail" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Deskripsi Produk</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-penilaian" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Penilaian</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-detail" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0"><?= $produk->keterangan ?></div>
  <div class="tab-pane fade" id="nav-penilaian" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
      <div class="row">
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
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $('#pwarna > div').on('click', function(){
        $('#pwarna > div').removeClass('border-primary');
        $('#pwarna > div').removeClass('border-3');
        $('#pwarna > div').addClass('border-2');
        $('#pwarna > div').addClass('border-secondary');
        $(this).removeClass('border-2')
        $(this).removeClass('border-secondary');
        $(this).addClass('border-3');
        $(this).addClass('border-primary');
    });
    $('#psize > div').on('click', function(){
        $('#psize > div').removeClass('border-primary');
        $('#psize > div').removeClass('border-3');
        $('#psize > div').addClass('border-2');
        $('#psize > div').addClass('border-secondary');
        $(this).removeClass('border-2');
        $(this).removeClass('border-secondary');
        $(this).addClass('border-3');
        $(this).addClass('border-primary');
    });
</script>
</body>
<?= $this->endSection() ?>