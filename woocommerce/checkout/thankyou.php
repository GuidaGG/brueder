<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="woocommerce-order">

	<?php if ( $order ) : ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<h1 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?></h1>

			<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

				<li class="woocommerce-order-overview__order order">
					<?php _e( 'Order number:', 'woocommerce' ); ?>
					<strong><?php echo $order->get_order_number(); ?></strong>
				</li>
				<input type="hidden" value="<?php echo $order->get_billing_email(); ?>" id="order-email" />
			<!--	<li class="woocommerce-order-overview__date date">
					<?php _e( 'Date:', 'woocommerce' ); ?>
					<strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
				</li>

				<li class="woocommerce-order-overview__total total">
					<?php _e( 'Total:', 'woocommerce' ); ?>
					<strong><?php echo $order->get_formatted_order_total(); ?></strong>
				</li>

				<?php if ( $order->get_payment_method_title() ) : ?>

				<li class="woocommerce-order-overview__payment-method method">
					<?php _e( 'Payment method:', 'woocommerce' ); ?>
					<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
				</li>-->

				<?php endif; ?>

			</ul>


		
		<div id="newsletter1">
		<h2><a id="newslettercta1">Subscribe to our Newsletter</a></h2>
		<?php do_action('die_brueder_checkout_newsletter'); ?>
			</div>
		<section class="related related-posts">	
			<h2>Related Content</h2>
			<ul id="isotope">
			<?php 
		 $array_ids = array("first");
		 $notrepeated = true;

		 if ( sizeof( $order->get_items() ) > 0 ) {
            foreach( $order->get_items() as $item ) {

            	global $post; 
				$post = get_post( $item['product_id']);
				$posts = get_field('related-p-custom');
				?>
				
				<?php if( $posts ): ?>
					
					<?php
					foreach( $posts as $post): 
						setup_postdata( $post );
				
							$notrepeated = true;
              			foreach($array_ids as $a):
              		
              				if($post->ID == $a):
       							
              					$notrepeated = false;
				  			
              				endif;

              			endforeach;
              			if($notrepeated == true):
              				array_push($array_ids,$post->ID);
              				?>
							<li>
              				<?php	
				  				if(wp_is_mobile()):
              			
              						if($type == "product"):
			     							wc_get_template_part( 'content', 'product' ); 
			     							else:
			     							wc_get_template_part( 'template-parts/content', 'blogmobile' ); 
			     					endif;
			     				else:
				  						woocommerce_template_loop_product_thumbnail();
				  				endif;
				  				
				  			?>
        					</li>
        					<?php
				  		endif;	
				  	  		
					endforeach;	
					?>
					
				<?php endif; ?>
			
				<?php
				wp_reset_postdata();
            }
         }
         ?>

        </ul>
        </section>
        <?php
         endif; ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

	<?php endif; ?>

</div>
