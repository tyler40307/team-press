<?php
//to do move connected logic into connection class
//add match nav
get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			$connected = new WP_Query( array(
        		'connected_type' => 'match_to_team',
        		'connected_items' => $post,
        		'nopaging' => true
    		) );
			get_template_part( 'content', get_post_format() );
			while($connected -> have_posts()) : $connected->the_post();
				get_template_part( 'content', get_post_format() );;
			endwhile;

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		// End the loop.
		endwhile;
		?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>