<?= $this->extend('frontend/layout/home/home_layout') ?>

<?= $this->section('cdn-head') ?>
    <?= $this->include('assets/local/bs_css-530') ?>
    <?= $this->include('assets/local/style-local') ?>
    <style type="text/css">
        #dgambar  div  img {
            width: 100%;
            height: 100%;
        }
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
          color: #212121;
          background-color: #ffdff2;
          font-weight: 700;
          margin:2px;
          border-color: #fff;
        }
        div#produk-terkait .card:hover {
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
        .vharga-satu {
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
    <?= $this->include('assets/local/fa-6.4.0') ?>
<?= $this->endSection() ?>

<?= $this->section('cdn-foot') ?>
    <?= $this->include('assets/local/bs_js-530') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<body style="background-color:#ffdff2;">
<?= $this->include('frontend/layout/home/navbar') ?>
<main class="container-fluid" style="background-color: #dfe4ff;">
	<div id="product-detail" class="card mt-3 border border-0">
		<div id="dgambar" class="row g-0">
			<div class="col-sm-4 col-md-4 p-0 m-0">
				<img src="<?= base_url() ?>uploads/produk/<?= $produk->gambar ?>" class="rounded-start mx-auto d-block" alt="..."/>
			</div>
			<div class="col-sm-8 col-md-8 font-monospace">
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
            	<a href="https://wa.me/6282175507239?text=I'm%20interested%20in%20your%20car%20for%20sale" class="btn btn-lg" style="background-color:#25d366;" target="_blank">
            		<i class="fa-brands fa-whatsapp fa-2xl" style="color:#ffffff"></i> <span class="fw-bold" style="color:#ffffff">Beli via WhatsApp</span>
            	</a>
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
			<div class="tab-pane fade show active" id="nav-detail" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
				<div class="container-fluid">
					<div class="row p-2 my-2">
						<div class="col-9 fs-5" style="min-height:500px;">
							<?= $produk->keterangan ?>
						</div>
	        </div>
	      </div>
	    </div>
	    <div class="tab-pane fade" id="nav-penilaian" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
	    	<div class="row p-2 my-2">
	    		<div class="col-sm-12 col-md-8" style="min-height:500px;">
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

  <div id="produk-terkait" class="container-fluid">
  	<div class="row bg-primary bg-opacity-10 border rounded px-2">
  		<div class="col-12 text-center">
  			<h2 class="fw-bold" style="color: #212121;">PRODUK SERUPA</h2>
  		</div>
  		<?php foreach($produk_terkait as $row) : ?>
      <div class="col-4 col-md-2 px-1 mb-3">
      	<div class="card h-100 border border-0 p-0 bg-body-tertiary rounded">
      		<a href="<?= base_url("produk/detail/{$row->produk_seo}") ?>" style="text-decoration:none;">
      			<img src="<?= base_url("uploads/produk/{$row->gambar}") ?>" class="card-img-top" alt="...">
	          <div class="card-body p-0 m-1">
              <div class="card-title">
              	<div class="card-text nama-produk"><?= $row->nama_produk ?></div>
              </div>
              <div class="vharga-satu caption-pb">
                <span>
                	Rp. <?= $row->harga_konsumen ?>
                </span>
              </div>
              <div class="vharga-dua p-0 m-0 w-100">
                <span style="text-decoration:line-through;">
                    Rp. <?= $row->harga_konsumen ?>
                </span>
                <span class="diskon">-50%</span>
              </div>
              <div class="row">
                <div class="col">
                  <i class="fa fa-star fa-2xs" style="color:#faca51;"></i>
                  <i class="fa fa-star fa-2xs" style="color:#faca51;"></i>
                  <i class="fa fa-star fa-2xs" style="color:#faca51;"></i>
                  <i class="fa fa-star fa-2xs" style="color:#faca51;"></i>
                  <i class="fa fa-star fa-2xs" style="color:#faca51;"></i>
                </div>
              </div>
	          </div>
          </a>
        </div>
      </div>
      <?php endforeach ?>
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