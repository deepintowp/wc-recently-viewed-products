<?php
/**
 * @package WC Recently viewed products
 * 
 */

/**
 * use to create wc recently view product shortcode
 */
if(!function_exists( 'rvps_shortcode' )){
	function rvps_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
				'column'=> 4,
				'products'=> 4,
				
		),$atts,'rvps'));
		
	return rvps_products_view( $column, $products );
	}
}