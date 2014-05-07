<div class="main-content">
<div id="player-details">
	<div id="player-detail-skin" style="float: left; padding-right: 50px;">
		<img src="<?php echo strlen($Player->Skin)>1 ? '/skins/'.$Player->Skin.'.jpg' : '/skins/0'.$Player->Skin.'.jpg'; ?>" />
	</div>

	<div id="player-basic-info">
		<h2>Datos Básicos</h2>
		<div class="field"><span>Nombre: </span><?php echo $Player->Name ?></div>
		<div class="field"><span>Edad: </span><?php echo $Player->Age ?></div>
		<div class="field"><span>Nivel de admin: </span><?php echo $Player->AdminLevel ?></div>
		<div class="field"><span>Nivel: </span><?php echo $Player->Level ?></div>
		<div class="field"><span>Experiencia: </span><?php echo $Player->Exp ?></div>
		<div class="field"><span>Horas de juego: </span><?php echo $Player->PlayingHours ?></div>
		<?php if($Job){ ?>
		<div class="field"><span>Trabajo: </span><?php echo $Job->jName ?></div>
		<?php } ?>
		<?php if($Faction){ ?>
		<div class="field"><span>Faccion: </span><?php echo $Faction->Name ?></div>
		<?php } ?>
	</div>
	<div id="player-money" class="field">
		<h2>Dinero</h2>
		<span>En mano: </span>$<?php echo $Player->CashMoney ?> | <span>En el banco:</span> $<?php echo $Player->BankMoney ?>
	</div>
	<div id="player-inventory" class="field">
		<h2>Inventario</h3>
		<span>Materiales: </span><?php echo $Player->Materials ?> | <span>Tel&eacute;fono: </span><?php echo $Player->PhoneNumber ?> | <span>Extras: </span>-
	</div>
	
	<h2>Licencias: </h2>
	<?php if($Player->CarLic) echo "<img src='/license-icons/car.png'/>"; ?>
	<?php if($Player->FlyLic) echo "<img src='/license-icons/plane.png'/>"; ?>
	<?php if($Player->WepLic) echo "<img src='/license-icons/gun.png'/>"; ?>

</div>
</div>