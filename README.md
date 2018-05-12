# cart-dropdown-webaddict
A simple WordPress plugin for WooCommerce to show cart items as dropdown.

//add filter to change cart dropdown text

function change_text($text) {
	$text = 'BAG';
	return $text;
}
add_filter('WH_Filter_Text','change_text');

//add filter to change cart dropdown text


function change_icon($icon) {
	$text = '<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
	return $text;
}
add_filter('WH_Filter_Icon','change_icon');
