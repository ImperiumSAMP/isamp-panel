	<h1><img src="http://www.malosaires.com.ar/citylogo.png" width="60px"/>Ciudad de Malos Aires</h1>

	<h2>Actualización de estado de solicitud de ciudadanía</h2>
	
	<p>Estimado <?=$name ?>,</p>
	<p>Nos dirigimos a usted para informarle que su solicitud de ciudadan&iacute;a se encuentra ahora <?=$status ?>.</p>
	<p>Puede acceder al enlace a continuaci&oacute;n para conocer m&aacute;s detalles.</p>
	<p><?php echo site_url("certification/status/$token") ?></p>
	<br/>
	<p>Atte.<br>Gobierno de la Ciudad<br>Subsecretar&iacute; de migraciones</p>
