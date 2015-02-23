<?php

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'content', get_post_format() );

			// Previous/next match navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'twentyfifteen' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'twentyfifteen' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );
		// End the loop.
		endwhile;
		$connected = new WP_Query( array(
			  'connected_type' => 'match-to_team',
			  'connected_items' => get_queried_object(),
			  'nopaging' => true,
		) );
		// Display connected pages
		if ( $connected->have_posts() ) :
			?>
			<h3>Related pages:</h3>
			<ul>
			<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
			    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile; ?>
			</ul>

			<?php
			wp_reset_postdata();

		endif;
		?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>