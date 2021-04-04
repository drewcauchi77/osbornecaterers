<?php
// Function related to WooCommerce

// remove breadrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// single product template - display cart form, remove everything else
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

// Change Checkout Notes Label and Place Holder Text
// https://gist.github.com/JeffAspen/68e3e4ca775478bf52de
add_filter( 'woocommerce_checkout_fields' , 'osborne_checkout_notes_fields' );

// Our hooked in function - $fields is passed via the filter!
function osborne_checkout_notes_fields( $fields ) {
	$fields['order']['order_comments']['placeholder'] = 'Add any special requirements or allery details here.';
	$fields['order']['order_comments']['label'] = 'Special Requirements';
	return $fields;
}

// Add a new checkout field: https://www.kathyisawesome.com/woocommerce-customize-checkout-fields/
add_filter( 'woocommerce_checkout_fields', 'osborne_filter_checkout_fields' );

function osborne_filter_checkout_fields($fields){
    $fields['extra_fields'] = array(
		// 'event_date' => array(
		// 	'type' => 'date',
		// 	'required'      => true,
		// 	'label' => __( 'Date' )
        // ),
        'event_date_new' => array(
			'type'          => 'date',
			'required'      => true,
            'label'         => __( 'Date' ),
		),
		'event_time_new' => array(
			'type'          => 'time',
			'required'      => true,
            'label'         => __( 'Time' )
        ),
		// 'event_address' => array(
		// 	'type' => 'text',
		// 	'required'      => true,
		// 	'label' => __( 'Address' )
		// )
	);

    return $fields;
}

// display the extra field on the checkout form
add_action( 'woocommerce_checkout_after_customer_details' ,'osborne_extra_checkout_fields' );

function osborne_extra_checkout_fields(){ 

    $checkout = WC()->checkout(); ?>

    <div class="extra-fields">
    <h3><?php _e( 'Delivery Details' ); ?></h3>
    <h4 style="padding-left: 3px;">Please note that enquires for delivery must be made at least two days in advance.<br> Available delivery times are from 10:00-18:00 hours.</h4>

    <?php 
    // because of this foreach, everything added to the array in the previous function will display automagically
    //foreach ( $checkout->checkout_fields['extra_fields'] as $key => $field ) : ?>

            <?php //woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
            <!-- <input type="date" class="input-text " name="event_date_new" id="event_date_new" placeholder="" value="" min="2020-12-05">
            <input type="time" class="input-text " name="event_time_new" id="event_time_new" placeholder="" value=""> -->

            <?php $dateMin = date("Y-m-d", strtotime("+2 day")); ?>

            <p class="form-row validate-required" id="event_date_new_field" data-priority="" style="display: inline-block;">
                <label for="event_date_new" class="">Date&nbsp;<abbr class="required" title="required">*</abbr></label>
                <span class="woocommerce-input-wrapper">
                    <input type="date" class="input-text " name="event_date_new" id="event_date_new" placeholder="" value="" min="<?php echo $dateMin; ?>">
                </span>
            </p>

            <p class="form-row validate-required" id="event_time_new_field" data-priority="" style="display: inline-block;">
                <label for="event_time_new" class="">Time&nbsp;<abbr class="required" title="required">*</abbr></label>
                <span class="woocommerce-input-wrapper">
                    <input class="input-text " name="event_time_new" id="event_time_new" placeholder="" style="height:36px;border:1px solid #c1c0c1;">
                </span>
            </p>

    <?php //endforeach; ?>
    </div>

<?php }

// save the extra field when checkout is processed
add_action( 'woocommerce_checkout_create_order', 'osborne_save_extra_checkout_fields', 10, 2 );

function osborne_save_extra_checkout_fields( $order, $data ){

    // don't forget appropriate sanitization if you are using a different field type
    if( isset( $data['event_date_new'] ) ) {
        $order->update_meta_data( '_event_date', sanitize_text_field( $data['event_date_new'] ) );
	}
	
	if( isset( $data['event_time_new'] ) ) {
        $order->update_meta_data( '_event_time', sanitize_text_field( $data['event_time_new'] ) );
	}
	
	// if( isset( $data['event_address'] ) ) {
    //     $order->update_meta_data( '_event_address', sanitize_text_field( $data['event_address'] ) );
    // }
}

// display the extra data on order recieved page and my-account order review
add_action( 'woocommerce_thankyou', 'osborne_display_order_data', 20 );
add_action( 'woocommerce_view_order', 'osborne_display_order_data', 20 );

function osborne_display_order_data( $order_id ){  
    $order = wc_get_order( $order_id ); ?>
    <h2><?php _e( 'Event Details' ); ?></h2>
    <table class="shop_table shop_table_responsive additional_info">
        <tbody>
            <tr>
                <th><?php _e( 'Date:' ); ?></th>
                <td><?php echo $order->get_meta( '_event_date' ); ?></td>
            </tr>
            <tr>
                <th><?php _e( 'Time:' ); ?></th>
                <td><?php echo $order->get_meta( '_event_time' ); ?></td>
			</tr>
			<!-- <tr>
                <th><?php // _e( 'Address:' ); ?></th>
                <td><?php // echo $order->get_meta( '_event_address' ); ?></td>
            </tr> -->
        </tbody>
    </table>
<?php }

// display the extra data in the order admin panel
add_action( 'woocommerce_admin_order_data_after_order_details', 'osborne_display_order_data_in_admin' );

function osborne_display_order_data_in_admin( $order ){  ?>
    <div class="order_data_column">

        <h4><?php _e( 'Event Details', 'woocommerce' ); ?><a href="#" class="edit_address"><?php _e( 'Edit', 'woocommerce' ); ?></a></h4>
        <div class="event-details">
        <?php 
            echo '<p><strong>' . __( 'Date' ) . ':</strong>' . $order->get_meta( '_event_date' ) . '</p>';
			echo '<p><strong>' . __( 'Time' ) . ':</strong>' . $order->get_meta( '_event_time' ) . '</p>';
			//echo '<p><strong>' . __( 'Address' ) . ':</strong>' . $order->get_meta( '_event_address' ) . '</p>'; ?>
        </div>
        <div class="edit_address">
            <?php woocommerce_wp_text_input( array( 'id' => '_event_date', 'label' => __( 'Event Date' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
			<?php woocommerce_wp_text_input( array( 'id' => '_event_time', 'label' => __( 'Event Time' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
			<?php // woocommerce_wp_text_input( array( 'id' => '_event_address', 'label' => __( 'Event Address' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
    </div>
<?php }

add_action( 'woocommerce_process_shop_order_meta', 'osborne_save_extra_details', 45, 2 );

function osborne_save_extra_details( $order_id, $post ){
    $order = wc_get_order( $order_id );
    $order->update_meta_data( '_event_date', wc_clean( $_POST[ '_event_date' ] ) );
    $order->update_meta_data( '_event_time', wc_clean( $_POST[ '_event_time' ] ) );
    // $order->update_meta_data( '_event_address', wc_clean( $_POST[ '_event_address' ] ) );
    $order->save_meta_data();
}

// WooCommerce 3.0+
add_filter( 'woocommerce_email_order_meta_fields', 'osborne_email_order_meta_fields', 10, 3 );

function osborne_email_order_meta_fields( $fields, $sent_to_admin, $order ) {
    $fields['event_date_new'] = array(
		'label' => __( 'Event Date' ),
		'value' => $order->get_meta( '_event_date' ),
	);
	$fields['event_time_new'] = array(
		'label' => __( 'Event Time' ),
		'value' => $order->get_meta( '_event_time' ),
	);
    // $fields['event_address'] = array(
	// 	'label' => __( 'Event Address' ),
	// 	'value' => $order->get_meta( '_event_address' ),
	// );

    return $fields;
}

?>