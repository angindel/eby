<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
    <?= $this->include('assets/local/bs_css-530') ?>
    <?= $this->include('assets/local/style-local') ?>
    <?= $this->include('assets/local/fa-6.4.0') ?>
    <style type="text/css">

    </style>
<?= $this->endSection() ?>

<?= $this->section('main') ?>

    <div class="container-fluid">
    	<h2>Selamat Datang <?= $auth->name ?></h2>
			<div class="row">
				<div class="col">
					Email : <?= $auth->email ?>
				</div>
				<div class="col"></div>
				<div class="col"></div>
			</div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
    <?= $this->include('assets/local/bs_js-530') ?>
<?= $this->endSection() ?>