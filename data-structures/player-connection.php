<?php

class Team_Player_Connections {

	public static function init() {
	if ( !function_exists('_p2p_init') )
		return _doing_it_wrong( __CLASS__, 'Posts to Posts plugin is required to register connections.', null );

		add_action( 'p2p_init',  array( __CLASS__, 'register_connections') );
	}

	public static function register_connections() {
		p2p_register_connection_type( array(
			'name' => 'player_to_teams',
			'from' => 'player',
			'to' => 'team',
			'admin_box' => array(
				'show' => 'any',
				'context' => 'side'
			),
			'fields' => array(
				'count' => array(
					'title' => 'Position',
					'type' => 'text'
				)
			)
		) );
	}
}

add_action( 'init', array( 'Team_Player_Connections', 'init' ) );