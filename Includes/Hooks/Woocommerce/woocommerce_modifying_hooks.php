<?php

namespace OS\Includes\Hooks\Woocommerce;

class Woocommerce_Modifiying_Hooks {
    public function __construct() {
        add_action('init', [$this, 'remove_hooks_and_filters']);
    }
    public function remove_hooks_and_filters() {
        self::remove_action_hooks();
        self::modify_filter_hooks();
        self::modify_action_hooks();
    }
    public static function remove_action_hooks() {
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
        remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
        remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
        remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    }
    public static function modify_filter_hooks() {
        add_filter('woocommerce_show_page_title', [get_called_class(), 'woocommerce_show_page_title']);
        add_filter('woocommerce_breadcrumb_defaults', [get_called_class(), 'woocommerce_breadcumb']);
    }
    public static function modify_action_hooks() {
        add_action('woocommerce_before_main_content', [get_called_class(), 'woocommerce_output_content_wrapper'], 5);
        add_action('woocommerce_after_main_content', [get_called_class(), 'woocommerce_output_content_wrapper_end'], 5);
    }
    public static function woocommerce_output_content_wrapper() {
        echo '
                 ' . woocommerce_breadcrumb() . '
                <section class="shop spad">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9 col-md-9">
                                <div class="row">';
    }
    public static function woocommerce_output_content_wrapper_end() {
        echo '
                </div>
                    </div>
                        </div>
                            </div>
                                </section>';
    }
    public static function woocommerce_show_page_title($val) {
        $val = false;
        return $val;
    }
    public static function woocommerce_breadcumb() {
        return array(
            'delimiter'   => '',
            'wrap_before' => '<div class="breadcrumb-option">
                                                <div class="container"><div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="breadcrumb__links" itemprop="breadcrumb">
                                                            <i class="fa fa-home"></i>',
            'wrap_after'  => '</div></div></div></div></div>',
            'before'      => '',
            'after'       => '',
            'home'        => 'Home',
        );
    }
}
