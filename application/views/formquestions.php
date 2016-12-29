<div class="register-form">
	<div id="title" valign="center"><h1><img src="/citylogo.png" width="60px">Ciudad de Los Santos</h1></div>

	<h2>Cuestionario de conceptos Roleplay</h2>
	
	<p>Bienvenido al &uacute;ltimo paso para registrar tu cuenta<br/>
	Luego de realizar el siguiente formulario el staff de certificaciones revisará tu solicitud en un lapso de entre 24 y 72 hs y así aprobar o rechazar tu registro</p>
	<p>Muchas gracias por realizar todos los pasos propuestos por el staff y en caso de ser aprobado esperemos tengas una grata y divertida estadia en el servidor.<br>
	Ante cualquier duda o consulta sobre su aplicaci&oacute;n, por favor comuniquese con nostros via <a href="http://www.pheek.net/foro">foro.</a>.</p>
	
	<div class="validation-errors">
		<?php if ( $this->session->flashdata( 'message' ) ) : ?>
			<p><?php echo $this->session->flashdata( 'message' ); ?></p>
		<?php endif; ?>
	</div>
	<?php echo form_open('questions'); ?>
	<?php if(isset($reg->regtoken)) echo "<input type='hidden' name='regtoken' value='$reg->regtoken'>"; ?>
	
		<div class="reg-sub">
			<h2>Cuestionario</h2>
			
			<div class="login-field">
				<span class="field-title"><h5>¿Qué es MG? Dar un ejemplo</h5></span>
			    <?php echo form_error('MG'); ?>
				<span class="field-input"><textarea name="MG" title="Detalla con un minimo de 200 caracteres el concepto de MG y da un ejemplo sobre el mismo." maxlength="1000" rows="5" cols="37"><?php echo set_value('MG',@$reg->MG)?></textarea></span>
			</div>
			
			<div class="login-field">
				<span class="field-title"><h5>¿Qué es PG? Dar un ejemplo</h5></span>
			    <?php echo form_error('PG'); ?>
				<span class="field-input"><textarea name="PG" title="Detalla con un minimo de 200 caracteres el concepto de PG y da un ejemplo sobre el mismo." maxlength="1000" rows="5" cols="37"><?php echo set_value('PG',@$reg->PG)?></textarea></span>
			</div>
		
			<div class="login-field">
				<span class="field-title"><h5></h5>¿Qué es DM? Dar un ejemplo</span>
		        <?php echo form_error('DM'); ?>	
				<span class="field-input"><textarea name="DM" title="Detalla con un minimo de 200 caracteres el concepto de DM y da un ejemplo sobre el mismo." maxlength="1000" rows="5" cols="37"><?php echo set_value('DM',@$reg->DM)?></textarea></span>
			</div>
		</div>
	    <div class="reg-sub">
			<h2>Definiciones </h2>
			
		    <div class="login-field">
				<span class="field-title"><h5>Definir los dos tipos de CK(normal y policial) y dar un ejemplo de cada uno</h5></span>
		        <?php echo form_error('CKS'); ?>	
				<span class="field-input"><textarea name="CKS" title="Detalla con un minimo de 200 caracteres los conceptos de CK y da un ejemplo de cada uno." maxlength="1000" rows="5" cols="37"><?php echo set_value('CKS',@$reg->CKS)?></textarea></span>
			</div>
	
			<div class="login-field">
				<span class="field-title"><h5>Define que es el rol de entorno y da un ejemplo</h5></span>
	            <?php echo form_error('RolEntorno'); ?>
				<span class="field-input"><textarea name="RolEntorno" title="Explica en un minimo de 200 caracteres que es el rol de entorno y en que situaciones se amerita rolearlo." maxlength="1000" rows="5" cols="37"><?php echo set_value('RolEntorno',@$reg->RolEntorno)?></textarea></span>
			</div>
		
			<div><br><input type="submit" value="Listo" class="login-button" /></div>
		
		</div>
		
	<?php echo form_close(); ?>
</div>