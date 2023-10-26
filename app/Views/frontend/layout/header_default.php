<!DOCTYPE html>
<html lang="id">
<head>
	<title><?= $title ?? 'Page Title' ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="ibnulimc">
	<meta name="description" content="<?= esc($identitas['meta_deskripsi']) ?>">
	<meta name="keywords" content="<?= esc($identitas['meta_keyword']) ?>">
	<meta name="robots" content="all,index,follow">
	<meta http-equiv="Content-Language" content="id-ID">
	<meta NAME="Distribution" CONTENT="Global">
	<meta NAME="Rating" CONTENT="General">
	<meta property="og:locale" content="id_ID" />
	<meta property="og:title" content="<?= esc($title) ?>" />
	<meta property="og:description" content="<?= esc($identitas['meta_deskripsi']) ?>" />
	<meta property="og:url" content="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
	<meta property="og:site_name" content="<?= esc($identitas['nama_website']) ?>" />

	<link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>/asset/images/favicon.ico" />
	<?= $this->renderSection('cdn-head') ?>
</head>