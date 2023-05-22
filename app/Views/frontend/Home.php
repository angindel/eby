<?php helper('local'); ?>
<?= $this->extend('layout/home/home_layout') ?>

<?= $this->section('cdn-head') ?>
    <?= $this->include('assets/local/bs_css-5.3.0') ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/style-local.css') ?>">
<?= $this->endSection('cdn-head') ?>

<?= $this->section('cdn-foot') ?>
    <?= $this->include('assets/local/bs_js-5.3.0') ?>
<?= $this->endSection('cdn-foot') ?>

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

  <div class="row my-3 py-3">
      <div id="carousel-slider" class="carousel slide carousel-fade" data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carousel-slider" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#carousel-slider" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#carousel-slider" data-bs-slide-to="2"></button>
  </div>
  
  <!-- The slideshow/carousel -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?= base_url() ?>asset/foto_slide/hijab1.jpg" alt="Los Angeles" class="d-block w-100">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url() ?>asset/foto_slide/hijab2.jpg" alt="Chicago" class="d-block w-100">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url() ?>asset/foto_slide/hijab3.jpg" alt="New York" class="d-block w-100">
    </div>
  </div>
  
  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carousel-slider" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carousel-slider" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>
  </div>
  <!-- END Carousel -->
<div class="row pb-1">
    <?php foreach($kategori as $row) { ?>
    <div class="col-2">
        <div class="card">
            <div class="card-body">
                <a href="#"><?= $row->nama_kategori ?></a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
  <section class="row px-sm-2">
        <div id="produk-terbaru" class='col-md-9 col-lg-9'>
            <header class="row header">
                <div class="col-6">
                    <h2>
                        <a href="#" title="Produk Terbaru" rel="category">EBYKARYA TERBARU</a>
                    </h2>
                </div>
                <div class="col-6 text-end">
                    <a href="#" class="btn btn-primary btn-sm btn-lc" title="Produk Terbaru" rel="category">SEMUA</a>
                </div>
            </header>
            <div class="row row-cols-3 row-cols-md-4 row-cols-lg-6">
                <?php foreach($produk_new as $row) { ?>
                  <div class="col p-1 mb-1">
                    <div class="card h-100">
                        <a href="<?= base_url("produk/detail/$row->produk_seo") ?>">
                            <img src="<?= base_url() ?>uploads/produk/<?= $row->gambar ?>" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body p-0 m-1">
                            <h6 class="card-title">Rp.<?= rupiah($row->harga_konsumen) ?></h5>
                            <a href="<?= base_url("produk/detail/$row->produk_seo") ?>" style="text-decoration: none;"><h3 class="card-text lh-sm caption-pb "><?= $row->nama_produk ?></h3></a>
                        </div>
                        <ul class="list-group list-group-flush text-end border border-top-0">
                            <li class="list-group-item p-0 m-1"><a href="<?= base_url("produk/detail/$row->produk_seo") ?>" class="btn btn-primary btn-sm">Lihat Detil</a></li>
                        </ul>
                    </div>
                </div>
                <?php } ?>
            </div>                
        </div>
</section>

  <div class="row my-5">
    <div class="card-group">
        <div class="card border-light px-2">
            <a href="#">
                <img src="<?= base_url() ?>asset/foto_iklan/a1.webp" class="card-img-top" alt="...">
            </a>
        </div>
        <div class="card border-light px-2">
            <a href="#">
                <img src="<?= base_url() ?>asset/foto_iklan/a2.webp" class="card-img-top" alt="...">
            </a>
        </div>
        <div class="card border-light px-2">
            <a href="#">
                <img src="<?= base_url() ?>asset/foto_iklan/a3.webp" class="card-img-top" alt="...">
            </a>
        </div>
    </div>
  </div>
  <!-- PRODUK -->
  <?= $this->include('layout/home/produk') ?>
  <!-- END PRODUK -->
  <!-- PAGINATION -->
  <?= $pager->links('produk' , 'bs_pagination') ?>  
  <!-- END PAGINATION -->

  <div class="row">
      <div class="col">PAYMENT CHANNEL</div>
      <div class="col">DELIVERY SERVICE</div>
  </div>
  <div class="row">
      <div class="col">FOOTER</div>
  </div>
</main>

<script type="text/javascript">
    const myCarouselElement = document.querySelector('#carouselExampleIndicators')
    const carousel = new bootstrap.Carousel(myCarouselElement, {
        interval: 2000,
        touch: false
    })

</script>

<?= $this->endSection('content') ?>