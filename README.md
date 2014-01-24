#Foundation nav walker for WordPress

This is a simple extension of WordPress' built in `wp_nav_menu` to give support for [Foundation 5's offscreen nav](http://foundation.zurb.com/docs/components/offcanvas.html)

##Installation
Copy the full contents of the file into your functions.php file, or copy the file to your theme directory and call it from `functions.php` with `require get_template_directory() . '/FoundationNavWalker.class.php';`

##Normal usage within a theme
```php
<?php
	$defaults = array(
		'container'   => false,
		'menu_class'  => 'off-canvas-list',
		'walker'      => new Foundation_Off_Canvas_Menu()
	);

	wp_nav_menu( $defaults );
?>
```