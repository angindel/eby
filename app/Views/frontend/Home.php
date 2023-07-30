<?php helper('local'); ?>
<?= $this->extend('frontend/layout/home/home_layout') ?>

<?= $this->section('cdn-head') ?>
    <?= $this->include('assets/local/bs_css-530') ?>
    <?= $this->include('assets/local/style-local') ?>
    <link rel="stylesheet" href="<?= base_url("owlcarousel/dist/assets/owl.carousel.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("owlcarousel/dist/assets/owl.theme.default.min.css") ?>">
    <?= $this->include('assets/local/fa-6.4.0') ?>
<?= $this->endSection() ?>

<?= $this->section('cdn-foot') ?>
    <?= $this->include('assets/local/bs_js-530') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<body>
<nav class="navbar sticky-top navbar-expand-md bg-light" data-bs-theme="light">
    <?= $this->include('frontend/layout/home/navbar') ?>
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
    <!-- SLIDE -->
    <div class="row">
      <div id="head-slide" class="owl-carousel owl-theme p-0">
        <?php foreach($sl as $row) { ?>
        <div class="item">
          <img src="<?= base_url("uploads/slide/{$row->gambar}") ?>" alt="<?= $row->nama ?>">
        </div>
        <?php } ?>
      </div>
    </div>
    <!-- END SLIDE -->

    <!-- TES KATEGORI -->
    <section style="margin-bottom: 20px;">
     <div class="row ps-2 py-2 my-2 border border-2 border-opacity-75 rounded">
            <div class="col-8 m-0 p-0 text-start">
                <h2 class="m-0 p-0 fw-bold" style="color: #e1609b; text-shadow: 0 0 1px #fff;">KATEGORI</h2>
            </div>
            <div class="col-4 text-end m-0 p-0">
                <a href="#" class="btn btn-primary btn-sm btn-lc me-2" title="Produk Terbaru" rel="category">SEMUA</a>
            </div>
        </div>
    <div id="teskat" class="owl-carousel owl-theme">
        <?php 
        $tk = count($kategori);
        for($x=0; $x < $tk;)
        {
            echo '<div class="kategori-item m-0" style="min-height:400px;"><div class="h-100">';
                for($i=0;$i < 2; $i++)
                {
                    if(!isset($kategori[$x]))
                    {
                        break;
                    } else {
        ?>
                    <a href="<?= base_url("produk/kategori/{$kategori[$x]->id_kategori_produk}") ?>" style="text-decoration: none;">
                    <div class="katkat h-50 my-1 p-2 border border-1 rounded">
                        <div style="height:70%">
                            <img class="h-100 p-4" src="<?php echo 'uploads/kategori/'.$kategori[$x]->gambar; ?>" style="background-color: #fff;border-radius: 50%;">
                        </div>
                        <div style="height:30%;">
                            <p class="text-center fs-5 fw-bold"><?php echo $kategori[$x]->nama_kategori ?></p>
                        </div>
                    </div>
                </a>
        <?php
                        $x++;
                    }     
                }
            echo '</div></div>';
        }
        ?>
    </div>
    </section>

    <!-- END TES KATEGORI -->

    <!-- KATEGORI -->
    <!-- <section id="kategori" class="border-bottom pb-3 border-dark-subtle">
        <div class="row bg-primary align-items-center ps-2 py-2 my-2">
            <div class="col-8 m-0 p-0 justify-content-start">
                <h2 class="align-items-stretch m-0 p-0 fw-bold">KATEGORI</h2>
            </div>
            <div class="col-4 text-end m-0 p-0">
                <a href="#" class="btn btn-primary btn-sm btn-lc me-2" title="Produk Terbaru" rel="category">SEMUA</a>
            </div>
        </div>
    <div class="row pb-1 my-3 kategori-item">
        <?php foreach($kategori as $row) { ?>
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-2 col-xxl-1 my-1 ic">
            <a href="/produk/kategori/<?= $row->id_kategori_produk ?>" style="text-decoration: none;">
            <div class="card">
                <div class="card-body">
                        <?php if(is_null($row->gambar)) : ?>
                            <img src="<?= base_url("asset/img/file-image-regular.svg") ?>" class="w-100 h-100">
                        <?php else : ?>
                            <img src="<?= base_url("uploads/kategori/$row->gambar") ?>" class="w-100 h-100">
                        <?php endif ?>
                </div>
                <div class="card-footer">
                    <div class="text-center">
                            <?= $row->nama_kategori ?>
                        </div>
                </div>
            </div>
            </a>
        </div>
        <?php } ?>
    </div>
    </section> -->
    <!-- END KATEGORI -->
    <!-- PRODUK TERLARIS -->
    <section id="produk-terlaris">
        <div class="row hot-block">
            <div class="col-12">
                <h2 class="fw-bold text-center">PRODUK TERLARIS</h2>
            </div>
            <div class="col-12">
                <div id="produk-slide" class="owl-carousel owl-theme">
                    <?php foreach($produk_new as $row) : ?>
                        <div class="item position-relative" style="height:300px">
                            <a href="<?= base_url("produk/detail/{$row->produk_seo}") ?>" style="text-decoration: none;" >
                            <div class="card p-0 m-1 h-100" style="border:none;">
                                <img src="<?= base_url() ?>uploads/produk/<?= $row->gambar ?>" class="card-img h-100" alt="...">
                                <div class="p-0 m-0">
                                    <div class="position-absolute ps-2 pt-2 fw-bold" style="background-color: #01fbd8;border-radius: 30px 10px 100px 5px;width:70%;top:-5px; left:-5px;">
                                        <p class="card-title" style="font-size:12px;">Rp.<?= rupiah($row->harga_konsumen) ?></p>
                                    </div>
                                    <h3 class="card-text lh-sm caption-p position-absolute bottom-0" style="background-color: #ffffffa6;border-radius: 5px 50px 10px 0;height: 40px;overflow: hidden;text-overflow: ellipsis; white-space: nowrap;"><?= $row->nama_produk ?></h3>
                                </div>
                            </div>
                        </a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </section>
    <!-- END PRODUK TERLARIS -->
    <!-- KONTEN -->
    <div id="konten" class="row pb-3 px-2 mt-1 mx-1 border border-2 border-opacity-75 rounded">
        <div class="row m-0 p-0">
            <div class="col-8 m-0 p-1 text-start">
                <h2 class="fw-bold m-0 p-0" style="color: #e1609b; text-shadow: 0 0 1px #fff;">EBYKARYA TERBARU</h2>
            </div>
            <div class="col-4 text-end m-0 p-1">
                <a href="#" class="btn btn-primary btn-sm btn-lc" title="Produk Terbaru" rel="category">SEMUA</a>
            </div>
        </div>
        <div id="produk-inf" class="row row-cols-3 row-cols-md-5 p-0 m-0">
        </div>
        <div id="scroller-status">
            <div class="loader-ellips infinite-scroll-request">
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
            </div>
            <h3 class="scroller-status__message infinite-scroll-last text-center mt-3 border border-2 p-2 bg-primary fw-bold">Tidak Ada Halaman Lain Untuk Dimuat
            </h3>
            <p class="infinite-scroll-error font-monospace fs-4 fw-bold">Tidak ada lagi halaman untuk dimuat</p>
        </div>
        <div class="row">
            <div class="col text-center">
                <button class="btn btn-lg btn-primary view-more-produk-button">Lihat Lebih Banyak</button>
            </div>
        </div>
    </div>
    <!-- END KONTEN -->
    
    <div class="row">
      <div class="col-md-12 col-lg-6 my-2">
          <div class="row">
              <div class="col-12"><span class="fs-5 fw-bold" style="color: #e1609b;">PAYMENT CHANNEL</span></div>
              <?php foreach($pc as $row) { ?>
              <div class="col-2">
                <img src="<?= base_url("uploads/payment_channel/$row->gambar") ?>" class="img-thumbnail">
              </div>
              <?php } ?>
          </div>
      </div>
      <div class="col-md-12 col-lg-6 my-2">
          <div class="row">
              <div class="col-12"><span class="fs-5 fw-bold" style="color: #e1609b;">DELIVERY SERVICE</span></div>
              <?php foreach($ds as $row) { ?>
              <div class="col-2">
                <img src="<?= base_url("uploads/delivery_service/$row->gambar") ?>" class="img-thumbnail">
              </div>
              <?php } ?>
          </div>
      </div>
    </div>
</main>
<script src="<?= base_url("asset/js/jquery-3.7.0.min.js") ?>"></script>
<script src="<?= base_url("owlcarousel/dist/owl.carousel.min.js") ?>"></script>
<script src="<?= base_url("asset/js/infinite-scroll.pkgd.min.js") ?>"></script>
<script src="<?= base_url("asset/js/jquery.matchHeight.js") ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#produk-inf').infiniteScroll({
            // path: '.next',
            path: function(){
                return `produk/page/${this.loadCount+1}`;
            },
            append: '.infscroll-item',
            history: false,
            historyTitle: false,
            hideNav: '#pagination',
            scrollThreshold: false,
            button: '.view-more-produk-button',
            status: '#scroller-status'
        });
     
        $('#produk-inf').infiniteScroll('loadNextPage');

        $('#teskat').owlCarousel({
            loop:false,
            margin:5,
            items:1,
            nav: true,
            responsiveClass:true,
                  responsive: {
                    0:{
                      items:3
                    },
                    576:{
                      items:4
                    },
                    768:{
                      items:5
                    },
                    992:{
                      items:7
                    },
                    1200:{
                      items:9
                    },
                    1400:{
                      items:9
                    },
                  }
        });

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
          // autoplay:true,
          // autoplaySpeed: 250,
          // autoplayTimeout:3000,
          // smartSpeed:250,
          loop:true,
          responsiveClass:true,
          responsive: {
            0:{
              items:3
            },
            576:{
              items:4
            },
            768:{
              items:5
            },
            992:{
              items:7
            },
            1200:{
              items:9
            },
            1400:{
              items:9
            },
          }
        });

        $(".kategori-item").matchHeight({
            target: $('.katkat')
        });
    });

    

</script>

<?= $this->endSection() ?>