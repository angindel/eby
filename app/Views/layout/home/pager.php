<?php $pager->setSurroundCount(2); ?>

<div id="scroller-status">
    <div class="loader-ellips infinite-scroll-request">
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
    </div>
    <h3 class="scroller-status__message infinite-scroll-last text-center mt-3 border border-2 p-2 bg-primary fw-bold">Tidak Ada Halaman Lain Untuk Dimuat
    </h3>
    <p class="scroller-status__message infinite-scroll-error">Error. Silahkan refresh halaman ini atau <a href="<?= base_url("produk/page/{$pager->getNextPageNumber()}") ?>">Klik disini</a></p>
</div>
<div class="row text-center" id="pagination">
    <nav>
        <ul class="pagination">
            <?php if ($pager->hasPreviousPage()) : ?>
                <li>
                    <a href="<?= $pager->getFirst() ?>">
                        <span>Awal</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $pager->getPreviousPage() ?>">
                        <span><</span>
                    </a>
                </li>
            <?php endif ?>
            <?php foreach ($pager->links() as $link): ?>
            <li <?= $link['active'] ? 'class="active"' : '' ?>>
                <a class="page-numbers" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
            </li>
            <?php endforeach ?>

            <?php if ($pager->hasNextPage()) : ?>
                <li>
                    <a class="next page-numbers" href="<?= $pager->getNextPage() ?>">
                        <span>></span>
                    </a>
                </li>
                <li>
                    <a class="next page-numbers" href="<?= $pager->getLast() ?>">
                        <span>Akhir</span>
                    </a>
                </li>
            <?php endif ?>          
        </ul>
    </nav>
    <span>Halaman <span class="page"><?= $pager->getCurrentPageNumber() ?></span> dari <?= $pager->getPageCount() ?></span>
</div>
<script type="text/javascript">
    var last_page = <?= $pager->getPageCount() ?>;
</script>