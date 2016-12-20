<div class="login-form">
	<h1>Ciudad de Los Santos</h1>

	<h2>Iniciar Sesi&oacute;n</h2>
	<div class="validation-errors">
		<?php echo validation_errors(); ?>
		<?php if ( $this->session->flashdata( 'message' ) ) : ?>
			<p><?php echo $this->session->flashdata( 'message' ); ?></p>
		<?php endif; ?>
	</div>
	<?php echo form_open('login'); ?>
		<div class="login-field">
			<span class="field-title"><h5>Usuario</h5></span>
			<span class="field-input"><input type="text" name="username" value="<?php echo set_value('username')?>" size="50" /></span>
		</div>

		<div class="login-field">
			<span class="field-title"><h5>Password</h5></span>
			<span class="field-input"><input type="password" name="password" value="" size="50" /></span>
		</div>

		<div><input type="submit" value="Iniciar sesi&oacute;n" class="login-button" /><a class="register-button" href="<?=site_url("register")?>">Crear cuenta</a><a class="forum-button" href="http://www.pheek.net/foro">Ir a los Foros</a></div>
	<?php echo form_close(); ?>
</div>