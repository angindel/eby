<!DOCTYPE html>
<html lang="id">
<head>
  <title><?= esc($title) ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ibnulimc">
  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>/uploads/produk/favicon.ico" />
  <?= $this->renderSection('cdn-head') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<?= $this->include('backend/layout/admin/navbar') ?>
<?= $this->include('backend/layout/admin/sidebar') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="mb-3"></div>
    <!-- /.content-header -->
    <?= $this->renderSection('content') ?>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?= $this->renderSection('cdn-foot') ?>
</body>
</html>