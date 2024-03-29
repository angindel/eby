<?= $this->extend('backend/layout/admin/admin_layout') ?>

<?= $this->section('cdn-head') ?>
  <link rel="stylesheet" type="text/css" href="<?= base_url("asset/bs-4.6.2/css/bootstrap.min.css") ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url("asset/admin-lte.3.2.0/css/adminlte.min.css") ?>">
<?= $this->endSection('cdn-head') ?>

<?= $this->section('cdn-foot') ?>
  <script src="<?= base_url("asset/js/jquery-3.7.0.min.js") ?>"></script>
  <script src="<?= base_url("asset/bs-4.6.2/js/bootstrap.min.js") ?>"></script>
  <script src="<?= base_url("asset/admin-lte.3.2.0/js/adminlte.min.js") ?>"></script>
<?= $this->endSection('cdn-foot') ?>

<?= $this->section('content') ?>
<body class="login-page" style="min-height: 496.8px;">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?= base_url() ?>administrator">
        <b>Eby</b>KARYA </a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php if (!empty(session()->getFlashdata('msg'))) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('msg') ?>
        </div>
        <?php endif; ?>
        <form action="<?= base_url() ?>administrator/login" method="post">
          <?= csrf_field() ?>
          <div class="input-group mb-3">
            <input name="username" type="text" class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input name="password" type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember"> Remember Me </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Log In</button>
            </div>
          </div>
        </form>
        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
      </div>
    </div>
  </div>
<?= $this->endSection() ?>