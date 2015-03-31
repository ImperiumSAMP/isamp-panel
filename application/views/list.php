<div class="main-content">
<h2><?=$title?></h2>

<script type="text/javascript">
	function doSearch(){
		location.assign('/<?=$module?>/search/<?=$searchBy?>/'+document.getElementById('criteria').value)
	}
</script>

<form action="#" onsubmit="doSearch()">
	<input type="text" id="criteria" /> 
	<input type="submit" o value="Buscar" class="login-button" />
</form>
<?=$pagination?>
<?php echo $table;?>
<?=$pagination?>
</div>