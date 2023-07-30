<?php if (! empty($errors)) : ?>
	<div class="d-flex flex-column">
		<?php foreach ($errors as $key => $error) : ?>
		<div class="p-1">
			<i class="fa-solid fa-triangle-exclamation"></i> <span><span class="font-weight-bold text-capitalize" style="text-decoration: underline;"><?= esc( str_replace("_", " ", $key) ) ?> :</span> <span class="text-monospace bg-warning text-dark"><?= esc($error) ?><span></span>
		</div>
		<?php endforeach ?>
	</div>
<?php endif ?>
