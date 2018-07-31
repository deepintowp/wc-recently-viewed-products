<?php
/**
 * @package WC Recently viewed products
 */
if(!class_exists( 'Rvps_setting_page' )){
	class Rvps_setting_page{
		/**
		 * Use: Add settings page under woocommerce
		 */
		public function rvps_create_setting_page(){
			add_submenu_page( 'woocommerce', __('WC Recently Viewed Products', 'rvps'), __('WC Recently Viewed Products', 'rvps'), 'manage_options', 'rvps_settings', 'rvps_setting_page_callback' );
		}
	}
}