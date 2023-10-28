<header class="sticky-top">
    <!-- <nav class="navbar sticky-top navbar-expand-md bg-light" data-bs-theme="light"> -->

    <!-- </nav> -->
    <nav class="navbar d-none d-md-block py-0" style="background-color:#ffdff2;font-size: 14px; min-height: 35px;">
        <div class="container justify-content-start">

          <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>" rel="bookmark">
            <img width="55px" height="50px" src="<?= base_url()."asset/images/".$logo."" ?>" alt="EbyKarya">
            <h1 style="text-indent:-999999px;margin:0;padding:0">EbyKarya Tempat Jual Beli Online Pakaian Celana Topi Jam Aksesoris Untuk Laki - Laki dan Perempuan Anak - anak Remaja Dewasa Terlengkap</h1>
          </a>

          <form role="search" class="d-flex me-2 float-start" action="" method="get">
            <input class="form-control me-0" placeholder="Cari Produk" autocomplete="off" type="search">
            <button type="submit" class="btn btn-md btn-primary">
              <i class="fa fa-search"></i>
            </button>
          </form>

            <div class="d-flex flex-fill">
              <ul id="top-nav-list" class="nav ms-auto">
                  <li class="nav-item">
                    <?php if(auth()->loggedIn()) : ?>
                      <div class="dropstart">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Akun
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="<?= base_url('/user/dashboard') ?>">Profil</a></li>
                          <li><a class="dropdown-item" href="<?= base_url('/user/logout') ?>">Keluar</a></li>
                        </ul>
                      </div>
                    <?php else : ?>
                      <a href="<?= base_url('/login') ?>" class="btn btn-md btn-primary">Login / Register</a>
                    <?php endif ?>
                  </li>
              </ul>
          </div>
        </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-md" style="background-color: #557ef9 ;">
        <div class="container-fluid">
          <button id="nt" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a href="<?= base_url() ?>" rel="bookmark" class="d-block d-sm-block d-md-none">
            <img height="50px" src="<?= base_url("asset/images/Ebykarya-05.png") ?>">
          </a>
          <div class="d-flex justify-content-end">
            <?php if(auth()->loggedIn()) : ?>
            <a href="<?= base_url('/user/dashboard') ?>" class="btn btn-md btn-warning d-block d-sm-block d-md-none">Akun</a>
            <a href="<?= base_url('/user/logout') ?>" class="btn btn-md btn-danger d-block d-sm-block d-md-none">Logout</a>
          <?php else : ?>
            <a href="<?= base_url('/login') ?>" class="btn btn-md btn-primary d-block d-sm-block d-md-none">Login</a>
          <?php endif ?>
          </div>
          <div class="collapse navbar-collapse bg-body-dark" id="navbarTogglerDemo01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?= base_url() ?>"><i class="fa fa-home"></i> Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-list"></i> Kategori</a>
              </li>
              <li class="nav-item">
                <a class="nav-link"><i class="fa fa-star"></i> Populer</a>
              </li>
            </ul>
          </div>
      </div>
        
    </nav>
  </header>