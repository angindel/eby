<?php helper('local'); ?>
<?= $this->extend('layout/home/home_layout') ?>

<?= $this->section('cdn-head') ?>
    <?= $this->include('assets/local/bs_css-5.3.0') ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/style-local.css') ?>">
    <link rel="stylesheet" href="<?= base_url("owlcarousel/dist/assets/owl.carousel.min.css") ?>">
<link rel="stylesheet" href="<?= base_url("owlcarousel/dist/assets/owl.theme.default.min.css") ?>">
<style type="text/css">
 .page-load-status {
  display: none; /* hidden by default */
  padding-top: 20px;
  border-top: 1px solid #DDD;
  text-align: center;
  color: #777;
}
#head-slide  .item img{
    display: block;
    width: 100%;
    height: auto;
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
        <div class="item">
          <img src="<?= base_url() ?>asset/foto_slide/hijab1.jpg" alt="Los Angeles">
        </div>
        <div class="item">
          <img src="<?= base_url() ?>asset/foto_slide/hijab2.jpg" alt="Chicago">
        </div>
        <div class="item">
          <img src="<?= base_url() ?>asset/foto_slide/hijab3.jpg" alt="New York">
        </div>
      </div>
    </div>
    <!-- END SLIDE -->
    <!-- KATEGORI -->
    <div class="row pb-1 my-3">
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
    <!-- END KATEGORI -->
    <!-- PRODUK TERLARIS -->
    <div class="row"><h2 class="fw-bold text-center">PRODUK TERLARIS</h2></div>
    <div class="row">
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
    </div>
    <!-- END PRODUK TERLARIS -->
    <!-- KONTEN -->
    <section id="konten" class="border-bottom pb-3 border-dark-subtle">
        <div class="row bg-primary align-items-center ps-2 py-2 my-2">
            <div class="col-8 m-0 p-0 justify-content-start">
                <h2 class="align-items-stretch m-0 p-0">EBYKARYA TERBARU</h2>
            </div>
            <div class="col-4 text-end m-0 p-0">
                <a href="#" class="btn btn-primary btn-sm btn-lc me-2" title="Produk Terbaru" rel="category">SEMUA</a>
            </div>
        </div>
        <div id="post-infscroll">
        </div>
        <div class="page-load-status">
            <div class="loader-ellips infinite-scroll-request">
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
            </div>
            <p class="infinite-scroll-last">Akhir Konten</p>
            <p class="infinite-scroll-error font-monospace fs-4 fw-bold">Tidak ada lagi halaman untuk dimuat</p>
        </div>
        <div class="row">
            <div class="col text-center">
                <button class="btn btn-lg btn-primary view-more-button">Lihat Lebih Banyak</button>
            </div>
        </div>
    </section>
    <!-- END KONTEN -->

    <div class="row">
      <div class="col-md-12 col-lg-6 border border-top-0 border-dark-subtle my-2">
          <div class="row">
              <div class="col-12">PAYMENT CHANNEL</div>
              <div class="col-2">BCA</div>
              <div class="col-2">MANDIRI</div>
              <div class="col-2">BRI</div>
              <div class="col-2">BNI</div>
              <div class="col-2">OVO</div>
              <div class="col-2">GOPAY</div>
              <div class="col-2">DANA</div>
          </div>
      </div>
      <div class="col-md-12 col-lg-6 border border-top-0 border-dark-subtle my-2">
          <div class="row">
              <div class="col-12">Delivery Service</div>
              <div class="col-2">JNE</div>
              <div class="col-2">J&T</div>
              <div class="col-2">TIKI</div>
          </div>
      </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?= base_url("owlcarousel/dist/owl.carousel.min.js") ?>"></script>
<script src="https://unpkg.com/infinite-scroll@4.0.1/dist/infinite-scroll.pkgd.min.js"></script>
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

        // $(".pagination__next").on("click", function(){
        //   $.ajax({
        //     url: "<?= base_url('tes/2') ?>",
        //     type : 'get',
        //     success: function(data){
        //       $("#post-infscroll>.col:last").after(data).show().fadeIn("slow");
        //     },
        //   });
        // });

        let $maininfscroll = $('#post-infscroll').infiniteScroll({
              // options
              path: function(){
                console.log("page index :"+this.pageIndex);
                console.log("load count :"+this.loadCount);
                return `tes/${this.loadCount}`;
              },
              append: false,
              history: false,
              button: '.view-more-button',
              scrollThreshold: false,
              elementScroll : 'div.col',
              status: '.page-load-status',
              responseBody: 'json',
            });

        $maininfscroll.on('load.infiniteScroll', function(event, body){
            // compile body data into HTML
          let itemsHTML = body.map( getItemHTML ).join('');
          itemsHTML = '<div class="row row-cols-3 row-cols-md-5 p-0 m-0">' + itemsHTML + '</div>';
          console.log(itemsHTML);
          // convert HTML string into elements
          let $items =  $( itemsHTML );
          console.log($items);
          // append item elements
          $maininfscroll.infiniteScroll( 'appendItems', $items );
        });

// load initial page
$maininfscroll.infiniteScroll('loadNextPage');

//------------------//

function getItemHTML({base, nama_produk, harga_konsumen, gambar, produk_seo}) {
    return `<div class="col px-1 mb-1">
                    <div class="card h-100">
                        <a href="${base}produk/detail/${produk_seo} ">
                            <img src="${base}uploads/produk/${gambar}" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body p-0 m-1">
                            <h5 class="card-title">Rp.${harga_konsumen}</h5>
                            <a href="${base}produk/detail/${produk_seo}" style="text-decoration: none;"><h3 class="card-text lh-sm caption-pb">${nama_produk}</h3></a>
                        </div>
                        <ul class="list-group list-group-flush text-end border border-top-0">
                            <li class="list-group-item p-0 m-1"><a href="${base}produk/detail/${produk_seo}" class="btn btn-primary btn-sm">Lihat Detil</a></li>
                        </ul>
                    </div>
                </div>`;
}

    });

    

</script>

<?= $this->endSection() ?>