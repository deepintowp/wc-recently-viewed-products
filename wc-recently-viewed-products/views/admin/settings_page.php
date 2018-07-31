<?php 
/**
 * @package WC Recently viewed products
 * 
 */
/**
 * USE: To plugin Settings page Content
 */
if(!function_exists( 'rvps_setting_page_callback' )){
	function rvps_setting_page_callback(){
		?>
		<div id="wpbody" role="main">
				
			<div id="wpbody-content" aria-label="Main content" tabindex="0">
				<div class="wrap">
					<h1><?php _e('WC Recently viewed products', 'sour'); ?></h1>
						<?php 
							if(isset($_GET['rvps_save_error'])){
								echo '<div style="background: #ff000061; padding: 11px 5px; border-radius: 6px; font-size: 15px;" class="sour_validation_msg">'.urldecode( $_GET['rvps_save_error'] ).'</div>';
							}
							if(isset($_GET['rvps_success'])){
								echo '<div style="background:#00800063; padding: 11px 5px; border-radius: 6px; font-size: 15px;" class="sour_validation_msg">'.urldecode( $_GET['rvps_success'] ).'</div>';
							}
							
							 $rvps_settings = get_option( 'rvps_settings' );
						?>	
					<table class="form-table">
							<tbody>
							<form method="post" action="admin-post.php">
								
								<input type="hidden" name="action" value="rvps_save_settings_fields" />
								
								<?php wp_nonce_field('rvps_save_settings_fields_verify'); ?>
								<tr>
									<th scope="row">
										<label for="rvps_label"><?php _e( 'Recently viewed products label', 'rvps' ); ?></label>
									</th>
									<td>
										<input name="rvps_label" type="text" id="rvps_label" value="<?php if( isset( $rvps_settings['rvps_label'] ) ){ echo $rvps_settings['rvps_label']; } ?>" class="regular-text" required >
									</td>
								</tr>
								<tr>
									<th scope="row">
										<label for="rvps_numb_products"><?php _e( 'Number of recently viewed products', 'rvps' ); ?></label>
									</th>
									<td>
										<input name="rvps_numb_products" type="number" id="rvps_numb_products" value="<?php if( isset( $rvps_settings['rvps_numb_products'] ) ){ echo $rvps_settings['rvps_numb_products']; } ?>"  required >
									</td>
								</tr>
								
								
								<tr>
									<th scope="row">
										<label for="rvps_position"><?php _e( 'Recently viewed products position in product page', 'rvps' ); ?></label>
									</th>
									<td>
										<input <?php if( isset( $rvps_settings['rvps_position'] ) ){ if( $rvps_settings['rvps_position'] == 'before_related_product' ){  echo 'checked'; } } ?> name="rvps_position" type="radio" id="rvps_position" value="before_related_product" >
										<span style="padding-right:20px;" ><?php _e( 'Before Related Product', '' ); ?></span>
										
										<input <?php if( isset( $rvps_settings['rvps_position'] )){ if( $rvps_settings['rvps_position'] == 'after_related_product' ){  echo 'checked'; } } ?>  name="rvps_position" type="radio" id="rvps_position" value="after_related_product" >
										<span><?php _e( 'After Related Product', '' ); ?></span>
										
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="rvps_in_shop_page"><?php _e( 'Show Recently viewed products in shop page', 'rvps' ); ?></label>
									</th>
									<td>
										<input <?php if( isset( $rvps_settings['rvps_in_shop_page'] ) ){ if( $rvps_settings['rvps_in_shop_page'] == 'enabled' ){  echo 'checked'; } } ?> name="rvps_in_shop_page" type="checkbox" id="rvps_in_shop_page" value="enabled" > <span><?php _e( 'Show', 'rvps' ); ?></span>
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="rvps_in_cart_page"><?php _e( 'Show Recently viewed products in cart page', 'rvps' ); ?></label>
									</th>
									<td>
										<input <?php if( isset( $rvps_settings['rvps_in_cart_page'] ) ){ if( $rvps_settings['rvps_in_cart_page'] == 'enabled' ){  echo 'checked'; } } ?> name="rvps_in_cart_page" type="checkbox" id="rvps_in_cart_page" value="enabled" > <span><?php _e( 'Show', 'rvps' ); ?></span>
									</td>
								</tr>
								<tr>
									<td>
										<button name="save" class="button-primary" type="submit" value="<?php _e('Save Changes', 'rvps'); ?>">Save changes</button>
									</td>
								</tr>
							</form>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php
	}
}