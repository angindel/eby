<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
    <?= $this->include('assets/local/bs_css-530') ?>
    <?= $this->include('assets/local/style-local') ?>
    <?= $this->include('assets/local/fa-6.4.0') ?>
    <style type="text/css">
    	.col {
    		border: 2px solid black;
    	}
    </style>
<?= $this->endSection() ?>

<?= $this->section('main') ?>

    <div class="container-fluid">
    	<div class="row mt-2">
    		<div class="col-3">
    			<div class="row">
    				<div class="col-12">
    					<h2 class="fs-5"><?= $user->email ?></h2>
    				</div>
    				<div class="col-12">
    					<div class="my-2">
    						<h2 class="fs-5 fw-bold"><i class="fa fa-user" style="color:#557ef9;"></i>  Akun Saya</h2>
    					</div>
    				</div>
    				<div class="col-12">
    					<div class="ms-4">
    						<h2 class="fs-5">Profil</h2>
    					</div>
    				</div>
    				<div class="col-12">
    					<div class="ms-4">
    						<h2 class="fs-5">Ubah Password</h2>
    					</div>
    				</div>
    				<div class="col-12">
    					<div class="ms-4">
    						<h2 class="fs-5">Pesanan Saya</h2>
    					</div>
    				</div>
    			</div>
    		</div>
    		<div class="col-9">
    			<div class="row">
    				<div class="col-12">
    					<h1 class="fs-2 wf-bold">Profil Saya</h1>
    					<span class="fs-5">Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</span>
    				</div>
    			</div>

    			<div class="row">
    				<div class="col-12">
    					<div class="row">
    						<div class="col-8">
    							<form>
    								<div class="row mb-3">
    									<label class="col-2 col-form-label">Nama</label>
    									<div class="col-10">
    										<span class="form-control"><?= $user->username ?></span>
    									</div>
    								</div>
    								<div class="row mb-3">
    									<label class="col-2 col-form-label">Email</label>
    									<div class="col-10">
    										<span class="form-control"><?= $user->email ?></span>
    									</div>
    								</div>
    								<div class="row mb-3">
    									<label class="col-2 col-form-label">Jenis Kelamin</label>
    									<div class="col-10">
    										<span class="form-control">-</span>
    									</div>
    								</div>
    								<div class="row mb-3">
    									<label class="col-2 col-form-label">Tanggal Lahir</label>
    									<div class="col-10">
    										<span class="form-control">-</span>
    									</div>
    								</div>
    								<div class="row mb-3">
    									<label class="col-2 col-form-label"></label>
    									<div class="col-10">
    										<button class="btn btn-md btn-primary">Simpan</button>
    									</div>
    								</div>
    							</form>
    							
    						</div>
    						<div class="col-4">
    							<div class="row h-100 mx-1">
    								<div class="col border border-2 border-dark">
    									<span class="m-2">awd</span>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
    <?= $this->include('assets/local/bs_js-530') ?>
<?= $this->endSection() ?>