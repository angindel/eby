<?= $this->extend('layout/admin/template') ?>

<?= $this->section('cdn-head') ?>
  <?= $this->include('assets/cdn/fa_css') ?>
  <?= $this->include('assets/cdn/bs_css-46') ?>
  <?= $this->include('assets/cdn/datatables_css') ?>
  <?= $this->include('assets/cdn/adminlte_css') ?>
  <?= $this->renderSection('link') ?>
<?= $this->endSection() ?>

<?= $this->section('cdn-foot') ?>
  <?= $this->include('assets/cdn/jquery') ?>
  <?= $this->include('assets/cdn/bs_js-46') ?>
  <?= $this->include('assets/cdn/datatables_js') ?>
  <?= $this->include('assets/cdn/adminlte_js') ?>
  <?= $this->include('assets/cdn/ckeditor') ?>
  <?= $this->renderSection('script') ?>
<?= $this->endSection() ?>