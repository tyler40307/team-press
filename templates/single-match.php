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
        		'nopaging' => true,
        		'connected-meta' => array()
    		) );
			?>
			<div class="container page-content"><?php the_title(); ?>
				<div class="row">
				<?php
				while($connected -> have_posts()) : $connected->the_post();?>
					<div class="col-md-6" id="team-<?php echo p2p_get_meta( get_post()->p2p_id, 'sides', true ); ?>">
						<?php echo p2p_get_meta( get_post()->p2p_id, 'sides', true ) . ' Team'; ?> : <?php the_title();?>
					</div>
				<?php
				endwhile;
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				// End the loop.
				?>
				</div>
			</div>
		<?php endwhile;?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php get_footer(); ?>