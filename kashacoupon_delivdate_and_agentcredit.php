<?php

/**
 * Plugin Name: Kasha applied coupon, delivery date and kasha agent credit two
 * Plugin URI: http://kasha.rw
 * Description: This plugin helps to print the applied coupon, the delivery date and kasha agent credit on an invoice.
 * Author: Kasha inc-INEZAPamphile..
 * Author URI: http://kasha.rw/
 * Version: 1.0.0
 *  * Domain Path: /i18n/languages/
 *
 * Copyright: kasha inc
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
 * Required functions
 */
if ( !function_exists( 'woothemes_queue_update' ) ) {
	require_once( 'woo-includes/woo-functions.php' );
}

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), '7e2bf1e3609302c9b90b56dc9e24972e', '675401' );

include 'classes/class-wc-pickingpal-updater.php';
include 'classes/class-wc-pickingpal.php';

$wc_pickingpal = new WC_PickingPal();
register_activation_hook( __FILE__, array( $wc_pickingpal, 'activation' ) );

add_action( 'wp_ajax_wc_pickingpal', array( $wc_pickingpal, 'ajax_action' ) );
add_action( 'plugins_loaded', 'wc_pickpal_load_tdomain' );
add_action( 'woocommerce_loaded', 'oldversions_compatibility' );

function wc_pickpal_load_tdomain() {
	load_plugin_textdomain( 'woocommerce-pickingpal', false, dirname( plugin_basename( __FILE__ ) ) . '/i18n/languages' );
}

function oldversions_compatibility() {
	if ( !function_exists( "wc_get_product" ) ) {

		function wc_get_product( $the_product = false, $args = array() ) {
			return WC()->product_factory->get_product( $the_product, $args );
		}

	}
}

//// -=-=-= Example =-=-=-
//$f = function($fields) {
//	$fields['custom field'] = '';
//	return $fields;
//};
//add_filter( 'wc_pickingpal_custom_fields', $f, 10 );
//
//$f2 = function( $product, $field ) {
//	switch ( $field ) {
//		case 'custom field':
//			return $product->price;
//			break;
//	}
//};
//add_filter( 'wc_pickingpal_custom_field_value', $f2, 10, 2 );

