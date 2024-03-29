<?= $this->extend('backend/layout/admin/template') ?>

<?= $this->section('cdn-head') ?>
  <?= $this->include('assets/local/fa-6.4.0') ?>
  <?= $this->include('assets/local/bs_css-462') ?>
  <?= $this->include('assets/local/datatables_css') ?>
  <?= $this->renderSection('link') ?>
  <?= $this->include('assets/local/adminlte_css') ?>
  <?= $this->renderSection('style') ?>
<?= $this->endSection() ?>

<?= $this->section('cdn-foot') ?>
  <?= $this->include('assets/local/jquery') ?>
  <?= $this->include('assets/local/bs_js-462') ?>
  <?= $this->include('assets/local/datatables_js') ?>
  <?= $this->renderSection('script') ?>
  <?= $this->include('assets/local/adminlte_js') ?>
<?= $this->endSection() ?>