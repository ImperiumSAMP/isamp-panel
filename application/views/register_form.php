<div class="register-form">
	<div id="title" valign="center"><h1><img src="/citylogo.png" width="60px">Ciudad de Malos Aires</h1></div>

	<h2>Formulario de solicitud de ciudadan&iacute;a</h2>
	
	<p>Bienvenido a la ciudad de Malos Aires.<br/>
	Completando el siguiente formulario, usted podr&aacute; aplicar para la ciudadan&iacute;a Argencholina, necesaria para poder permanecer en la ciudad.</p>
	<p>Luego de recibir su solicitud, nuestra oficina de migraciones la procesar&aacute; y le informar&aacute; en el transcurso de 72 hs habiles en caso de ser otorgada.<br>
	Ante cualquier duda o consulta sobre su aplicaci&oacute;n, por favor comuniquese con nostros via el <a href="http://www.imperiumgames.com.ar/foro">foro de atenci&oacute;n al ciudadano</a>.</p>
	
	<div class="validation-errors">
		<?php echo validation_errors(); ?>
		<?php if ( $this->session->flashdata( 'message' ) ) : ?>
			<p><?php echo $this->session->flashdata( 'message' ); ?></p>
		<?php endif; ?>
	</div>
	<?php echo form_open('player/register'); ?>
		<div class="reg-sub">
			<h2>Datos personales (IC)</h2>
			<div class="login-field">
				<span class="field-title"><h5>Nombre y apellido ((Usuario))</h5></span>
				<span class="field-input"><input type="text" name="username" value="<?php echo set_value('username')?>" size="50" /></span>
			</div>

			<div class="login-field">
				<span class="field-title"><h5>Contrase&ntilde;a</h5></span>
				<span class="field-input"><input type="password" name="password" value="" size="50" /></span>
			</div>
			
			<div class="login-field">
				<span class="field-title"><h5>Edad</h5></span>
				<span class="field-input"><input type="text" name="age" value="<?php echo set_value('age')?>" size="50" /></span>
			</div>
			
			<div class="login-field">
				<span class="field-title"><h5>Lugar de nacimiento / origen</h5></span>
				<span class="field-input"><input type="text" name="birthplace" value="<?php echo set_value('age')?>" size="50" /></span>
			</div>
			
					<div class="login-field">
				<span class="field-title"><h5>Breve descripci&oacute;n de su persona</h5></span>
				<span class="field-input"><textarea name="bio" rows="5" cols="37"><?php echo set_value('bio')?></textarea></span>
			</div>
		</div>
		<div class="reg-sub">
			<h2>Datos OOC</h2>
			<div class="login-field">
				<span class="field-title"><h5>Nombre real</h5></span>
				<span class="field-input"><input type="text" name="realname" value="<?php echo set_value('realname')?>" size="50" /></span>
			</div>
			
			<div class="login-field">
				<span class="field-title"><h5>Edad</h5></span>
				<span class="field-input"><input type="text" name="realage" value="<?php echo set_value('realage')?>" size="50" /></span>
			</div>
			
			<div class="login-field">
				<span class="field-title"><h5>E-Mail</h5></span>
				<span class="field-input"><input type="text" name="email" value="<?php echo set_value('email')?>" size="50" /></span>
			</div>
			
			<div class="login-field">
				<span class="field-title"><h5>Nombre de usuario en el foro</h5></span>
				<span class="field-input"><input type="text" name="forumuser" value="<?php echo set_value('forumuser')?>" size="50" /></span>
			</div>
		
			<div><br><input type="submit" value="Firmar y enviar" class="login-button" /></div>
		
		</div>
	
		
	<?php echo form_close(); ?>
</div>