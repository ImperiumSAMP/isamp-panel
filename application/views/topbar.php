<div class="topbar">
	<div class="topbar-content">
	<div style="display: inline-block;">
		
		<ul class="navigation-list">
			<li id="global-nav-home" class="home">
				<a class="nav" title="Inicio" href="<?=site_url('/')?>">
					<span class="home-icon"><img src="/gtasa-mapicons/player.gif"/></span>
					<span class="text">Inicio</span>
				</a>
			</li>
			
			<li id="global-nav-home" class="forum">
				<a class="nav" title="forum" href="http://www.pheek.net/foro/forumdisplay.php?fid=51">
					<span class="home-icon"><img src="/gtasa-mapicons/castle.png" width="24px" height="24px"/></span>
					<span class="text">Foros</span>
				</a>
			</li>
			
			<?php if(get_acclevel()>ACCLEVEL_USER) {?>
			<li>			
				<a class="nav" title="Usuarios" href="<?=site_url('player/search')?>">
					<span class="users-icon"><img src="/gtasa-mapicons/fac_blue.gif"/></span>
					<span class="text">Usuarios</span>
				</a>
			</li>
			<li>
				<a class="nav" title="Bans" href="<?=site_url('bans/search')?>">
					<span class="bans-icon"><img src="/gtasa-mapicons/property_red.gif"/></span>
					<span class="text">Bans</span>
				</a>
			</li>
			<li>
				<a class="nav" title="Propiedades" href="#">
					<span class="properties-icon"><img src="/gtasa-mapicons/property_green.gif"/></span>
					<span class="text">Propiedades</span>
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>
	<div id="session-info">
		<?=print_login_info();?>
	</div>
	</div>
</div>