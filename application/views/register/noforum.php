<div class="register-form">
	<div id="title" valign="center"><h1><img src="/citylogo.png" width="60px">Ciudad de Los Santos</h1></div>

	<h2>Formulario de solicitud de ciudadan&iacute;a</h2>
	
	<p>Bienvenido a la ciudad de Los Santos.<br/>
	Para solicitar tu ciudadan&iacute;a en la ciudad de Los Santos, es necesario estar registrado y haber iniciado sesi&oacute;n en nuestros <a href="http://www.pheek.net/foro">foros de atenci&oacute;n al ciudadano</a>.</p>
	<p>Por favor, inicia sesi&oacute;n en el foro y vuelve a esta p&aacute;gina para continuar.</p>
	
	<h3>Inicio de sesi&oacute;n en los foros Pheek.net</h3>
	
    <div>
        <form method="post" action="http://www.pheek.net/foro/member.php">
            <input type="hidden" name="action" value="do_login"/>
            <input type="hidden" name="url" value="<?=current_url()?>"/>
            <div class="login-field">
    			<span class="field-title"><h5>Usuario</h5></span>
    			<span class="field-input"><input type="text" name="username" value="<?php echo set_value('username')?>" size="50" /></span>
    		</div>
    
    		<div class="login-field">
    			<span class="field-title"><h5>Password</h5></span>
    			<span class="field-input"><input type="password" name="password" value="" size="50" /></span>
    		</div>
            <div><input type="submit" class="forum-button" href="#" value="Iniciar sesi&oacute;n" />    
            <a class="register-button" href="#">Crear cuenta</a></div>
    </div>
</div>