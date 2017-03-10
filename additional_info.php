<?php

// Add this code to your themes function.php

add_action ( 'woocommerce_product_meta_end', 'add_full_detail_table', 7 );
function add_full_detail_table() {
	global $product ,$wpdb ,$woocommerce ,$post;	
	$product_id = $post->ID;
	// List all Attributes
	$has_row    = false;
	$alt = 1;
	$attributes = $product->get_attributes();	
	?>
	<table class="brand">
	<?php
	foreach ( $attributes as $attribute ) :
		// Attribute brand & article no
		if( $attribute['name'] =="pa_brand" || $attribute['name'] =="pa_article-no" ){
			?>
			<tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>">
			<td class="td_bo"><?php echo wc_attribute_label( $attribute['name'] ); ?>:</td>
			<td><?php
			if ( $attribute['is_taxonomy'] ) {		
				$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
				echo apply_filters( 'woocommerce_attribute',  wptexturize( implode( ', ', $values )  ), $attribute, $values );		
			} 
			?>
			</td>
			</tr>
				<?php
		}			
	 endforeach; 
	 ?></table>
	 <?php
}

?>
