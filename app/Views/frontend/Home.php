<?= $this->extend('frontend/layout/home/home_layout') ?>

<?= $this->section('cdn-head') ?>
    <?= $this->include('assets/local/bs_css-530') ?>
    <?= $this->include('assets/local/style-local') ?>
    <link rel="stylesheet" href="<?= base_url("owlcarousel/dist/assets/owl.carousel.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("owlcarousel/dist/assets/owl.theme.default.min.css") ?>">
    <?= $this->include('assets/local/fa-6.4.0') ?>
    <style type="text/css">
        div#produk-inf > div.col > div.card:hover {
            box-shadow: 0 2px 4px 0 rgba(0,0,0,.25);
            cursor: pointer;
        }
        .card-title .vharga-satu {
            line-height: 22px;
            font-size
        }
        .nama-produk {
            font-size: 14px;
            height:36px;
            line-height: 18px;
            color: #212121;
            white-space: pre-wrap;
            text-overflow: ellipsis;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .vharga-satu span {
            line-height: 22px;
            height: 22px;
            font-size: 18px;
            margin: 0;
            padding: 0;
        }
        .vharga-dua {
            margin-top: 4px;
            margin-right: 4px;
            line-height: 14px;
            height: 14px;
            color: #9e9e9e;
            font-size: 12px;
            float: left;
        }
        .diskon {
            color: #212121;
            opacity: .8;
            margin-left: 4px;
        }
        .rating {
            margin-top: 8px;
            height: 14px;
            clear: both;
        }
        .rating > .rating-star {
            float: left;
            margin-right: 2px;
            margin-bottom: 3px;
            display: block;
            height: 11px;
            line-height: 11px;
        }

    </style>
<?= $this->endSection() ?>

<?= $this->section('cdn-foot') ?>
    <?= $this->include('assets/local/bs_js-530') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<body style="background-color:#ffdff2;">

  <?= $this->include('frontend/layout/home/navbar') ?>

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
     <div class="row ps-2 py-2 my-2 border border-2 border-opacity-75 rounded" style="background-color:#557ef9;">
            <div class="col-8 m-0 p-0 text-start">
                <h2 class="m-0 p-0 fw-bold" style="color: #fff; "><i class="fa fa-list"></i> KATEGORI</h2>
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
            echo '<div class="kategori-item m-0" style="min-height:300px;"><div class="h-100">';
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

    <!-- PRODUK TERLARIS -->
    <section id="produk-terlaris">
        <div class="row hot-block p-0 pb-2 mb-3">
            <div class="col-12 py-2 mb-2" style="background-color:#557ef9;">
                <h2 class="fw-bold text-center my-0" style="color: #fff;">PRODUK TERLARIS</h2>
            </div>
            <div class="col-12">
                <div id="produk-slide" class="owl-carousel owl-theme">
                    <?php foreach($produk_new as $row) : ?>
                        <div class="item position-relative" style="height:275px">
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
    <div id="konten" class="row pb-3 px-2 mt-1 mx-1 border border-2 border-opacity-75 rounded" style="background-color: #dfe4ff;">
        <div class="row mx-0 mt-0 mb-2 p-0">
            <div class="col-8 m-0 p-1 text-start">
                <h2 class="fw-bold m-0 p-0" style="color: #212121;">EBYKARYA TERBARU</h2>
            </div>
            <div class="col-4 text-end m-0 p-1">
                <a href="#" class="btn btn-primary btn-sm btn-lc" title="Produk Terbaru" rel="category">SEMUA</a>
            </div>
        </div>
        <div id="produk-inf" class="row row-cols-3 row-cols-sm-4 row-cols-md-6 p-0 m-0">
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
                <button class="btn btn-lg btn-outline-primary view-more-produk-button">Lihat Lebih Banyak</button>
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

        $('#produk-inf').on( 'request.infiniteScroll', function( event, path, fetchPromise ) {
  // console.log(event);
  // console.log(path);
  // console.log(fetchPromise);
});

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

        window.onscroll = function () {
				  20 < document.body.scrollTop ||
				  20 < document.documentElement.scrollTop ? $('#go-top').fadeTo('fast', 0.7) : $('#go-top').hide()
				};
				$('#go-top').click(function () {
				  $('html, body').animate({
				    scrollTop: 0
				  }, 'fast')
				});
    });

    

</script>

<?= $this->endSection() ?>