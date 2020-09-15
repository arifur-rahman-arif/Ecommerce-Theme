<?php

namespace OS\Includes\Hooks;

use OS\Includes\Classes\Nav_Walker_Class;

class Custom_Hook {
    public function __construct() {
        add_action('os_nav_menu', [$this, 'nav_menu']);
        add_action('os_product_price', [$this, 'os_product_price'], 10, 1);
        add_action('os_is_product_on_sale', [$this, 'sale_product_check'], 10, 1);
        add_action('os_product_label', [$this, 'product_label'], 10, 1);
    }
    public function product_label($product) {
        if ($product->get_sale_price()) {
            echo __('<div class="label">Sale</div>', 'OS');
        } else {
            $newness_days = 10;
            $created = strtotime($product->get_date_created());
            if ((time() - (60 * 60 * 24 * $newness_days)) < $created) {
                echo  __('<div class="label new">New</div>', 'OS');
            } else {
                echo '';
            }
        }
    }
    public function sale_product_check($product) {
        if ($product->get_sale_price()) {
            echo 'sale';
        } else {
            $newness_days = 10;
            $created = strtotime($product->get_date_created());
            if ((time() - (60 * 60 * 24 * $newness_days)) < $created) {
                echo  esc_html__('New', 'OS');
            } else {
                echo '';
            }
        }
    }
    public function os_product_price($product) {
        if ($product->get_price_html()) {
            if ($product->get_sale_price()) {
                echo '<div class="product__price">' . get_woocommerce_currency_symbol() . ' ' . $product->get_sale_price()  . ' <span>' . get_woocommerce_currency_symbol() . ' ' . $product->get_regular_price() . '</span></div>';
            } else {
                echo '<div class="product__price">' . get_woocommerce_currency_symbol() . ' ' .  $product->get_price() . '</div>';
            }
        }
    }
    public function nav_menu() {
        $arg = [
            'menu' => 'Header Menu',
            'theme_location' => 'header_menu',
            'container_class' => 'container-fluid',
            'items_wrap' =>  $this->menu_items(),
            'walker' => new Nav_Walker_Class()
        ];
        wp_nav_menu($arg);
    }
    public function menu_items() {
        $items = '
            <div class="row">
                    <div class="col-xl-3 col-lg-2">
                        <div class="header__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-7">
                        <nav class="header__menu">
                            <ul>
                                %3$s
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3">
                            <div class="header__right">
                                <div class="header__right__auth">
                                    <a href="#">Login</a>
                                    <a href="#">Register</a>
                                </div>
                                <ul class="header__right__widget">
                                    <li><span class="icon_search search-switch"></span></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span>
                                            <div class="tip">2</div>
                                        </a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span>
                                            <div class="tip">2</div>
                                        </a></li>
                                </ul>
                            </div>
                    </div>
                    <div class="canvas__open">
                        <i class="fa fa-bars"></i>
                    </div>
            </div>';

        return $items;
    }
}
