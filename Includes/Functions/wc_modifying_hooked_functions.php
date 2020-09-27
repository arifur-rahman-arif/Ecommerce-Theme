<?php

namespace OS\Includes\Functions;

class WC_Modifying_Hooked_Functions {

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
