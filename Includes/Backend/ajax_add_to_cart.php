<?php

namespace OS\Includes\Backend;

class Ajax_Add_To_Cart {
    public function __construct() {
        add_action('wp_ajax_os_ajax_cart', [$this, 'add_to_cart_btn']);
        add_action('wp_ajax_no_priv_os_ajax_cart', [$this, 'add_to_cart_btn']);
    }
    public function add_to_cart_btn() {
        $product_id = $_POST['add-to-cart'] ? $_POST['add-to-cart'] : null;
        $product = wc_get_product($product_id);
        $variation = $product->get_variation_attributes();
        var_dump($product_id);
        // $quantity = $_POST['quantity'];
        // $variation_id = $_POST['variation_id'];
        // $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
        // $product_status = get_post_status($product_id);
        // if ($passed_validation && false !== WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

        //     do_action('woocommerce_ajax_added_to_cart', $product_id);

        //     if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
        //         wc_add_to_cart_message(array($product_id => $quantity), true);
        //     }

        //     \WC_AJAX::get_refreshed_fragments();
        // } else {

        //     // If there was an error adding to the cart, redirect to the product page to show any errors.
        //     $data = array(
        //         'error'       => true,
        //         'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id),
        //     );

        //     wp_send_json($data);
        // }
        // wp_die();
    }
}
