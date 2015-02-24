<?php
get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
		while ( have_posts() ) : the_post();
			$home_score = Match_Post_Type::display_home_score();
			$away_score = Match_Post_Type::display_away_score();
			$connected = new WP_Query( array(
        		'connected_type' => 'match_to_team',
        		'connected_items' => $post,
        		'nopaging' => true
    		) );
			?>
			<div class="container-fluid page-content">
				<h1><?php the_title(); ?></h1>
				<div class="row">
				<?php
				while($connected -> have_posts()) : $connected->the_post();?>
					<div class="col-md-6" id="team-<?php echo p2p_get_meta( get_post()->p2p_id, 'sides', true ); ?>">
						<?php echo p2p_get_meta( get_post()->p2p_id, 'sides', true ) . ' Team'; ?> : <?php the_title();?>
					</div>
				<?php endwhile; ?>
				</div>
				<div class="row">
				<h2>score:</h2>
				</div>
				<div class="row">
					<div id="team-home" class="col-md-6"><?php printf('Home Score: ' . $home_score) ?></div>
					<div id="team-away" class="col-md-6"><?php print('Away Score: ' .$away_score) ?></div>
				</div>
			</div>
		<?php endwhile;?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php get_footer(); ?>