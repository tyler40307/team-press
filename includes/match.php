<?php
class Match_Post_Type{

	const POST_TYPE = 'match';

	public static function init(){
		self::register_post_type();
		self::register_meta();
		add_filter( 'template_include', array( __CLASS__, 'template_include' ) );
	}

	public static function register_post_type(){
		$labels = array(
			'name'                => __( 'Matchs', 'text-domain' ),
			'singular_name'       => __( 'Match', 'text-domain' ),
			'add_new'             => _x( 'Add New Match', 'text-domain', 'text-domain' ),
			'add_new_item'        => __( 'Add New Match', 'text-domain' ),
			'edit_item'           => __( 'Edit Match', 'text-domain' ),
			'new_item'            => __( 'New Match', 'text-domain' ),
			'view_item'           => __( 'View Match', 'text-domain' ),
			'search_items'        => __( 'Search Matchs', 'text-domain' ),
			'not_found'           => __( 'No Matchs found', 'text-domain' ),
			'not_found_in_trash'  => __( 'No Matchs found in Trash', 'text-domain' ),
			'parent_item_colon'   => __( 'Parent Match:', 'text-domain' ),
			'menu_name'           => __( 'Matchs', 'text-domain' ),
		);
		$args = array(
			'labels'              => $labels,
			'hierarchical'        => false,
			'description'         => 'description',
			'taxonomies'          => array(),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => null,
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'has_archive'         => true,
			'query_var'           => 'matches',
			'can_export'          => true,
			'rewrite'             => true,
			'capability_type'     => 'post',
			'supports'            => array(
				'title', 'editor', 'thumbnail',
				'excerpt', 'revisions','match-up', 'result')
		);
		register_post_type( self::POST_TYPE, $args );
	}

	public static function register_meta(){
		add_metadata_group('result' , 'Result', array(
			'capability' => 'edit_posts'
		));
		add_metadata_field( 'result', 'home-team-score', 'Home Team Score', 'text', array(
 			'default_value' => '0',
 			'sanitize_callbacks' => array( 'voce_numeric_value' )
		));
		add_metadata_field( 'result', 'away-team-score', 'Away Team Score', 'text', array(
 			'default_value' => '0',
 			'sanitize_callbacks' => array( 'voce_numeric_value' )
		));
		add_post_type_support( 'match', 'result' );
	}

	public static function template_include($template){
		$path = __DIR__;
		if( is_singular(Match_Post_Type::POST_TYPE) ){
			$template = apply_filters( 'single_match', $path . '/templates/single-match.php' );
		} else {
			if(is_archive(Match_Post_Type::POST_TYPE)){
				$template = apply_filters( 'archive_match', $path . '/templates/archive-match.php' );
			}
		}
		return $template;
	}

	public static function display_score( $id ){
		echo ''	?><h2>score:</h2>
			<div class="row">
				<div id="team-home" class="col-md-6"><?php echo 'Home Score: ' . Voce_Meta_API::GetInstance()->get_meta_value( $id, 'result', 'home-team-score' ); ?></div>
				<div id="team-away" class="col-md-6"><?php echo 'Away Score: ' . Voce_Meta_API::GetInstance()->get_meta_value( $id, 'result', 'away-team-score' ); ?></div>
			</div><?php
	}


	public static function display_the_match(){
		$args = array( 'post_type' => 'match', 'posts_per_page' => 1, 'meta_query' => 'home_team_score' );
		$match_posts = new WP_Query( $args );
		$connected_args = array(
			'connected_type' => 'match_to_team' ,
			'connected_items' => get_queried_object() ,
			'connected_meta' => array('key' => 'sides'),
			'nopaging' => true
			);
		$connected = new WP_Query( $connected_args );
		echo '' ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<div class="container-fluid page-content">
				<?php while( $match_posts -> have_posts()) : $match_posts->the_post() ?>
					<?php $id = post_id(); ?>
					<h1>this is the title: <?php the_title(); ?></h1>
					<h2>score:</h2>
					<div class="row">
						<div id="team-home" class="col-md-6"><?php echo 'Home Score: ' . Voce_Meta_API::GetInstance()->get_meta_value( $id, 'result', 'home-team-score' ); ?></div>
						<div id="team-away" class="col-md-6"><?php echo 'Away Score: ' . Voce_Meta_API::GetInstance()->get_meta_value( $id, 'result', 'away-team-score' ); ?></div>
					</div>
					<?php endwhile; ?>
					<div class="row">
					<?php
					while($connected -> have_posts()) : $connected->the_post();?>
						<div class="col-md-6" id="team-<?php echo p2p_get_meta( get_post()->p2p_id, 'sides', true ); ?>">
							<?php
							the_title();
							echo p2p_get_meta( get_post()->p2p_id, 'sides', true ) . ' Team' ?> : <?php the_title();?>
						</div>
					<?php endwhile; ?>
				</div>
				</div>
			</main><!-- .site-main -->
		</div><!-- .content-area --><?php
	}

}

add_action( 'init', array( 'Match_Post_Type' , 'init') ) ;
