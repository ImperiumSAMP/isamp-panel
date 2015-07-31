<div class="main-content">
<div id="player-details">
    <div id="notification_area"><?=$Notifications?></div>

	<div id="certification-admincomments">
	<h2>Estado de la solicitud</h2>
	
	<div class="field"><span>Estado: </span><?php echo $Player->status ?></div>
	<div class="field"><span>&Uacute;ltima actualizaci&oacute;n: </span><?php echo $Player->lastedit ?></div>
	
    <?php if(isset($Player->admincomments) && $Player->admincomments!="") { ?>
	<div class="field"><span>Revisado por: </span><?php echo $Player->adminname ?></div>
		<h5>Comentarios del administrador</h2>
		<?php 
		    echo $Player->admincomments; 
		?>
    <?php } ?>
    
    </div>
    
    <?php
	    if($Player->status=='Rechazado')
	        echo '<div><br/><a class="forum-button" href="'.site_url("register/retry")."/".$Player->regtoken.'">Nuevo registro</a></div>';
    ?>

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
	
    
    <?php
    if(check_level(ACCLEVEL_MODERATOR)) {
    ?>
    <?php if(isset($Previous[1])){
    
        echo "<h2>Intentos previos</h2>";
        echo "<ul class='previous-registers'>";
        foreach($Previous as $prev){
            echo "<li>";
            
		    echo anchor_popup("/certification/detail_popup/$prev->regid","$prev->lastedit - $prev->name ($prev->status)",array(
          'width'      => '1000',
          'height'     => '800',
          'scrollbars' => 'yes',
          'status'     => 'no',
          'resizable'  => 'yes',
          'screenx'    => '0',
          'screeny'    => '0'
        ));
            echo "</li>";
        }
        echo "</ul>";
     } ?>
    
    <h2>Acciones administrativas</h2>
    
    <?php echo form_open('certification/certify/'.$Player->regid); ?>
    
    <div class="login-field">
				<span class="field-title"><h5>Comentarios</h5></span>
		        <?php echo form_error('admincomments'); ?>
				<span class="field-input"><textarea name="admincomments" title="Comentarios del administrador." maxlength="300" rows="5" cols="37"><?php echo $Player->admincomments ?></textarea></span>
	</div>
	
	<div><br><button type="submit" name="action" value="accept" class="register-button">Aprobar</button> <button type="submit" name="action" value="reject" class="login-button">Rechazar</button></div>
    <?php 
        echo form_close();
    } ?>

</div>
</div>