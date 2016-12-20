<div class="register-form">
	<div id="title" valign="center"><h1><img src="/citylogo.png" width="60px">Ciudad de Los Santos</h1></div>

	<h2>Formulario de solicitud de ciudadan&iacute;a</h2>
	
	<p>Bienvenido a la ciudad de Los Santos.<br/>
	Completando el siguiente formulario, usted podr&aacute; aplicar para la ciudadan&iacute;a Argencholina, necesaria para poder permanecer en la ciudad.</p>
	<p>Luego de recibir su solicitud, nuestra oficina de migraciones la procesar&aacute; y le informar&aacute; en el transcurso de 72 hs habiles en caso de ser otorgada.<br>
	Ante cualquier duda o consulta sobre su aplicaci&oacute;n, por favor comuniquese con nostros via el <a href="http://www.pheek.net/foro">foro de atenci&oacute;n al ciudadano</a>.</p>
	
	<div class="validation-errors">
		<?php if ( $this->session->flashdata( 'message' ) ) : ?>
			<p><?php echo $this->session->flashdata( 'message' ); ?></p>
		<?php endif; ?>
	</div>
	<?php echo form_open('register'); ?>
	<?php if(isset($reg->regtoken)) echo "<input type='hidden' name='regtoken' value='$reg->regtoken'>"; ?>
	
		<div class="reg-sub">
			<h2>Datos personales (IC)</h2>
			
			<div class="login-field">
				<span class="field-title"><h5>Nombre y apellido ((Usuario))</h5></span>
			    <?php echo form_error('name'); ?>
				<span class="field-input"><input type="text" title="Nombre y apellido del personaje en formato Nombre_Apellido. Este será, además, tu nombre de usuario para ingresar al servidor." name="name" value="<?php echo set_value('name',@$reg->name)?>" size="40" /></span>
			</div>

			<div class="login-field">
				<span class="field-title"><h5>Contrase&ntilde;a</h5></span>
                <?php echo form_error('password'); ?>
				<span class="field-input"><input type="password" name="password" value="" size="40" /></span>
			</div>

			<div class="login-field">
				<span class="field-title"><h5>Repetir Contrase&ntilde;a</h5></span>
                <?php echo form_error('password-validation'); ?>
				<span class="field-input"><input type="password" name="password-validation" value="" size="40" /></span>
			</div>
			
			<div class="login-field">
				<span class="field-title"><h5>Edad</h5></span>
			    <?php echo form_error('age'); ?>
				<span class="field-input"><input type="text" name="age" title="Edad del personaje." value="<?php echo set_value('age',@$reg->age)?>" size="40" /></span>
			</div>
			
			<div class="login-field">
				<span class="field-title"><h5>Lugar de nacimiento / origen</h5></span>
			    <?php echo form_error('birthplace'); ?>
				<span class="field-input"><input type="text" name="birthplace" title="Ciudad de origen de tu personaje. Puede ser una ciudad real, o una ficticia compatible con el universo de Los Santos. NO son válidas los ciudades del GTA." value="<?php echo set_value('birthplace',@$reg->birthplace)?>" size="40" /></span>
			</div>
			
			<div class="login-field">
				<span class="field-title"><h5>Descripción física ((bio))</h5></span>
			    <?php echo form_error('bio'); ?>
				<span class="field-input"><textarea name="bio" title="Descripción física del personaje, ser&aacute; visible IG." maxlength="300" rows="5" cols="37"><?php echo set_value('bio',@$reg->bio)?></textarea></span>
			</div>
		</div>
		<div class="reg-sub">
			<h2>Datos OOC</h2>
			
			<div class="login-field">
				<span class="field-title"><h5>Nombre real</h5></span>
			    <?php echo form_error('realname'); ?>
				<span class="field-input"><input type="text" name="realname" title="Tu nombre en la vida real" value="<?php echo set_value('realname',@$reg->realname)?>" size="40" /></span>
			</div>
			
			<div class="login-field">
				<span class="field-title"><h5>Edad</h5></span>
			    <?php echo form_error('realage'); ?>
				<span class="field-input"><input type="text" name="realage" title="Tu edad en la vida real" value="<?php echo set_value('realage',@$reg->realage)?>" size="40" /></span>
			</div>
		
			<div class="login-field">
				<span class="field-title"><h5>E-mail</h5></span>
		        <?php echo form_error('email'); ?>	
				<span class="field-input"><input type="text" name="email" title="Direccion de correo para recuperar tu cuenta y recibir notificaciones." value="<?php echo set_value('email',@$reg->email)?>" size="40" /></span>
			</div>
		
			<div class="login-field">
				<span class="field-title"><h5>Nombre de usuario en el foro</h5></span>
		        <?php echo form_error('forumuser'); ?>	
				<span class="field-input"><input type="text" name="forumuser" title="Necesitas un usuario en el foro de Pheek.net. Si no ten&eacute;s uno, por favor crealo antes de registrar tu cuenta." value="<?php echo set_value('forumuser',@$reg->forumuser)?>" size="40" /></span>
			</div>
	
			<div class="login-field">
				<span class="field-title"><h5>Resumen de la historia del personaje</h5></span>
	            <?php echo form_error('story'); ?>
				<span class="field-input"><textarea name="story" title="Escribe brevemente la historia de tu personaje y como llega a la ciudad." maxlength="1000" rows="5" cols="37"><?php echo set_value('story',@$reg->story)?></textarea></span>
			</div>
		
			<div><br><input type="submit" value="Firmar y enviar" class="login-button" /></div>
		
		</div>
	
		
	<?php echo form_close(); ?>
</div>