<?php
class League_Setting{

	public static function init(){
		self::add_style_setting();
	}

	public static function league_style_setting(){
		self::is_league_style_set();
	}

	public static function add_style_setting(){
		Voce_Settings_API::GetInstance()->add_page( 'League Settings', 'League Settings', 'League-settings', 'manage_options', 'General settings for League', 'options-general.php' )
			->add_group( 'Team-Press Settings', 'league-settings' )
				->add_setting( 'Toggle League Styles', 'toggle_styles', array(
					'display_callback' => 'vs_display_checkbox',
					'sanitize_callbacks' => array( 'vs_sanitze_checkbox' )
				) );
	}

	public static function is_league_style_set(){
		if( Voce_Settings_API::GetInstance()->get_setting('toggle_styles', 'league-settings' )){
			wp_register_style( 'bootstrap', plugins_url( 'css/bootstrap.css' , __FILE__ ) );
			wp_enqueue_style( 'bootstrap' );
		}
	}
}

add_action( 'init', array( 'League_Setting' , 'init') ) ;

add_action( 'wp_enqueue_scripts', array('__CLASS__' , 'league_style_setting') );
