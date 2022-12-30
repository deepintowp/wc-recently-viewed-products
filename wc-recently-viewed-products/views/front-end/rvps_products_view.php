<?php 
/**
 * @package WC Recently viewed products
 * 
 */
/**
 * [rvps_products_view Recently viewed products markup]
 * @param  integer $col_num      [Number of product column]
 * @param  integer $pruducts_num [Number of product]
 * @return products markup
 */
if(!function_exists( 'rvps_products_view' )){
	function rvps_products_view($col_num = 0, $pruducts_num = 0){
		
		$products = 	new Rvps();
		$products_ids = $products->rvps_get_products();
		

		if(!$products_ids){
			return false;
		}

		//if any product not found in recently viewed product array
		if( count($products_ids) <= 0 ){
			return false;
		}
		$rvps_settings = get_option( 'rvps_settings' );
		
		// if $pruducts_num(default) is zero the change its value to as per setting(rvps_numb_products)
		
		if($pruducts_num == 0){
		$num_of_display_products = isset( $rvps_settings['rvps_numb_products'] ) ? $rvps_settings['rvps_numb_products'] : 4;
		}else{

			$num_of_display_products = $pruducts_num;
		}
		// getting last numbers of products from array as per settings(Number of recently viewed products) 
		if( count($products_ids) > $num_of_display_products ){
			$ids = array_slice($products_ids, -1 * $num_of_display_products , $num_of_display_products, true);
		}else{
			$ids = $products_ids;
		}
		
		
		// Query products based on products in 
		$the_query = new WP_Query( array(
				'post_type'  =>  'product',
				'post_status'  =>  'publish',
				'post__in'  =>  array_reverse( $ids ),
				'orderby' => 'post__in'
			));
		
		// Products Loop
		if ( $the_query->have_posts() ) {
			echo '<section class="rvps woocommerce columns-4">';
			echo '<h2>'.( isset( $rvps_settings['rvps_label'] ) ?  $rvps_settings['rvps_label']  : '' ).'</h2>';
				
				if($col_num == 0){
					$col = 4;
				}else{
					$col = $col_num;
				}
				
				echo '<ul class="products  columns-'. $col .'">';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					wc_get_template_part( 'content', 'product' );
				}
				echo '</ul>';
			echo '</section>';
			/* Restore  Post Data */
			wp_reset_postdata();
		}else{
			return false;
		}
		
		
		
	}
}