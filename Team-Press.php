<?php
/*
Plugin Name: teampress
Author:Tyler Cherpak
Description: A Plugin for Rec Leagues.
 */
if(file_exists( __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php' ) )
	include_once( __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php' );

if( !class_exists('Player_Post_Type') )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'data-structures' . DIRECTORY_SEPARATOR .'player.php' );

if( !class_exists('Team_Post_Type') )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'data-structures' . DIRECTORY_SEPARATOR .'team.php' );

if( !class_exists('Match_Post_Type') )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'data-structures' . DIRECTORY_SEPARATOR .'match.php' );

if( !class_exists('League_Post_Type') )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'data-structures' . DIRECTORY_SEPARATOR .'league.php' );

if( !class_exists('Match_Team_Connection') )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'data-structures' . DIRECTORY_SEPARATOR .'match-connection.php' );

if( !class_exists('Team_Player_Connection') )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'data-structures' . DIRECTORY_SEPARATOR .'player-connection.php' );