<?php
add_theme_support('woocommerce');





//===1. Show custom input field above Add to Cart===
add_action( 'woocommerce_before_add_to_cart_button', 'njengah_product_add_on', 9 );
function njengah_product_add_on() {
    $custom_sp_width  = isset($_POST['custom_sp_width'])  ?(int)$_POST['custom_sp_width']  :0;
    $custom_sp_height = isset($_POST['custom_sp_height']) ?(int)$_POST['custom_sp_height'] :0;
    $custom_sp_square = isset($_POST['custom_sp_square']) ?(int)$_POST['custom_sp_square'] :0;
    echo'<div><label>'.__('Width',  'xxx').'</label><input type="number" id="custom_sp_width"  min="0" step="1" name="custom_sp_width"  value="' . $custom_sp_width .  '"></div>';
    echo'<div><label>'.__('Height', 'xxx').'</label><input type="number" id="custom_sp_height" min="0" step="1" name="custom_sp_height" value="' . $custom_sp_height . '"></div>';
    echo'<div><label>'.__('Height', 'xxx').'</label><input type="number" id="custom_sp_square" min="0" step="1" name="custom_sp_square" value="' . $custom_sp_square . '" readonly></div>';
    echo'<script>
    		const custom_sp_width  = document.getElementById("custom_sp_width");
    		const custom_sp_height = document.getElementById("custom_sp_height");
    		const custom_sp_square = document.getElementById("custom_sp_square");
    		custom_sp_width.addEventListener("change", update_custom_sp_square);
    		custom_sp_height.addEventListener("change", update_custom_sp_square);
    		function update_custom_sp_square(){
    			custom_sp_square.value = parseInt(custom_sp_width.value) * parseInt(custom_sp_height.value);
    		}
    	 </script>';
}

//=== 2. Throw error if custom input field empty
add_filter( 'woocommerce_add_to_cart_validation', 'njengah_product_add_on_validation', 10, 3 );
function njengah_product_add_on_validation( $passed, $product_id, $qty ){
   if( isset( $_POST['custom_sp_width'] )  && (int)$_POST['custom_sp_width'] == 0 ) {
      wc_add_notice( __('Width is a required field', 'xxx'), 'error' );
      $passed = false;
   }
   if( isset( $_POST['custom_sp_height'] ) && (int)$_POST['custom_sp_height'] == 0 ) {
      wc_add_notice( __('Height is a required field', 'xxx'), 'error' );
      $passed = false;
   }
   if( isset( $_POST['custom_sp_square'] ) && (int)$_POST['custom_sp_square'] < 1 ) {
      wc_add_notice( __('Square is a required field', 'xxx'), 'error' );
      $passed = false;
   }
   return $passed;
}

//=== 3. Save custom input field value into cart item data
add_filter( 'woocommerce_add_cart_item_data', 'njengah_product_add_on_cart_item_data', 10, 2 );
function njengah_product_add_on_cart_item_data( $cart_item, $product_id ){
    if( isset( $_POST['custom_sp_width'] ) ) {
        $cart_item['custom_sp_width']  = (int)$_POST['custom_sp_width'];
    }
    if( isset( $_POST['custom_sp_height'] ) ) {
        $cart_item['custom_sp_height'] = (int)$_POST['custom_sp_height'];
    }
    if( isset( $_POST['custom_sp_square'] ) ) {
        $cart_item['custom_sp_square'] = (int)$_POST['custom_sp_square'];
    }
    return $cart_item;
}

//=== 4. Display custom input field value @ Cart
add_filter( 'woocommerce_get_item_data', 'njengah_product_add_on_display_cart', 10, 2 );
function njengah_product_add_on_display_cart( $data, $cart_item ) {
    if(isset( $cart_item['custom_sp_width'])){
        $data[] = array(
            'name'  => __('Width', 'xxx'),
            'value' => (int)$cart_item['custom_sp_width']
        );
    }
    if(isset( $cart_item['custom_sp_height'])){
        $data[] = array(
            'name'  => __('Height', 'xxx'),
            'value' => (int)$cart_item['custom_sp_height']
        );
    }
    if(isset( $cart_item['custom_sp_square'])){
        $data[] = array(
            'name'  => __('Square', 'xxx'),
            'value' => (int)$cart_item['custom_sp_square']
        );
    }
    return $data;
}

//=== 5. Save custom input field value into order item meta
add_action( 'woocommerce_add_order_item_meta', 'njengah_product_add_on_order_item_meta', 10, 2 );
function njengah_product_add_on_order_item_meta( $item_id, $values ) {
    if( !empty( $values['custom_sp_width'] )){
        wc_add_order_item_meta( $item_id, __('Width', 'xxx'), $values['custom_sp_width'], true );
    }
    if( !empty( $values['custom_sp_height'] )){
        wc_add_order_item_meta( $item_id, __('Height', 'xxx'), $values['custom_sp_height'], true );
    }
    if( !empty( $values['custom_sp_square'] )){
        wc_add_order_item_meta( $item_id, __('Square', 'xxx'), $values['custom_sp_square'], true );
    }
}

//=== 6. Display custom input field value into order table
add_filter( 'woocommerce_order_item_product', 'njengah_product_add_on_display_order', 10, 2 );
function njengah_product_add_on_display_order( $cart_item, $order_item ){
    if( isset( $order_item['custom_sp_width'] ) ){
        $cart_item['custom_sp_width']  = $order_item['custom_sp_width'];
    }
    if( isset( $order_item['custom_sp_height'] ) ){
        $cart_item['custom_sp_height'] = $order_item['custom_sp_height'];
    }
    if( isset( $order_item['custom_sp_square'] ) ){
        $cart_item['custom_sp_square'] = $order_item['custom_sp_square'];
    }
    return $cart_item;
}

//=== 7. Display custom input field value into order emails
add_filter( 'woocommerce_email_order_meta_fields', 'njengah_product_add_on_display_emails' );
function njengah_product_add_on_display_emails( $fields ) {
    $fields['custom_sp_width']  = __('Width',  'xxx');
    $fields['custom_sp_height'] = __('Height', 'xxx');
    $fields['custom_sp_square'] = __('Square', 'xxx');
    return $fields;
}













//===Display admin product squere price===
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_squareprice');
function woocommerce_product_squareprice() {
    global $product_object;
    echo'<div class=" product_squareprice">';
    woocommerce_wp_text_input([
        'id'          => 'SPSquarePrice',
        'label'       => __('Price to square:', 'woocommerce'),
        'placeholder' => __('Price to square:', 'woocommerce'),
        'desc_tip'    => 'true',
        'custom_attributes' => [
									'step' 	=> '1',
									'min'	=> '0'
								],
    ]);
    echo'</div>';
}
//===Save admin product squere price===
add_action('woocommerce_admin_process_product_object', 'woocommerce_product_custom_fields_save');
function woocommerce_product_custom_fields_save($product){
    if(isset($_POST['SPSquarePrice'])){
        $product->update_meta_data('SPSquarePrice', sanitize_text_field($_POST['SPSquarePrice']));
    }
}





//==add addition fields to checkout===
// function wc_ninja_remove_checkout_field($fields) {
	
	// unset($fields['billing']['billing_address_1']);
	// unset($fields['billing']['billing_address_2']);
	// unset($fields['billing']['billing_city']);
	// unset($fields['billing']['billing_state']);
	// unset($fields['billing']['billing_postcode']);
	// unset($fields['billing']['billing_phone']);
	// unset($fields['billing']['billing_company']);
	// unset($fields['billing']['billing_country']);
	
	// // Products currently in the cart
	// $cart_ids = array();
	
	// // Find each product in the cart and add it to the $cart_ids array
	// foreach(WC()->cart->get_cart() as $cart_item){
		// $cart_ids[] = $cart_item['product_id'];
	// }
	
	// if( in_array(get_field('sopt_psalenum_1', 'option'), $cart_ids) || 
		// in_array(get_field('sopt_psalenum_2', 'option'), $cart_ids) || 
		// in_array(get_field('sopt_psalenum_3', 'option'), $cart_ids) || 
		// in_array(get_field('sopt_psalenum_4', 'option'), $cart_ids) )
	// {
		// //===add fields===
		// if( in_array(get_field('sopt_psalenum_1', 'option'), $cart_ids) ){
			// $fields['billing']['_billing_tnm_p1_f1'] = array(
				// 'label'         => __('M/W -N°Ecole Doctoral', 'base'),
				// 'placeholder'   => _x('M/W', 'placeholder', 'base'),
				// 'required'      => false,
			// );
			// // unset($fields['billing']['_billing_tnm_p2_f1']);
			// // unset($fields['billing']['_billing_tnm_p34_f1']);
		// }
		
		// //===add fields===
		// if( in_array(get_field('sopt_psalenum_2', 'option'), $cart_ids) || in_array(get_field('sopt_psalenum_3', 'option'), $cart_ids) || in_array(get_field('sopt_psalenum_4', 'option'), $cart_ids) ){
			// if(in_array(get_field('sopt_psalenum_2', 'option'), $cart_ids)){ $scCount = get_field('sopt_psalenum_count_2', 'option'); }
			// if(in_array(get_field('sopt_psalenum_3', 'option'), $cart_ids)){ $scCount = get_field('sopt_psalenum_count_3', 'option'); }
			// if(in_array(get_field('sopt_psalenum_4', 'option'), $cart_ids)){ $scCount = get_field('sopt_psalenum_count_4', 'option'); }
			// $fields['billing']['_billing_tnm_p2_f1'] = array(
				// 'label'         => __('(№ laboratory) Nom du laboratoire', 'base'),
				// 'placeholder'   => _x('№ laboratory', 'placeholder', 'base'),
				// 'required'      => false,
				// 'class'         => array('form-row form-row-first'),
			// );
			// $fields['billing']['_billing_tnm_p34_f1'] = array(
				// 'label'         => __('EmaiList-subscribers (max '.$scCount.', separete ";")', 'base'),
				// 'placeholder'   => _x('List', 'placeholder', 'base'),
				// 'required'      => false,
				// 'class'         => array('form-row form-row-last'),
			// );
			// //unset($fields['billing']['_billing_tnm_p1_f1']);
		// }
	// }
	
	// return $fields;
// }
// add_filter('woocommerce_checkout_fields' , 'wc_ninja_remove_checkout_field');


// //===validate addition fields===
// add_action('woocommerce_checkout_process', 'customise_checkout_field_process');
// function customise_checkout_field_process(){
	// //if (!$_POST['_billing_tnm_p1_f1']) wc_add_notice(__('Please enter value.', 'base') , 'error');
// }


// //===save addition fields===
// add_action('woocommerce_checkout_update_order_meta', 'customise_checkout_field_update_order_meta');
// function customise_checkout_field_update_order_meta($order_id){
	// if (!empty($_POST['_billing_tnm_p1_f1'])) {
		// update_post_meta($order_id, '_billing_tnm_p1_f1', sanitize_text_field($_POST['_billing_tnm_p1_f1']));
	// }
	// if (!empty($_POST['_billing_tnm_p2_f1'])) {
		// update_post_meta($order_id, '_billing_tnm_p2_f1', sanitize_text_field($_POST['_billing_tnm_p2_f1']));
	// }
	// if (!empty($_POST['_billing_tnm_p34_f1'])) {
		// update_post_meta($order_id, '_billing_tnm_p34_f1', sanitize_text_field($_POST['_billing_tnm_p34_f1']));
	// }
// }


// //===show addition fields===
// add_action( 'woocommerce_admin_order_data_after_billing_address', 'edit_woocommerce_checkout_page', 10, 1 );
// function edit_woocommerce_checkout_page($order){
	// global $post_id;
	// $order = new WC_Order( $post_id );
	// if(get_post_meta($order->get_id(), '_billing_tnm_p1_f1', true )){
		// echo '<p><strong>'.__('M/W -N°Ecole Doctoral', 'base').':</strong> ' . get_post_meta($order->get_id(), '_billing_tnm_p1_f1', true ) . '</p>';
	// }
	// if(get_post_meta($order->get_id(), '_billing_tnm_p2_f1', true )){
		// echo '<p><strong>'.__('№ laboratory', 'base').':</strong> ' . get_post_meta($order->get_id(), '_billing_tnm_p2_f1', true ) . '</p>';
	// }
	// if(get_post_meta($order->get_id(), '_billing_tnm_p34_f1', true )){
		// echo '<p><strong>'.__('EmaiList-subscribers', 'base').':</strong> ' . get_post_meta($order->get_id(), '_billing_tnm_p34_f1', true ) . '</p>';
	// }
// }







