<section id="top-menu">
	<nav id="top-menu-content">
		<?php 
			wp_nav_menu( array(
				'theme_location' => 'top',
				'menu_id'        => 'top-menu',
			)); 
		?>
	</nav> 
</section>
 <section id="tag-menu">
    <div class="container">
      <div class="row">		
        <div class="col-sm-12">
			<nav class='tag-nav'>
				  <?php cbTemp::get_tags_menu(); ?>
			</nav>
        </div>
      </div>
    </div>	
  </section>