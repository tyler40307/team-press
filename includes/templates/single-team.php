<?php

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();?>
			<div class="container-fluid page-content">
				<h1><?php the_title(); ?></h1>

		<?php
		// End the loop.
		endwhile;
		$connected = new WP_Query( array(
			  'connected_type' => 'match_to_team',
			  'connected_items' => $post,
			  'nopaging' => true
		) );
		// Display connected pages
		if ( $connected->have_posts() ) :
			?>
			<h3>Matches:</h3>
			<div class="row">
				<?php
				while($connected -> have_posts()) : $connected->the_post();?>
					<div class="col-md-6" id="team-<?php echo p2p_get_meta( get_post()->p2p_id, 'sides', true ); ?>">
						<?php echo p2p_get_meta( get_post()->p2p_id, 'sides', true ) . ' Team'; ?> : <?php the_title();?>
					</div>
				<?php endwhile; ?>
			</div>

			<?php
			wp_reset_postdata();

		endif;
		?>
		</div>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>