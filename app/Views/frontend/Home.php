<?php helper('local'); ?>
<?= $this->extend('layout/home/home_layout') ?>

<?= $this->section('cdn-head') ?>
    <?= $this->include('assets/local/bs_css-5.3.0') ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/style-local.css') ?>">
    <link rel="stylesheet" href="<?= base_url("owlcarousel/dist/assets/owl.carousel.min.css") ?>">
<link rel="stylesheet" href="<?= base_url("owlcarousel/dist/assets/owl.theme.default.min.css") ?>">
<?= $this->endSection() ?>

<?= $this->section('cdn-foot') ?>
    <?= $this->include('assets/local/bs_js-5.3.0') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<body>
<nav class="navbar sticky-top navbar-expand-md bg-light" data-bs-theme="light">
    <?= $this->include('layout/home/navbar') ?>
</nav>

<nav class="navbar navbar-expand-sm d-none d-md-block" style="background-color: #d63384 ;">
    <div class="container-fluid">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link">Disabled</a>
        </li>
      </ul>
  </div>
    
</nav>

<main class="container-fluid">
  <!-- Carousel -->
  <div class="row my-0 py-0">
  <div id="head-slide" class="owl-carousel owl-theme">
    <div class="item">
      <img src="<?= base_url() ?>asset/foto_slide/hijab1.jpg" alt="Los Angeles" class="w-100">
    </div>
    <div class="item">
      <img src="<?= base_url() ?>asset/foto_slide/hijab2.jpg" alt="Chicago" class="w-100">
    </div>
    <div class="item">
      <img src="<?= base_url() ?>asset/foto_slide/hijab3.jpg" alt="New York" class="w-100">
    </div>
  </div>
</div>
  <!-- END Carousel -->
<div class="row pb-1">
    <?php foreach($kategori as $row) { ?>
    <div class="col-2">
        <div class="card">
            <div class="card-body">
                <a href="<?= $row->nama_kategori ?>"></a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
    <div id="produk-slide" class="owl-carousel owl-theme">
        <?php foreach($produk_new as $row) { ?>
        <div class="card p-1 mr-1">
            <a href="<?= base_url("produk/detail/$row->produk_seo") ?>">
                <img src="<?= base_url() ?>uploads/produk/<?= $row->gambar ?>" class="card-img-top" alt="...">
            </a>
            <div class="card-body p-0 m-1">
                <p class="card-title" style="font-size:12px;">Rp.<?= rupiah($row->harga_konsumen) ?></p>
                <a href="<?= base_url("produk/detail/$row->produk_seo") ?>" style="text-decoration: none;"><h5 class="card-text lh-sm caption-pb "><?= $row->nama_produk ?></h5></a>
            </div>
        </div>
        <?php } ?>
    </div>

            <div class="row bg-primary align-items-center ps-2 py-2 my-2">
                <div class="col-8 m-0 p-0 justify-content-start">
                    <h2 class="align-items-stretch m-0 p-0">EBYKARYA TERBARU</h2>
                </div>
                <div class="col-4 text-end m-0 p-0">
                    <a href="#" class="btn btn-primary btn-sm btn-lc me-2" title="Produk Terbaru" rel="category">SEMUA</a>
                </div>
            </div>
            <div id="main-infscroll">
            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 p-0 m-0">
                <?php foreach($produk as $row) { ?>
                  <div id="post-infscroll" class="col px-1 mb-1">
                    <div class="card h-100">
                        <a href="<?= base_url("produk/detail/$row->produk_seo") ?>">
                            <img src="<?= base_url() ?>uploads/produk/<?= $row->gambar ?>" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body p-0 m-1">
                            <h5 class="card-title">Rp.<?= rupiah($row->harga_konsumen) ?></h5>
                            <a href="<?= base_url("produk/detail/$row->produk_seo") ?>" style="text-decoration: none;"><h3 class="card-text lh-sm caption-pb "><?= $row->nama_produk ?></h3></a>
                        </div>
                        <ul class="list-group list-group-flush text-end border border-top-0">
                            <li class="list-group-item p-0 m-1"><a href="<?= base_url("produk/detail/$row->produk_seo") ?>" class="btn btn-primary btn-sm">Lihat Detil</a></li>
                        </ul>
                    </div>
                </div>
                <?php } ?>
            </div>
            <a class="pagination__next" href="/page/2">Next</a>
        </div>

<?= $pager->links('produk') ?>


  <div class="row pt-5 mt-5">
      <div class="col">PAYMENT CHANNEL</div>
      <div class="col">DELIVERY SERVICE</div>
  </div>
  <div class="row">
      <div class="col">FOOTER</div>
  </div>
</main>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?= base_url("owlcarousel/dist/owl.carousel.min.js") ?>"></script>
<script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#head-slide").owlCarousel({
          items:1,
          navText: false,
          dots:false,
            loop:true,
            smartSpeed: 500,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplaySpeed: 500,
        });

        $("#produk-slide").owlCarousel({
          dots:false,
          autoplay:true,
          autoplaySpeed: 250,
          autoplayTimeout:2000,
          smartSpeed:250,
          loop:true,
          center:true,
          responsiveClass:true,
          responsive: {
            0:{
              items:3
            },
            480:{
              items:5
            },
            768:{
              items:7
            },
            1024:{
              items:9
            },
          }
        });

        $('#main-infscroll').infiniteScroll({
          // options
          path: '.pagination__next',
          append: '#post-infscroll',
          history: false,
        });
    });
</script>

<?= $this->endSection() ?>