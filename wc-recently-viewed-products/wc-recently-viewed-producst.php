<?php
/**
 * @package WC Recently viewed products
 */
/*
Plugin Name:  Wc Recently viewed products
Plugin URI: https://github.com/deepintowp/wc-recently-viewed-products
Description:  Show recently viewed products by user on your Woocommerce store
Version: 1.0.0
Author: Subhasish Manna
Author URI: http://subhasishmanna.com
License: GPLv2 or later
Text Domain: rvps
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}
/*****************************************
CHECK WORDPRESS WERSION
*****************************************/
if ( version_compare( get_bloginfo('version'), '4.0', '<') )  {
    $message = "WordPress version is lower than 4.0.Need WordPress version 4.0 or higher.";
	die($message);
}

/*********
constants
**********/
define( 'RVPS_PATH', plugin_dir_path(__FILE__)   );
define( 'RVPS_URI', plugin_dir_url( __FILE__ )   );

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    if(!class_exists( 'RVPS_Core' )){
    	class RVPS_Core{
    		public function __construct(){
    			/**
    			 * Include Files
    			 */
				 require(RVPS_PATH.'/includes/activation.php');
				 require(RVPS_PATH.'/views/admin/settings_page.php');
				 require(RVPS_PATH.'/views/front-end/rvps_products_view.php');
				 require(RVPS_PATH.'/shortcodes/rvps.php');
				 
				/**
    			 * Include Classes
    			 */
				require(RVPS_PATH.'/classes/Rvps.php');
				require(RVPS_PATH.'/classes/Rvps_setting_page.php');
				require(RVPS_PATH.'/classes/Rvps_save_settings.php');
				require(RVPS_PATH.'/classes/Rvps_view.php');
				

    			/**
    			 * HOOKS 
    			 */
				register_activation_hook( __FILE__, 'rvps_activation' );
				add_action( 'init', array( new Rvps() , 'rvps_start_session'), 10 );
				add_action( 'init', array( new Rvps() , 'rvps_init_session'), 15 );
				add_action( 'wp', array( new Rvps() , 'rvps_update_products') );
				add_action( 'admin_menu', array( new Rvps_setting_page() , 'rvps_create_setting_page'));
				add_action( 'admin_post_rvps_save_settings_fields', array( new Rvps_save_settings(), 'rvps_save_admin_fields_settings'  ) );
				add_action( 'woocommerce_after_single_product_summary', array( new Rvps_view(), 'rvps_show_before_related_products'  ), 19 );
				add_action( 'woocommerce_after_single_product_summary', array( new Rvps_view(), 'rvps_show_after_related_products'  ), 21 );
				add_action( 'woocommerce_cart_collaterals', array( new Rvps_view(), 'rvps_show_in_cart_page'  ), 20 );
				add_action( 'woocommerce_after_shop_loop', array( new Rvps_view(), 'rvps_show_in_shop_page'  ), 15 );
				
				/**
    			 * HOOKS 
    			 */
				add_shortcode('rvps','rvps_shortcode');	
    		}
    	}
    	$sour_init = new RVPS_Core();
    }
}

