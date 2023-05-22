<div class="row row-cols-xs-2 row-cols-sm-3 row-cols-md-4 row-cols-xl-6 g-4">
    <?php foreach ($produk as $row) { ?>
      <div class="col m-0 p-1">
        <div class="card mb-3 h-100">
            <a href="#">
                <img src="<?= base_url() ?>uploads/produk/<?= $row->gambar ?>" class="card-img-top" alt="...">
            </a>
            <div class="card-body">
                <h5 class="card-title">Rp.<?= $row->harga_konsumen ?></h5>
                <a href="#" style="text-decoration: none;"><p class="card-text"><?= $row->nama_produk ?></p></a>
                <a href="#" class="btn btn-primary">Lihat Detil</a>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
      </div>
    <?php } ?>
  </div>