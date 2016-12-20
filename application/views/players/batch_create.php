<div class="login-form">
	<h1>Ciudad de Los Santos</h1>

	<h2>Creaci&oacute;n de nuevo ciudadano</h2>
	<?php echo form_open('player/create'); ?>
		<div class="login-field">
			<span class="field-title"><h5>Nombre:</h5></span>
			<span class="field-input"><input type="text" name="name[]" value="" size="50" /></span>
			
			<span class="field-title"><h5>Nombre:</h5></span>
			<span class="field-input"><input type="text" name="name[]" value="" size="50" /></span>
			
			<span class="field-title"><h5>Nombre:</h5></span>
			<span class="field-input"><input type="text" name="name[]" value="" size="50" /></span>
			
			<span class="field-title"><h5>Nombre:</h5></span>
			<span class="field-input"><input type="text" name="name[]" value="" size="50" /></span>

		</div>

		<div><input type="submit" value="Registrar" class="login-button" /></div>
	<?php echo form_close(); ?>
</div>