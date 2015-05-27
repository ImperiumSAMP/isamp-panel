<div class="main-content">
<div id="player-details">
    <div id="notification_area"><?=$Notifications?></div>

	<div id="certification-basic-info">
		<h2>Datos del registro</h2>
		<div class="field"><span>Nombre: </span><?php echo $Player->name ?></div>
		<div class="field"><span>Edad: </span><?php echo $Player->age ?></div>
		<div class="field"><span>Lugar de origen: </span><?php echo $Player->birthplace ?></div>
		<div class="field"><span>Descripción física del personaje: </span><?php echo $Player->bio ?></div>
		
		<h2>Datos OOC</h2>
		<div class="field"><span>Nombre Real: </span><?php echo $Player->realname ?></div>
		<div class="field"><span>Edad real: </span><?php echo $Player->realage ?></div>
		<div class="field"><span>Historia del personaje: </span><?php echo $Player->story ?></div>
	</div>
	<div id="certification-admincomments">
		<h2>Comentarios del administrador</h2>
		<?php echo $Player->admincomments ?>
	</div>

    <?php print_if_level(ACCLEVEL_MODERATOR,"<h2>Acciones administrativas</h2>".anchor("player/create/".$Player->name,"Resetear password"));?>

</div>
</div>