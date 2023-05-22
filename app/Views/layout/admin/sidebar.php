  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4" id="sidebar-ail">
    <!-- Brand Logo -->
    <a href="<?= base_url('administrator/dashboard') ?>" class="brand-link">
      <img src="<?= base_url() ?>asset/images/Ebykarya-01.png" alt="Admin" class="brand-image elevation-3">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url() ?>asset/foto_user/avatar1.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">LIMC</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url('administrator/dashboard') ?>" class="nav-link <?php echo (!isset($path)) ? '' : (($path == "dashboard") ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('administrator/transaksi') ?>" class="nav-link <?php echo (!isset($path)) ? '' : (($path == "transaksi") ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-sharp fa-solid fa-shopping-cart"></i>
              <p>
                Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('administrator/stok') ?>" class="nav-link <?php echo (!isset($path)) ? '' : (($path == "stok") ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-sharp fa-solid fa-list"></i>
              <p>
                Stok
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('administrator/kategori') ?>" class="nav-link <?php echo (!isset($path)) ? '' : (($path == "kategori") ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-sharp fa-solid fa-th-list"></i>
              <p>
                Kategori
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('administrator/produk') ?>" class="nav-link <?php echo (!isset($path)) ? '' : (($path == "produk") ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-sharp fa-solid fa-barcode"></i>
              <p>
                Produk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= route_to('admin.identitas') ?>" class="nav-link <?php echo (!isset($path)) ? '' : (($path == "identitas") ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-sharp fa-solid fa-user"></i>
              <p>
                Identitas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('administrator/logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-solid fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>