<?php

namespace OS\Includes\Hooks\Woocommerce;

use OS\Includes\Functions\WC_Modifying_Hooked_Functions;

class Woocommerce_Modifiying_Hooks extends WC_Modifying_Hooked_Functions {
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
        add_filter('woocommerce_show_page_title', [__CLASS__, 'woocommerce_show_page_title']);
        add_filter('woocommerce_breadcrumb_defaults', [__CLASS__, 'woocommerce_breadcumb']);
        add_filter('loop_shop_per_page', [__CLASS__, 'products_per_page'], 20);
    }
    public static function modify_action_hooks() {
        add_action('woocommerce_shop_loop_item_title', [__CLASS__, 'woocommerce_template_loop_product_title'], 10);
    }
}
