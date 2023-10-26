<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>page</title>
    <?= $this->include('assets/local/bs_css-530') ?>
    <style type="text/css">
        .pagination {
            margin-top: 5px;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 3px;
            display: inline-block;
        }

        .pagination > li {
            display: inline;
        }

        .pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover
        {
            color: #fff;
            background-color: #e50a4a;
            border-color: #e50a4a;
            cursor: default;
        }

        .pagination > li > a, .pagination > li > span {
            position: relative;
            float: left;
            padding: 6px 12px;
            line-height: 1.4;
            text-decoration: none;
            color: #e50a4a;
            background-color: #fff;
            border: 1px solid #ddd;

        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div id="produk-inf" class="row row-cols-3 row-cols-md-6">
        <?php foreach($produk as $row): ?>
        <div class="col px-1 mb-1 infscroll-item mb-3">
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
                        <span class="harga-diskon" style="text-decoration:line-through;">
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
        <?php endforeach; ?>
    </div>
    <div id="button-more" class="row">
        <div class="col text-center">
            <button class="btn btn-lg btn-outline-primary view-more-produk-button">Muat Lebih Banyak</button>
        </div>
    </div>
    <?= $pager ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://unpkg.com/infinite-scroll@4.0.1/dist/infinite-scroll.pkgd.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
        $('#produk-inf').infiniteScroll({
            path: '.next',
            append: '.infscroll-item',
            history: 'push',
            historyTitle: true,
            hideNav: '#pagination',
            scrollThreshold: false,
            button: '.view-more-produk-button',
            status: '#scroller-status'
        });

        $('#scroller-status').hide();

        if($('.page').html() == last_page)
        {
            $('#button-more').hide();
            $('#scroller-status').show();
            $('.infinite-scroll-hide').hide();
            $('.infinite-scroll-last').show();
            $('.infinite-scroll-error').hide();
        }
        
    });
    </script>

</body>
</html>