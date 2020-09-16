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
        /* Removing wc sidebar */
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
        /* Removing wc result count */
        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
        /* Removing wc catalog_ordering */
        remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
        /* Removing wc starting container tag*/
        remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
        /* Removing wc ending container tag*/
        remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
        /* Removing wc product title so that I can modify the title by action hook */
        remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
        /* Removing wc price */
        remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    }
    public static function modify_filter_hooks() {
        add_filter('woocommerce_show_page_title', [get_called_class(), 'woocommerce_show_page_title']);
        add_filter('woocommerce_breadcrumb_defaults', [get_called_class(), 'woocommerce_breadcumb']);
        add_filter('loop_shop_per_page', [get_called_class(), 'products_per_page'], 20);
    }
    public static function modify_action_hooks() {
        add_action('woocommerce_shop_loop_item_title', [get_called_class(), 'woocommerce_template_loop_product_title'], 10);
    }
    public static function woocommerce_template_loop_product_title() {
        echo '<h6 class="' . esc_attr(apply_filters('woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title')) . '"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h6>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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
    public static function products_per_page($products) {
        $products = 9;
        return $products;
    }
}
