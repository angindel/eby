<?= $this->extend('backend/layout/admin/template') ?>

<?= $this->section('cdn-head') ?>
  <?= $this->include('assets/local/fa-6.4.0') ?>
  <?= $this->renderSection('link') ?>
  <?= $this->include('assets/local/adminlte_css') ?>
  <?= $this->renderSection('style') ?>
<?= $this->endSection() ?>

<?= $this->section('cdn-foot') ?>
  <?= $this->include('assets/local/jquery') ?>
  <?= $this->include('assets/local/bs_js-462') ?>
  <?= $this->renderSection('script') ?>
  <?= $this->include('assets/local/adminlte_js') ?>
<?= $this->endSection() ?>