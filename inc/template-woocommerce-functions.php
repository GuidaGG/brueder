<?php
/**
 * Theme Woocommerce Functions
 *
 * @package Die_Brueder_Shop
 */

/* SHOP */




add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/**
 * Removes breadcrumbs from main shop page
 *
 */

add_action( 'init', 'die_brueder_custom_woocommerce_hooks');

if (!function_exists('die_brueder_custom_woocommerce_hooks')) {
	
	function die_brueder_custom_woocommerce_hooks() {
		
	    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
	    
	    //remove sales from top
	    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash' );
	    	
	    //remove meta data, excert and data tabs from single product page
	    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
	    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
	    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
	    remove_action( 'woocommerce_after_single_product_summary', 	'woocommerce_output_product_data_tabs');
	    
	
		
		//add product description to single product page after price
		add_action('woocommerce_single_product_summary', 'die_brueder_product_content', 10);
		add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 15 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
		//remove product title from related products
        remove_action( 'woocommerce_after_shop_loop_item_title',    'woocommerce_template_loop_rating', 5);
        remove_action( 'woocommerce_before_shop_loop_item_title',   'woocommerce_show_product_loop_sale_flash', 10);

        //remove add to cart button from related products
        remove_action( 'woocommerce_after_shop_loop_item',  'woocommerce_template_loop_add_to_cart', 10);

        if(!wp_is_mobile()):
    		 remove_action( 'woocommerce_shop_loop_item_title', 	'woocommerce_template_loop_product_title', 10);
    		//remove rating and price from related products
    	
    		remove_action( 'woocommerce_after_shop_loop_item_title', 	'woocommerce_template_loop_price', 10);
  
    		//remove default thumbnail from related products
    		remove_action( 'woocommerce_before_shop_loop_item_title', 	'woocommerce_show_product_loop_sale_flash', 10);

		endif;


        /*remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
         remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);*/
           		
	}

}

/**
 *
 * Add excerpt to product loops.
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/

if (!function_exists('die_brueder_add_excerpt_product')) {
   
    function die_brueder_add_excerpt_product() {
        
        the_excerpt();
        
    }
}
if(wp_is_mobile()):
    add_action( 'woocommerce_after_shop_loop_item_title', 'die_brueder_add_excerpt_product', 40 );
endif;

 function woocommerce_output_related_products() {

   return '';
  }

add_filter( 'wc_product_enable_dimensions_display', '__return_false' );


add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
    unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
    unset( $enqueue_styles['woocommerce-smallscreen'] );    
     wp_dequeue_style( 'select2' );
    wp_deregister_style( 'select2' );

    return $enqueue_styles;
}
/**
 *
 * Removes the "shop" title on the main shop page
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/

add_filter( 'woocommerce_show_page_title' , 'die_brueder_hide_page_title' );

if (!function_exists('die_brueder_hide_page_title')) {
	
	function die_brueder_hide_page_title() {
		
		return false;
		
	}
}


add_filter( 'loop_shop_per_page', function ( $cols ) {
    return - 1;
} );

/**
 * 
 *
 * Changes number of columns on the main shop page
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/

add_filter('loop_shop_columns', 'die_brueder_loop_columns');

if (!function_exists('die_brueder_loop_columns')) {
	
	function die_brueder_loop_columns() {
		return 3; // 3 products per row
	}
	
}


/* Single Products */

/**
 * 
 *
 * Add attributes to product page
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/


if (!function_exists('die_brueder_product_custom_atributes')) {
	
	function die_brueder_product_custom_atributes() {
		global $product;
		echo $product->list_attributes();
	}
	
}

add_action('woocommerce_single_product_summary', 'die_brueder_product_custom_atributes', 5);

/**
 * 
 *
 * Add VAT info after price
 * @access      public
 * @since       1.0 
 * @return      void
*/


add_filter( 'woocommerce_get_price_html', 'die_brueder_custom_price_message' );
if (!function_exists('die_brueder_custom_price_message')) {
	
	function die_brueder_custom_price_message( $price ) {
		$vat = '<span class="price-vat-info">incl. X% Vat, excl. shipping</span>';
		return $price . $vat;
	}
}

/**
 * 
 *
 * Add number title before input box
 * @access      public
 * @since       1.0 
 * @return      void
*/

if (!function_exists('die_brueder_title_before_quantity')) {

	function die_brueder_title_before_quantity() {
		$title = '<span class="quantity-sintle-product-before">Quantity:</span>';
		echo $title;
	}

}

add_action('woocommerce_before_add_to_cart_button', 'die_brueder_title_before_quantity');

/**
 * 
 *
 * Add arros after input quantity
 * @access      public
 * @since       1.0 
 * @return      void
*/

if (!function_exists('die_brueder_title_after_quantity')) {

	function die_brueder_title_after_quantity() {
		$arrows= '<span class="product-amount-costum">1</span><span class="quantity-sintle-product-minus arrow">&#8595;</span><span class="quantity-sintle-product-plus arrow">&#8593;</span>';
		echo $arrows;
	}

}

add_action('woocommerce_after_add_to_cart_quantity', 'die_brueder_title_after_quantity');


/**
 * 
 *
 * Show main description on product page
 * @access      public
 * @since       1.0 
 * @return      void
*/

if (!function_exists('die_brueder_product_content')) {

	function die_brueder_product_content() {
		if(get_field('p_website')){
		?>
		<div class="product-website">
			<?php the_field('p_website'); ?>
		</div
		<?php
		}
		?>
		<div class="product-main-content">
		<?php 
		echo the_content();
		?>
		</div>
	<?php
	}
}

// Related Products

/**
 * 
 *
 * Add custom thumbnail to related producsts
 * @access      public
 * @since       1.0 
 * @return      void
*/


 if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
	function woocommerce_template_loop_product_thumbnail() { ?>

		
		<?php 
        if(!wp_is_mobile()):
        ?>
        <a href="<?php echo get_permalink()?>">
        <div class="product-custom-thumbnail">
        <?php   
		$custom_thumb = get_post_meta(get_the_ID(), 'custom-thumbnail', true);

        $src =  wp_get_attachment_image_src($custom_thumb);
        $name = explode(".png", $src[0]);
        $t= $name[0].'--t.png';
   
		echo '<img src="'.$t.'" data-src="'.$src[0].'"/>'; 
        ?>
        </div>
        </a>
        <?php
        else:
            echo woocommerce_get_product_thumbnail();
            endif;
		
	} 
 }
//add to blog posts page
add_action('die_brueder_blog_page_thumbnails', 'woocommerce_template_loop_product_thumbnail' );





/**
 * 
 *
 * Remove sidebar from product single pages
 * @access      public
 * @since       1.0 
 * @return      void
*/



if ( ! function_exists( 'die_brueder_remove_sidebar_product_pages' ) ) { 
	function die_brueder_remove_sidebar_product_pages() {
		if (is_product()) {
		remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);
		}
	}
}

add_action( 'wp', 'die_brueder_remove_sidebar_product_pages' );




/* Taxes on prices */

/**
 * Function to add tax after each item price
 *
 * @since 1.0.0
 */


function die_brueder_woocommerce_cart_item_price( $wc, $cart_item, $cart_item_key ) { 
	$_tax = new WC_Tax();
	$rates = array_shift($_tax->get_rates( $class));
			
	$_product = wc_get_product( $cart_item ['product_id']);
	$product_tax_class = $_product->get_tax_class();
    $tax = array_shift( $_tax->get_rates($product_tax_class));
    
    $tax_price = round($_product->get_price() - $_product->get_price_excluding_tax(), 2);
	//$wc .= 	;
	$wc .= '<small class="includes-tax">Incl. '.$tax['label'].' ( '.$tax_price.'€ )</small>';
    return $wc; 
}; 
         
// add the filter 
add_filter( 'woocommerce_cart_item_price', 'die_brueder_woocommerce_cart_item_price', 10, 3 ); 


/**
 * Function to add tax after each item subtotal price
 *
 * @since 1.0.0
 */


function die_brueder_woocommerce_cart_item_price_subtotal( $wc, $cart_item, $cart_item_key ) { 
	$_tax = new WC_Tax();
	$rates = array_shift($_tax->get_rates( $class));
			
	$_product = wc_get_product( $cart_item ['product_id']);
    $tax = array_shift( $_tax->get_rates($product_tax_class));
    

	$wc .= '<small class="includes-tax">Incl. '.$tax['label'].' ( '.round($cart_item[line_subtotal_tax], 2).'€ )</small>';
    return $wc; 
}; 
         
// add the filter 
add_filter( 'woocommerce_cart_item_subtotal', 'die_brueder_woocommerce_cart_item_price_subtotal', 10, 3 );

//add tax label besides price in single product
function die_brueder_woocommerce_shop_item_price_subtotal() { 
	$_tax = new WC_Tax();
	global $product;
	$id = $product->get_id();
	$product_tax_class = $product->get_tax_class();
	$rates = array_shift($_tax->get_rates( 	$product_tax_class ));
        $tax_price = round($product->get_price() - $product->get_price_excluding_tax(), 2);

	echo '<small class="includes-tax">Incl. '.$rates['label'].' ( '.$tax_price.'€ )</small>';
   
}

add_action( 'woocommerce_single_product_summary', 'die_brueder_woocommerce_shop_item_price_subtotal', 25 );

//remove default label
add_filter( 'woocommerce_get_price_html', 'wpa83367_price_html', 100, 2 );
function wpa83367_price_html( $price, $product ){
	return str_replace( '<span class="price-vat-info">incl. X% Vat, excl. shipping</span>', '', $price );

}


/**
 * Get order total html including inc tax if needed.
 *
 * @access public
 */
 
 
 
/** Forms ****************************************************************/

if ( ! function_exists( '
    function die_brueder_woocommerce_form_field' ) ) {

    /**
     * Outputs a checkout/address form field.
     *
     * @subpackage  Forms
     * @param string $key
     * @param mixed $args
     * @param string $value (default: null)
     */
    function die_brueder_woocommerce_form_field( $key, $args, $value = null ) {
        $defaults = array(
            'type'              => 'text',
            'label'             => '',
            'description'       => '',
            'placeholder'       => '',
            'maxlength'         => false,
            'required'          => false,
            'autocomplete'      => false,
            'id'                => $key,
            'class'             => array(),
            'label_class'       => array(),
            'input_class'       => array(),
            'return'            => false,
            'options'           => array(),
            'custom_attributes' => array(),
            'validate'          => array(),
            'default'           => '',
            'autofocus'         => '',
            'priority'          => '',
        );

        $args = wp_parse_args( $args, $defaults );
        $args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );

        if ( $args['required'] ) {
            $args['class'][] = 'validate-required';
            $required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce' ) . '">*</abbr>';
        } else {
            $required = '';
        }

        if ( is_string( $args['label_class'] ) ) {
            $args['label_class'] = array( $args['label_class'] );
        }

        if ( is_null( $value ) ) {
            $value = $args['default'];
        }

        // Custom attribute handling
        $custom_attributes         = array();
        $args['custom_attributes'] = array_filter( (array) $args['custom_attributes'] );

        if ( $args['maxlength'] ) {
            $args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
        }

        if ( ! empty( $args['autocomplete'] ) ) {
            $args['custom_attributes']['autocomplete'] = $args['autocomplete'];
        }

        if ( true === $args['autofocus'] ) {
            $args['custom_attributes']['autofocus'] = 'autofocus';
        }

        if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
            foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
                $custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
            }
        }

        if ( ! empty( $args['validate'] ) ) {
            foreach ( $args['validate'] as $validate ) {
                $args['class'][] = 'validate-' . $validate;
            }
        }

        $field           = '';
        $label_id        = $args['id'];
        $sort            = $args['priority'] ? $args['priority'] : '';
        $field_container = '<p class="form-row %1$s" id="%2$s" data-sort="' . esc_attr( $sort ) . '">%3$s</p>';
        if(empty($args['placeholder'])):
		$args['placeholder'] =$args['label'];
         endif;
        switch ( $args['type'] ) {
            case 'country' :

                $countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

                if ( 1 === sizeof( $countries ) ) {

                    $field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

                    $field .= '<input placeholder="' . esc_attr( $args['label'] ) . '" type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys( $countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" />';

                } else {

                    $field = '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state country_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . '>' . '<option value="">' . esc_html__( 'Select a country&hellip;', 'woocommerce' ) . '</option>';

                    foreach ( $countries as $ckey => $cvalue ) {
                        $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
                    }

                    $field .= '</select>';

                    $field .= '<noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country', 'woocommerce' ) . '" /></noscript>';

                }

                break;
            case 'state' :

                /* Get Country */
                $country_key = 'billing_state' === $key ? 'billing_country' : 'shipping_country';
                $current_cc  = WC()->checkout->get_value( $country_key );
                $states      = WC()->countries->get_states( $current_cc );

                if ( is_array( $states ) && empty( $states ) ) {

                    $field_container = '<p class="form-row %1$s" id="%2$s" style="display: none">%3$s</p>';

                    $field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" />';

                } elseif ( is_array( $states ) ) {

                    $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
                        <option value="">' . esc_html__( 'Select a state&hellip;', 'woocommerce' ) . '</option>';

                    foreach ( $states as $ckey => $cvalue ) {
                        $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
                    }

                    $field .= '</select>';

                } else {

                    $field .= '<input  placeholder="' . esc_attr( $args['placeholder'] ) . '" type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

                }

                break;
            case 'textarea' :

                $field .= '<textarea  placeholder="' . esc_attr( $args['label'] ) . '" name="' . esc_attr( $key ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $value ) . '</textarea>';

                break;
            case 'checkbox' :

                $field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) . '" ' . implode( ' ', $custom_attributes ) . '>
                        <input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="1" ' . checked( $value, 1, false ) . ' /> '
                         . $args['label'] . $required . '</label>';

                break;
            case 'password' :
            case 'text' :
            case 'email' :
            case 'tel' :
            case 'number' :

                $field .= '<input  placeholder="' . esc_attr( $args['placeholder'] ) . '" type="' . esc_attr( $args['type'] ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

                break;
            case 'select' :

                $options = $field = '';

                if ( ! empty( $args['options'] ) ) {
                    foreach ( $args['options'] as $option_key => $option_text ) {
                        if ( '' === $option_key ) {
                            // If we have a blank option, select2 needs a placeholder
                            if ( empty( $args['placeholder'] ) ) {
                                $args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'woocommerce' );
                            }
                            $custom_attributes[] = 'data-allow_clear="true"';
                        }
                        $options .= '<option value="' . esc_attr( $option_key ) . '" ' . selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) . '</option>';
                    }

                    $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
                            ' . $options . '
                        </select>';
                }

                break;
            case 'radio' :

                $label_id = current( array_keys( $args['options'] ) );

                if ( ! empty( $args['options'] ) ) {
                    foreach ( $args['options'] as $option_key => $option_text ) {
                        $field .= '<input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' />';
                        $field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) . '">' . $option_text . '</label>';
                    }
                }

                break;
        }

        if ( ! empty( $field ) ) {
            $field_html = '';

            if ( $args['label'] && 'checkbox' != $args['type'] ) {
            
              // $field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . '">' . $args['label'] . $required . '</label>';
            }

            $field_html .= $field;

            if ( $args['description'] ) {
                $field_html .= '<span class="description">' . esc_html( $args['description'] ) . '</span>';
            }

            $container_class = esc_attr( implode( ' ', $args['class'] ) );
            $container_id    = esc_attr( $args['id'] ) . '_field';
            $field           = sprintf( $field_container, $container_class, $container_id, $field_html );
        }

        $field = apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );

        if ( $args['return'] ) {
            return $field;
        } else {
            echo $field;
        }
    }
}

add_filter("woocommerce_checkout_fields", "die_brueder_order_fields");

function die_brueder_order_fields($fields) {

    $order = array(
        'billing_first_name',
        'billing_last_name',
        'billing_company',
        'billing_country',
        'billing_address_1',
        'billing_address_2',
        'billing_city',
        'billing_postcode',
        'billing_state',
        'billing_email',
        'billing_phone' 
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }

    $fields["billing"] = $ordered_fields;
    return $fields;

}

/* add bigger delivery time to the  checkout*/


    function die_brueder_checkout_delivery(){
        $longerdelivery = 0;
        foreach ( WC()->cart->get_cart() as $cart_item ):
        $item = $cart_item['data'];
            if(!empty($item)):
                $product = new WC_product($item->id);
                $deliverytime =  filter_var(wc_gzd_get_gzd_product( $product )->get_delivery_time_html(), FILTER_SANITIZE_NUMBER_INT);
                if($longerdelivery<= $deliverytime):
                    $longerdelivery  = $deliverytime;
                endif;
            endif;
        endforeach;
        if($longerdelivery > 0):
        echo '<p class="delivery-time-info">Delivery time: '.$longerdelivery.' days</p>';
        endif;
    }

    add_action('woocommerce_after_shipping_rate', 'die_brueder_checkout_delivery');



    /**
 * Filter payment gatways
 */
function die_brueder_available_payment_gateways( $gateways ) {
    if( ! $woocommerce || !isset($woocommerce->cart) )
     return $gateways;
    $chosen_shipping_rates = WC()->session->get( 'chosen_shipping_methods' );
    $allow = 0;
     foreach ( WC()->cart->get_cart() as $cart_item ):
        $item = $cart_item['data'];
        $field = get_post_meta($item->id,'allow_bank_transfer');

        if($field[0] == 1):
            $allow = 1;
            break;
        endif;
         
    endforeach;

    if ( $allow == 0 ) :
        // Remove bank transfer payment gateway
        unset( $gateways['bacs'] );
    endif;
    return $gateways;

}
add_filter( 'woocommerce_available_payment_gateways', 'die_brueder_available_payment_gateways' );