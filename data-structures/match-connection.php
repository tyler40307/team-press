<?php

class Match_Connections {

	public static function init() {
	if ( !function_exists('_p2p_init') )
		return _doing_it_wrong( __CLASS__, 'Posts to Posts plugin is required to register connections.', null );

		add_action( 'p2p_init',  array( __CLASS__, 'register_connections') );
	}

	public static function register_connections() {
		p2p_register_connection_type( array(
			'name' => 'teams_to_matches',
			'from' => 'team',
			'to' => 'match',
			'admin_box' => array(
				'show' => 'any',
				'context' => 'side'
			),
			'fields' => array(
				'count' => array(
					'title' => 'Count',
					'type' => 'text'
				)
			)
		) );
	}
}

add_action( 'init', array( 'Match_Connections', 'init' ) );