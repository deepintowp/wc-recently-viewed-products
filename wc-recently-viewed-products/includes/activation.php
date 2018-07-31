<?php 
/**
 * @package WC Recently viewed products
 * 
 */
if(!function_exists('rvps_activation')){
	/**
	 * [rvps_activation add setting option at the time of plugin activation]
	 * 
	 */
	function rvps_activation (){
		//check if rvps_settings option not found
		if(!get_option( 'rvps_settings' )){

				add_option( 'rvps_settings', array(
						'rvps_label' 			=> 'Recently viewed products',
						'rvps_numb_products' 	=> 4,
						'rvps_position' 		=> 'after_related_product',
						'rvps_in_shop_page' 	=> '',
						'rvps_in_cart_page' 	=> 'enabled'
				));
		}
	}
}