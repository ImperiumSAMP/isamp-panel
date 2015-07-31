<div class="main-content">
<h2><?=$title?></h2>

<script type="text/javascript">
	function doSearch(){
		location.assign('/<?=$module?>/search/<?=$searchBy?>/'+document.getElementById('criteria').value)
	}
	
    $(function() {
        $( document ).tooltip({
          items: "[extra-data]",
          content: function() {
            var element = $( this );
            return element.attr("extra-data");
          }
        });
    });
</script>

<form action="#" onsubmit="doSearch()">
	<input type="text" id="criteria" /> 
	<input type="submit" value="Buscar" class="login-button" />
	<a href="/<?=$module?>/pending" class="register-button">Ver pendientes</a>
</form>
<?=$pagination?>
<?php echo $table;?>
<?=$pagination?>
</div>