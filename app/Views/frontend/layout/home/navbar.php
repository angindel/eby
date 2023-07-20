<div class="container-fluid">
  <div class="d-flex justify-content-between">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand flex-sm-grow-1 flex-md-grow-0" href="<?= base_url() ?>"><img height=40px src="<?= base_url()."asset/images/".$logo."" ?>"/></a>
    <form class="d-flex" role="search">
      <input class="form-control" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    </div>
    <!-- OFFCANVAS -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">

        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item d-md-none">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown d-md-none">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <div class="row">
          <div class="col nav-item d-md-block m-0 p-0 me-2">
             <button type="button" class="btn btn-sm btn-success p-2 w-100">DAFTAR</button>
          </div>
          <div class="col nav-item d-md-block m-0 p-0">
             <button type="button" class="btn btn-sm btn-primary p-2 w-100">LOGIN</button>
          </div>
          </div>
        </ul>
      </div>
    </div>
  </div>
