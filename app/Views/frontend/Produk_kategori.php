<?php helper('local'); ?>
<?= $this->extend('frontend/layout/home/home_layout') ?>

<?= $this->section('cdn-head') ?>
    <?= $this->include('assets/local/bs_css-530') ?>
    <?= $this->include('assets/local/style-local') ?>
    <?= $this->include('assets/local/fa-6.4.0') ?>
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
    <?= $this->include('assets/local/bs_js-530') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<body style="background-color:#ffdff2;">
<?= $this->include('frontend/layout/home/navbar') ?>

<main class="container-fluid">
    <!-- KATEGORI -->
    <div class="row pb-1 my-3">
        <?php foreach($kategori as $row) { ?>
        <div class="col-2">
            <div class="card">
                <div class="card-body">
                    <a href="<?= $row->id_kategori_produk ?>"><?= $row->nama_kategori ?></a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <!-- END KATEGORI -->
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
<script type="text/javascript">
    $(document).ready(function(){
        let $maininfscroll = $('#post-infscroll').infiniteScroll({
              // options
              path: function(){
                return `<?= base_url() ?>tes/<?= $id_kategori ?>/${this.loadCount + 1}`;
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