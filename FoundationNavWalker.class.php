<?php

/**
 * FoundationNavWalker by rickbutterfield
 * https://github.com/rickbutterfield/FoundationNavWalker
 */

class FoundationNavWalker extends Walker_Nav_Menu {

  //Start the menu rendering by indenting
  public function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat( "\t", $depth);
    $output .= "\n$indent\n";
  }

  //Loop for each individual element
  public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $indent = ( $depth ) ? str_repeat( "\t", $depth) : '';

    //Get classes
    $class_names = $value = '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;
    $classes[] = ($item->current) ? 'active' : '';

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    //Get id
    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    //attributes to menu item's <a>
    $atts = array();
    $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
    $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
    $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
    $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

    /**
     * Filter the HTML attributes applied to a menu item's <a>.
     *
     * @since 3.6.0
     *
     * @param array $atts {
     *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
     *
     *     @type string $title  The title attribute.
     *     @type string $target The target attribute.
     *     @type string $rel    The rel attribute.
     *     @type string $href   The href attribute.
     * }
     * @param object $item The current menu item.
     * @param array  $args An array of arguments. @see wp_nav_menu()
     */
    $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

    $attributes = '';
    foreach ( $atts as $attr => $value ) {
      if ( ! empty( $value ) ) {
        $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
        $attributes .= ' ' . $attr . '="' . $value . '"';
      }
    }



    if ( $depth === 0 ) {
      $output .= '<li' . $id . $value . $class_names . '><label>' . esc_attr( $item->title ) . '</label></li>';
    }

    if ( $depth === 1) {
      $output .= '<li' . $id . $value . $class_names .'>';

      if (!empty($item->url)) {
        $output .= $args->before;
        $output .= '<a'. $attributes .'>';
        /** This filter is documented in wp-includes/post-template.php */
        $output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $output .= '</a>';
        $output .= $args->after;
      }

    }
  }

  //End the menu rendering by indenting
  public function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat( "\t", $depth);
    $output .= "\n$indent\n";
  }
  
  //End li only if child level
  public function end_el( &$output, $item, $depth = 0, $args = array() ) {
    if ( $depth === 1) {
      $output .= "</li>\n";
    }
  }
}

?>
