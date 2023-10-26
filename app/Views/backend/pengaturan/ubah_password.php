<?= $this->extend('backend/layout/admin/dashboard_layout') ?>
<?= $this->section('link') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url("asset/sweetalert2/sweetalert2.min.css") ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Pengaturan</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= base_url("administrator") ?>">Home</a></li>
					<li class="breadcrumb-item active">Ubah Password</li>
				</ol>
			</div>
		</div>
	</div>
</section>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
					<div class="card border border-primary">
						<div class="card-header bg-primary">
							<div class="xinfo"></div>
							<h3 class="card-title">Ubah Password</h3>
						</div><!-- /.box-header -->
						<div class="card-body">
							<?php if (!empty(session()->getFlashdata('berhasil'))) : ?>
			        <div class="alert alert-success alert-dismissible fade show" role="alert">
			          <?= session()->getFlashdata('berhasil') ?>
			        </div>
			        <?php else if (!empty(session()->getFlashdata('gagal'))) : ?>
			        <div class="alert alert-warning alert-dismissible fade show" role="alert">
			          <?= session()->getFlashdata('gagal') ?>
			        </div>
			        <?php endif; ?>
							<?= form_open('administrator/pengaturan/ubah_password/proses') ?>
							<div class="form-group">
								<?= form_label('Password Lama', 'old_pass') ?>
								<?= form_password('old_pass', '', ['class' => 'form-control']) ?>
							</div>
							<div class="form-group">
								<?= form_label('Password Baru', 'new_pass') ?>
								<?= form_password('new_pass', '', ['class' => 'form-control']) ?>
							</div>
							<div class="form-group">
								<?= form_label('Ulangi Password Baru', 'val_pass') ?>
								<?= form_password('val_pass', '', ['class' => 'form-control']) ?>
								<small id="valHelp" class="form-text text-muted">Ulangi Lagi Password Baru nya.</small>
							</div>
							<?= form_submit('', 'Proses', ['class' => 'btn btn-primary']) ?>
							<?= form_close() ?>
						</div><!-- /.card-body -->
					</div>
				</div>
			</div>
	</div>
</section>
<!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script type="text/javascript" src="<?= base_url("asset/sweetalert2/sweetalert2.all.min.js") ?>"></script>
<script type="text/javascript">
</script>
<?= $this->endSection() ?>