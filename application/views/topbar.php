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
		</ul>
	</div>
	<div id="session-info">
		<?=print_login_info();?>
	</div>
	</div>
</div>