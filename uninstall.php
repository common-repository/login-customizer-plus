<?php

	/**
	*
	* Trigger this file on Plugin Unistall.
	*
	*/


	if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {

		die;

	}

	// Clear the datebase.

	$login_customizer = get_posts( array( 'post_type' => 'login_customizer', 'numberposts' => -1 ) );

	foreach( $login_customizer as $login ) {
	wp_delete_post( $login->ID, true );

	}


	// Access the database via SQL
	global $wpdb;
	$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'login_customizer'" );
	$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
	$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
?>