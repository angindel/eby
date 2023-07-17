<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>page</title>
    <?= $this->include('assets/local/bs_css-5.3.0') ?>
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
        <div id="produk-inf" class="row row-cols-3 row-cols-md-5">
        <?php foreach($produk as $row): ?>
        <div class="col px-1 mb-1 infscroll-item mb-3">
            <div class="shadow card h-100 border border-0 p-0 bg-body-tertiary rounded">
                <a href="<?= base_url("produk/detail/{$row->produk_seo}") ?>">
                    <img src="<?= base_url("uploads/produk/{$row->gambar}") ?>" class="card-img-top" alt="...">
                </a>
                <div class="card-body p-0 m-1">
                    <h5 class="card-title">Rp. <?= $row->harga_konsumen ?></h5>
                    <a href="<?= base_url("produk/detail/{$row->produk_seo}") ?>" style="text-decoration: none;"><h3 class="card-text lh-sm caption-pb"><?= $row->nama_produk ?></h3></a>
                </div>
                <ul class="list-group list-group-flush text-center border border-0">
                    <li class="list-group-item p-0 m-1"><a href="<?= base_url("produk/detail/{$row->produk_seo}") ?>" class="btn btn-primary btn-sm">Lihat Detail</a></li>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div id="button-more" class="row">
        <div class="col text-center">
            <button class="btn btn-lg btn-primary view-more-produk-button">Lihat Lebih Banyak</button>
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