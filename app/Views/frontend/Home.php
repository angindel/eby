<?php helper('local'); ?>
<?= $this->extend('layout/home/home_layout') ?>

<?= $this->section('cdn-head') ?>
    <?= $this->include('assets/local/bs_css-5.3.0') ?>
    <?= $this->include('assets/local/style-local') ?>
    <link rel="stylesheet" href="<?= base_url("owlcarousel/dist/assets/owl.carousel.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("owlcarousel/dist/assets/owl.theme.default.min.css") ?>">
    <?= $this->include('assets/local/fa-6.4.0') ?>
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
     <div class="row bg-primary align-items-center ps-2 py-2 my-2">
            <div class="col-8 m-0 p-0 justify-content-start">
                <h2 class="align-items-stretch m-0 p-0 fw-bold">KATEGORI</h2>
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
            echo '<div class="item">';
                for($i=0;$i < 2; $i++)
                {
                    if(!isset($kategori[$x]))
                    {
                        break;
                    } else {
        ?>
                    <div class="katkat">
                                <img src="<?php echo 'uploads/kategori/'.$kategori[$x]->gambar; ?>">
                                <p><?php echo $kategori[$x]->nama_kategori ?></p>
                    </div>
        <?php
                        $x++;
                    }     
                }
            echo '</div>';
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
                    <?php foreach($produk_new as $row) { ?>
                    <div class="card p-0 m-1" style="border:none;">
                            <img src="<?= base_url() ?>uploads/produk/<?= $row->gambar ?>" class="card-img h-100" alt="...">
                        <div class="card-img-overlay p-0 m-0">
                            <div style="background-color: #01fbd8cf;border-radius: 5px 10px 100px 0;width:70%;">
                                <p class="card-title" style="font-size:12px;">Rp.<?= rupiah($row->harga_konsumen) ?></p>
                            </div>
                            <a href="<?= base_url("produk/detail/$row->produk_seo") ?>" style="text-decoration: none;"><h3 class="card-text lh-sm caption-p" style="background-color: #ffffffa6;border-radius: 5px 50px 10px 0"><?= $row->nama_produk ?></h3></a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- END PRODUK TERLARIS -->
    <!-- KONTEN -->
    <section id="konten" class="border-bottom pb-3 border-dark-subtle">
        <div class="row bg-primary align-items-center ps-2 py-2 mb-2">
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
              <?php foreach($pc as $row) { ?>
              <div class="col-2">
                <img src="<?= base_url("uploads/payment_channel/$row->gambar") ?>" class="img-thumbnail">
              </div>
              <?php } ?>
          </div>
      </div>
      <div class="col-md-12 col-lg-6 border border-top-0 border-dark-subtle my-2">
          <div class="row">
              <div class="col-12">Delivery Service</div>
              <?php foreach($ds as $row) { ?>
              <div class="col-2">
                <img src="<?= base_url("uploads/delivery_service/$row->gambar") ?>" class="img-thumbnail">
              </div>
              <?php } ?>
          </div>
      </div>
    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="<?= base_url("owlcarousel/dist/owl.carousel.min.js") ?>"></script>
<script src="https://unpkg.com/infinite-scroll@4.0.1/dist/infinite-scroll.pkgd.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#teskat').owlCarousel({
    loop:false,
    margin:5,
    items:1,
    nav: true,
    responsiveClass:true,
          responsive: {
            0:{
              items: 5
            },
            480:{
              items:6
            },
            670 :{
                items: 8
            },
            768:{
              items:10
            },
            1024:{
              items:16
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
          autoplay:true,
          autoplaySpeed: 250,
          autoplayTimeout:3000,
          smartSpeed:250,
          loop:true,
          
          responsiveClass:true,
          responsive: {
            0:{
              items:3
            },
            480:{
              items:4
            },
            768:{
              items:6
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
                return `tes/${this.loadCount + 1}`;
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
          // convert HTML string into elements
          let $items =  $( itemsHTML );
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