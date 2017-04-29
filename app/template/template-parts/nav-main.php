<nav class="nav-main">
    <?php wp_list_pages( '&title_li=' ); ?>
    <?php wp_nav_menu( array(
		'theme_location' => 'top',
		'menu_id'        => 'top-menu',
	) ); ?>
</nav>