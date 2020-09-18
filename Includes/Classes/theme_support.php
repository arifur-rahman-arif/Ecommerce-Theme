<?php

namespace OS\Includes\Classes;

class Theme_Support {
    public function __construct() {
        apply_filters('clean_url', [$this, 'defer_parsing_of_js'], 11, 1);
        add_action('after_setup_theme', [$this, 'theme_init_hooks']);
        add_action('widgets_init', [$this, 'register_sidebars']);
        $this->including_other_func();
    }
    public function defer_parsing_of_js($url) {
        if (false === strpos($url, '.js')) {
            return $url;
        }

        return "$url' defer ";
    }
    public function theme_init_hooks() {
        self::theme_support();
        self::register_menus();
    }

    public static function register_menus() {
        register_nav_menus(array(
            'header_menu' => __('Header Menu'),
            'footer_menu' => __('Footer Menu'),
        ));
    }
    public static function theme_support() {
        add_theme_support('menus');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('custom-background');
        add_theme_support('custom-header');
        add_theme_support('custom-logo');
        add_theme_support('automatic-feed-links');
        add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
    }
    public function register_sidebars() {
        register_sidebar(array(
            'name'          => __('Shop Page Sidebar', 'OS'),
            'id'            => 'shop-sidebar',
            'description'   => __('This is a shop sidebar area. Anything is here will be outputted in shop page sidebar', 'textdomain'),
            'before_widget' => '<div id="%1$s" class="widget %2$s sidebar">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="section-title"><h4 class="widgettitle">',
            'after_title'   => '</h4></div>',
        ));
    }
    public function including_other_func() {
        new \OS\Includes\Classes\Admin_Nav_Menu;
    }
}
