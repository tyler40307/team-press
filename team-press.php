<?php
/*
Plugin Name: teampress
Author:Tyler Cherpak
Description: A Plugin for Rec League Basketball.
 */
if(file_exists( __DIR__ . '/vendor/autoload.php' ) )
	include_once( __DIR__ . '/vendor/autoload.php' );

do_action( 'wp_load_dependency', 'posts-to-posts' );

if( !class_exists('Player_Post_Type') )
	require_once( __DIR__ . '/includes/player.php' );

if( !class_exists('Team_Post_Type') )
	require_once( __DIR__ . '/includes/team.php' );

if( !class_exists('Match_Post_Type') )
	require_once( __DIR__ . '/includes/match.php' );

if( !class_exists('Match_Team_Connection') )
	require_once( __DIR__ . '/includes/connections.php' );