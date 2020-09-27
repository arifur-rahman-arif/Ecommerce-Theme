<?php

namespace OS\Includes\Hooks;

use OS\Includes\Functions\Custom\Custom_Hooked_Functions;

class Custom_Hook extends Custom_Hooked_Functions {
    public function __construct() {
        /* Hook to display nav menu */
        add_action('os_nav_menu', [$this, 'nav_menu']);
        /* Hook to display product price */
        add_action('os_product_price', [$this, 'os_product_price'], 10, 1);
        /* Hook to display Sale text on product-archive page */
        add_action('os_is_product_on_sale', [$this, 'sale_product_check'], 10, 1);
        /* Hook for product label */
        add_action('os_product_label', [$this, 'product_label'], 10, 1);
        /* Modifying search form */
        add_filter('get_search_form', [__CLASS__, 'modify_search_form']);
        /* Breadcumb for online-store theme */
        add_filter('os_breadcumb', [__CLASS__, 'theme_breadcumb']);
        /* Single post catagory */
        add_action('os_post_cat', [__CLASS__, 'post_cat'], 10, 1);
        /* Single post catagory */
        add_action('os_post_tag', [__CLASS__, 'post_tag'], 10, 1);
        /* Single post previous post link btn */
        add_action('os_prev_post_link', [__CLASS__, 'prev_post_link']);
        /* Single post next post link btn */
        add_action('os_next_post_link', [__CLASS__, 'next_post_link']);
        /* Comment listing */
        add_action('os_list_comment', [__CLASS__, 'list_comment']);
        /* Filtering the comment form fields */
        add_filter('comment_form_defaults', [__CLASS__, 'filter_comment_form_fields']);
        /* Modify archive title for breadcumb */
        add_filter('get_the_archive_title', [__CLASS__, 'modify_archive_title']);
        /* Hook for displaying available color for product */
        add_action('os_available_attribute', [__CLASS__, 'available_attribute'], 10, 1);
        /* Hook for displaying front page large item catagory data */
        add_action('os_large_item', [__CLASS__, 'large_item']);
        /* Hook for displaying front page catagory items data */
        add_action('os_catagory_items', [__CLASS__, 'catagory_items']);
        /* Hook for displaying front page catagory items data */
        add_action('os_cat_filter_control', [__CLASS__, 'filter_control_by_cat']);
        /* Hook for displaying front page catagory items data */
        add_action('os_front_page_filtered_product', [__CLASS__, 'filtered_products']);
    }
}
