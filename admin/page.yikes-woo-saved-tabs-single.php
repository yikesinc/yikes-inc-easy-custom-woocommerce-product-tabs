<?php 

// For safety purposes...
// Make sure we have a tab
if ( ! $new_tab && ( ! isset( $tab ) || empty( $tab ) ) ) {
	if ( isset( $redirect ) ) {
		echo '<p> Oops. It looks like something went wrong. Please <a href="' . $redirect . '" title="go back">go back</a> and try again</p>';
	}
	exit;
}

// Set variables before using them
$tab_title 	 = ( isset( $tab['tab_title'] ) && ! empty( $tab['tab_title'] ) ) ? $tab['tab_title'] : '';
$tab_content = ( isset( $tab['tab_content'] ) && ! empty( $tab['tab_content'] ) ) ? $tab['tab_content'] : '';
$tab_id 	 = ( isset( $tab['tab_id'] ) && ! empty( $tab['tab_id'] ) ) ? (int) $tab['tab_id'] : 'new';

// Tab stats
$number_of_products_using_this_tab = count( $products );

?>
<div class="wrap">
	<h1 class="screen-media">
		YIKES Custom Product Tabs | <span id="yikes_woo_tab_title_header"><?php echo $tab_title; ?></span>
		<span class="yikes_woo_tab_id page-title-action">ID: <?php echo $tab_id; ?></span>
	</h1>

	<div id="poststuff">

		<div class="yikes_woo_go_back_url">
			<a href="<?php echo $redirect; ?>"><?php _e( 'Go back', 'yikes-inc-easy-custom-woocommerce-product-tabs' ); ?></a>  
		</div>

			<h3 class="yikes_woo_saved_tab_header">Tab Info</h3>

					<div class="row yikes_woo_reusable_tabs_container" id="yikes_woo_reusable_tabs_container_<?php echo $tab_id ?>" data-tab-id="<?php echo $tab_id; ?>">

						<!-- Title -->
						<div class="yikes_woo_reusable_tab_title">
							<label class="yikes_woo_reusable_tab_title_label" for="yikes_woo_reusable_tab_title_<?php echo $tab_id; ?>">
								<?php _e( 'Tab Title', 'yikes-inc-easy-custom-woocommerce-product-tabs' ); ?>:
							</label>
							<input type="text" id="yikes_woo_reusable_tab_title_<?php echo $tab_id; ?>" value="<?php echo $tab_title; ?>" />
						</div>
						
						<!-- Content -->
						<div class="yikes_woo_reusable_tab_content">
							<?php 
								wp_editor( stripslashes( $tab_content ), 'yikes_woo_reusable_tab_content_' . $tab_id, array( 'textarea_name' => 'yikes_woo_reusable_tab_content_' . $tab_id, 'textarea_rows' => 8 ) );
							 ?>
						</div>

						<!-- Buttons -->
						<div class="yikes_woo_save_and_delete_tab_buttons">
							<span class="button-secondary yikes_woo_save_this_tab" id="yikes_woo_save_this_tab_<?php echo $tab_id; ?>" data-tab-id="<?php echo $tab_id; ?>">
								<i class="dashicons dashicons-star-filled inline-button-dashicons"></i>
								<?php _e( 'Save Tab', 'yikes-inc-easy-custom-woocommerce-product-tabs' ); ?>
							</span>
							<span class="button-secondary yikes_woo_delete_this_tab yikes_woo_delete_this_tab_single" id="yikes_woo_delete_this_tab_<?php echo $tab_id; ?>" data-tab-id="<?php echo $tab_id; ?>">
								<i class="dashicons dashicons-dismiss inline-button-dashicons"></i>
								<?php _e( 'Delete Tab', 'yikes-inc-easy-custom-woocommerce-product-tabs' ); ?>
							</span>
						</div>
					</div>

		<div class="yikes_woo_saved_tab_products">
			<h3 class="yikes_woo_saved_tab_header">Products</h3>
			<div class="inside entry-details-overview">
				<?php if ( $number_of_products_using_this_tab === 0 ) { ?>
					<p>
						This tab is currently not used for any products.
					</p>
				<?php } else { ?>
					<p>
						This tab is currently used on <span class="yikes_woo_number_of_products"><?php echo $number_of_products_using_this_tab; ?></span> product(s)
					</p>
					<?php foreach( $products as $product_id ) { ?> 
						<p>
							<?php $edit_product_url = add_query_arg( array( 'post' => $product_id, 'action' => 'edit' ), esc_url_raw( 'post.php' ) ); ?>
							<span> <a href="<?php echo $edit_product_url ?>"> <?php echo get_the_title( $product_id ); ?> </a> </span>
						</p>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>
</div>