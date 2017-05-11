<div class="main-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p><?php the_author_meta( 'description' ); ?> </p>
    </div>
    <div class="sidebar-module">
        <h4>Archives</h4>
        <ol class="list-unstyled">
            <?php wp_get_archives( 'type=monthly' ); ?>
        </ol>
    </div>
    <?php if ( is_active_sidebar( 'sidepar-post' ) ) : ?>
        <?php dynamic_sidebar( 'sidepar-post' ); ?>					
    <?php endif; ?>
</div>