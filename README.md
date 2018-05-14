### WooCommerce Cart Dropdown
A simple WordPress plugin for WooCommerce to show cart items as dropdown.

### Display cart dropdown
```php
echo do_shortcode('wd-mini-cart');
```

```php
//add filter to change cart dropdown text
function change_text($text) {
	$text = 'BAG';
	return $text;
}
add_filter('WH_Filter_Text','change_text');

//add filter to change cart dropdown text
function change_icon($icon) {
	$icon = '<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
	return $text;
}
add_filter('WH_Filter_Icon','change_icon');
```

### Screenshot
![alt text](https://github.com/sndp-webaddict/cart-dropdown-webaddict/blob/master/screenshot.jpg)
