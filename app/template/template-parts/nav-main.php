<div class="c-navigatio-container" data-hamburger-target="">
	<div data-hamburger="" class="hamburger hamburger--3dx">
		<span class="hamburger-box">
			<span class="hamburger-inner"></span>
		</span>
	</div>
	<div class="c-navigatio-container__left">
		
		
	</div>
	<div class="c-navigatio-container__nabar">
		<?php 
			wp_nav_menu( array(
				'theme_location' => 'top',
				'container'      => 'nav',
				'container_class' => 'c-main-navigation',
				'menu_id'        => 'top-menu',
			)); 
		?>
		<?php //cbTemp::get_tags_menu(); ?>
	</div>
</div>