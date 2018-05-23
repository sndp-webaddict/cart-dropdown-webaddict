<?php
/**
 * Plugin Name: Cart Dropdown - Webaddict
 * Author: WebAddict
 * Author URI: http://webaddict.in
 * Version: 1.0.0
 * Description: Use [wd-mini-cart] shortcode to add cart dropdown.
 */


class WHPlugin {
	public function __construct() {
		add_filter('WH_Filter_Text',array($this, 'WH_Text'));
		add_filter('WH_Filter_Icon',array($this, 'WH_Icon'));
		$this->register_shortocde();
		$this->register_scripts();
	}

	/**
	 * Call Fontawesome CDN
	 */

	public function woo_icons() {
		$plugin_url = plugin_dir_url( __FILE__ );
		wp_enqueue_style('WH-css', $plugin_url .'style.css');
	}

	public function register_scripts() {
		add_action('wp_enqueue_scripts',array($this, 'woo_icons'));
	}

	/**
	 * Create Shortcode for Mini Cart
	 * Use fontawesome and Woo functions
	 * @ var string
	 */
	public function mini_cart_bsl() {
			echo '<div class="woo_mini_cart">';
		    echo '<div class="basket-item-count">';
		    	$icon_url = apply_filters('WH_Filter_Icon','<i class="fa fa-shopping-cart" aria-hidden="true"></i>');
		    	echo $icon_url;
		    	$value = apply_filters( 'WH_Filter_Text', 'BAG');
		    	echo $value;
		        echo ' <span class="cart-items-count count">(';
		            echo WC()->cart->get_cart_contents_count();
		        echo ')</span>';
		        echo '<div class="hover_cart_box">';
		        if ( ! WC()->cart->is_empty() ) :
		        echo "<table>";
		        global $woocommerce;
			    $items = $woocommerce->cart->get_cart();
					echo "<tr>";
							echo "<td colspan='2'>";
								echo WC()->cart->get_cart_contents_count() . "Items in bag";
							echo "</td>";
						echo "</tr>";
			        foreach($items as $item => $values) { 
						
			        	echo "<tr>";
			            $_product =  wc_get_product( $values['data']->get_id() );
						
						
			            $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $values['product_id'], $values, $item );
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $values ) : '', $values, $item );
			            //product image
			            $getProductDetail = wc_get_product( $values['product_id'] );
			            echo "<td>";
			            echo "<a href='" . esc_url( $product_permalink ) . "'>" . $getProductDetail->get_image('thumbnail') . "</a>";
			            echo "</td><td>";
			            echo "<b><a href='" . esc_url( $product_permalink ) . "'>".$_product->get_title() .'</b>  <br> Quantity: '.$values['quantity'].'<br></a>'; 
			            echo "Price: " . apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $values, $item );
						$attributes = $_product->get_attributes();
						foreach($attributes as $attr => $val) {
							$key = str_replace('pa_','',$attr);
							$key = str_replace('-',' ',$key);
							echo "<div>" . $key .":" . $val . "</div>";
						}
						echo apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">Ã—</a>', esc_url(WC()->cart->get_remove_url($item)), __('Remove this item', 'evolve')), $item);
						
			            echo "</td>";
			            echo "</tr>";
			        }
			        echo "<tr><td class='btn-center'><a href='". $woocommerce->cart->get_cart_url() . "'>View Cart</a></td><td class='btn-center'><a href='". $woocommerce->cart->get_checkout_url() . "'>Checkout</a></td></tr>";
			    echo "</table>";
			    else :
			    	echo "<h3>Cart is empty</h3>";
			    	endif;
				echo '</div>';
				echo '</div>';
			
	}

	//register shortcode
	public function register_shortocde() {
		add_shortcode( 'wd-mini-cart', array($this, 'mini_cart_bsl') );
	}

	//Create filter for text
	public function WH_Text($text) {
		return $text;
	}

	//Create filter for Icon
	public function WH_Icon($icon) {
		return $icon;
	}


}

$init = new WHPlugin();