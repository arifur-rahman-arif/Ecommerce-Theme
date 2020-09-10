<?php

namespace OS\Includes\Classes;

class Nav_Walker_Class extends \Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes   = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        $output .= "<li $class_names>";

        if ($item->url) {
            $output .= '<a href="' . $item->url . '">';
        }
        $output .= $item->title;

        if ($item->url) {
            $output .= '</a>';
        }
    }
}
