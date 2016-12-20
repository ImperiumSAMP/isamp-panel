<div class="register-form">
	<div id="title" valign="center"><h1><img src="/citylogo.png" width="60px">Ciudad de Malos Aires</h1></div>

	<h2>Actualizaci&oacute;n de estado de solicitud de ciudadan&iacute;a</h2>
	
	<p>Estimado <?=$name ?>,</p>
	<p>Nos dirigimos a usted para informarle que su solicitud de ciudadan&iacute;a se encuentra ahora <?=$status ?>:</p>
	<p>Puede acceder al enlace a continuaci&oacute;n para conocer m&aacute;s detalles.</p>
	<p><span class="important"><?php echo anchor("certification/status/$token") ?></span>.</p>
	<p>Atte.<br/>Gobierno de la Ciudad</p>
</div>
