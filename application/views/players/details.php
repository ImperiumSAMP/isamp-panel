<div class="main-content">
<div id="player-details">
	<div id="player-detail-skin" style="float: left; padding-right: 50px;">
		<img src="<?php echo strlen($Player->Skin)>1 ? '/skins/'.$Player->Skin.'.jpg' : '/skins/0'.$Player->Skin.'.jpg'; ?>" />
	</div>

	<div id="player-basic-info">
		<h2>Datos Básicos</h2>
		<div class="field">Nombre: <?php echo $Player->Name ?></div>
		<div class="field">Edad: <?php echo $Player->Age ?></div>
		<div class="field">Nivel de admin: <?php echo $Player->AdminLevel ?></div>
		<div class="field">Nivel: <?php echo $Player->Level ?></div>
		<div class="field">Experiencia: <?php echo $Player->Exp ?></div>
		<div class="field">Horas de juego: <?php echo $Player->PlayingHours ?></div>
		<?php if($Job){ ?>
		<div class="field">Trabajo: <?php echo $Job->jName ?></div>
		<?php } ?>
		<?php if($Faction){ ?>
		<div class="field">Faccion: <?php echo $Faction->Name ?></div>
		<?php } ?>
	</div>
	<div id="player-money">
		<h2>Dinero</h3>
		En mano: $<?php echo $Player->CashMoney ?> | En el banco: $<?php echo $Player->BankMoney ?>
	</div>
	<div id="player-inventory">
		<h2>Inventario</h3>
		Materiales: <?php echo $Player->Materials ?> | Tel&eacute;fono: <?php echo $Player->PhoneNumber ?> | Extras: -
	</div>
	
	Licencias: 
	<?php if($Player->CarLic) echo "<img src='/license-icons/car.png'/>"; ?>
	<?php if($Player->FlyLic) echo "<img src='/license-icons/plane.png'/>"; ?>
	<?php if($Player->WepLic) echo "<img src='/license-icons/gun.png'/>"; ?>

</div>
</div>