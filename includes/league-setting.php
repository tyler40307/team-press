<?php
/**
*
*/
class League_Setting{
	public static function init(){
		self::add_style_setting();
		self::get_style_setting();
	}
	public static function add_style_setting(){
		Voce_Settings_API::GetInstance()->add_page( 'League Settings', 'League Settings', 'League-settings', 'manage_options', 'General settings for League', 'options-general.php' )
			->add_group( 'Team-Press Settings', 'league-settings' )
				->add_setting( 'Toggle League Styles', 'toggle_styles', array(
					'display_callback' => 'vs_display_checkbox',
					'sanitize_callbacks' => 'vs_sanitze_checkbox'
				) );
	}
	public static function get_style_setting(){
		$value = Voce_Settings_API::GetInstance()->get_setting('toggle_styles', 'league-settings', true);
		if($value == 'on'){
			wp_enqueue_style( 'bootstrap', plugins_url() . '/team-press/style.css' );
		}
	}
}
add_action( 'init', array( 'League_Setting' , 'init') ) ;