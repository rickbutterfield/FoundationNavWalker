<?php

/**
 * FoundationNavWalker by rickbutterfield
 * https://github.com/rickbutterfield/FoundationNavWalker
 */

class FoundationNavWalker extends Walker_Nav_Menu {

  public function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat( "\t", $depth);
    $output .= "\n$indent<ul class=\"off-canvas-list\">\n";
  }

  public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $indent = ( $depth ) ? str_repeat( "\t", $depth) : '';

    if ( $depth === 0 ) {
      $output .= '<li><label>' . esc_attr( $item->title ) . '</label></li>';
    }

    if ( $depth === 1) {
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

      $output .= $indent . '<li' . $id . $value . $class_names .'>';

      if (!empty($item->url)) {
        $output .= '<a href="' . $item->url . '">' . $item->title . '</a>';
      }

      $output .= '</li>';
    }
  }
}

?>