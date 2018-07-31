<?php 
/**
 * @package WC Recently viewed products
 * Use: Save plugin settings
 */

if(!class_exists( 'Rvps_save_settings' )){
	class Rvps_save_settings{
		
		/**
		 *  USE: Save Plugin settings
		 */
		public function rvps_save_admin_fields_settings(){
			
				
				/*
				*	Check current user capability for edit settings
				*/
				if(!current_user_can('manage_options')){
					wp_die('You are not allowed to edit this page.');
				}
				
				/*
				*	Verify nonce field
				*/
				check_admin_referer('rvps_save_settings_fields_verify');
				
				
				$settings = array();
				
				/*
				*	Save rvps label
				*/ 
				
				// if rvps_label if empty 
				if( !isset( $_POST['rvps_label'] )  || $_POST['rvps_label'] == '' ){
					wp_redirect(get_admin_url().'admin.php?page=rvps_settings&rvps_save_error='.urlencode('Add recently viewed products label') );
					exit();
				}

				$settings['rvps_label'] = sanitize_text_field( $_POST['rvps_label'] );
				
				/*
				*	Save number of recently viewed products
				*/ 
				//Check if rvps_numb_products is empty
				if( !isset( $_POST['rvps_numb_products'] )  || $_POST['rvps_numb_products'] == '' ){
					wp_redirect(get_admin_url().'admin.php?page=rvps_settings&rvps_save_error='.urlencode('Add number of  recently viewed products') );
					exit();
				}
				
				//check rvps_numb_products value is numeric or not
				if(!is_numeric( $_POST['rvps_numb_products']  )){
					wp_redirect(get_admin_url().'admin.php?page=rvps_settings&rvps_save_error='.urlencode('Put numeric value only on number of  recently viewed products') );
					exit();
					
				}
				
				//check if rvps_numb_products value is negetive 
				if($_POST['rvps_numb_products'] <= 0 ){
					wp_redirect(get_admin_url().'admin.php?page=rvps_settings&rvps_save_error='.urlencode('Put positive numeric value only on number of  recently viewed products') );
					exit();
					
				}
				
				$settings['rvps_numb_products'] = sanitize_text_field( $_POST['rvps_numb_products'] );
				
				
				
				
				/*
				*	Save rvps position
				*/
				//check if rvps_position is empty
				if( !isset( $_POST['rvps_position'] )  || $_POST['rvps_position'] == '' ){
					wp_redirect(get_admin_url().'admin.php?page=rvps_settings&rvps_save_error='.urlencode('Select value where recent products will show in product page') );
					exit();
				}
				
				// name sure rvps_position value is before_related_product or after_related_product
				if( !in_array( $_POST['rvps_position'], array('before_related_product', 'after_related_product' ) ) ){
					wp_redirect(get_admin_url().'admin.php?page=rvps_settings&rvps_save_error='.urlencode('Invalid value of recently viewed products position.') );
					exit();
				}
				
				$settings['rvps_position'] = sanitize_text_field( $_POST['rvps_position'] );
				
				/*
				*	Save rvps show on shop page
				*/
				// save rvps_in_shop_page only when its value is enabled
				if( isset( $_POST['rvps_in_shop_page'] )  || $_POST['rvps_in_shop_page'] === 'enabled' ){
					$settings['rvps_in_shop_page'] = sanitize_text_field( $_POST['rvps_in_shop_page'] );
				}
				
				/*
				*	Save rvps show on cart page
				*/
				// save rvps_in_cart_page only when its value is enabled
				if( isset( $_POST['rvps_in_cart_page'] )  || $_POST['rvps_in_cart_page'] === 'enabled' ){
					$settings['rvps_in_cart_page'] = sanitize_text_field( $_POST['rvps_in_cart_page'] );
				}
				
				//update settings
				update_option( 'rvps_settings', $settings);
				
				wp_redirect(get_admin_url().'admin.php?page=rvps_settings&rvps_success='.urlencode('Field saved successfully.') );
				exit();
		}
	}
}