<?php 
/**
 * @package WC Recently viewed products
 */
if(!class_exists( 'Rvps_view' )){
	class Rvps_view{
		
		/**
		 * USE: Show recently Viewed products after related products on product page
		 */
		public function rvps_show_after_related_products(){
			$rvps_settings = get_option( 'rvps_settings' );
			if( !isset( $rvps_settings['rvps_position'] ) ){
				return;
			}
			//check  after_related_product option not selected
			if(  $rvps_settings['rvps_position'] !== 'after_related_product' ){
				return;
			}
			
			if( rvps_products_view() ){
				rvps_products_view();
			}
		}

		/**
		 * USE: Show recently Viewed products before related products on product page
		 */
		
		public function rvps_show_before_related_products(){
			
			$rvps_settings = get_option( 'rvps_settings' );
			if( !isset( $rvps_settings['rvps_position'] ) ){
				return;
			}

			//check  before_related_product option not selected
			if(  $rvps_settings['rvps_position'] !== 'before_related_product' ){
				return;
			}
			
			if( rvps_products_view() ){
				rvps_products_view();
			}
		}
		
		/**
		 * USE: Show recently Viewed products on cart page
		 */
		public function rvps_show_in_cart_page(){
			
			$rvps_settings = get_option( 'rvps_settings' );
			if( !isset( $rvps_settings['rvps_in_cart_page'] ) ){
				return;
			}

			//check if rvps_in_cart_page option  checked
			if(  $rvps_settings['rvps_in_cart_page'] !== 'enabled' ){
				return;
			}
			
			if( rvps_products_view() ){
				rvps_products_view();
			}
		}
		
		/**
		 * USE: Show recently Viewed products on shop page
		 */
		public function rvps_show_in_shop_page(){
			
			$rvps_settings = get_option( 'rvps_settings' );
			if( !isset( $rvps_settings['rvps_in_shop_page'] ) ){
				return;
			}

			//check if rvps_in_cart_page option  checked
			if(  $rvps_settings['rvps_in_shop_page'] !== 'enabled' ){
				return;
			}
			
			if( rvps_products_view() ){
				rvps_products_view();
			}
		}
		
		
		
		
	}
}