<?php

namespace OS\Includes\Hooks;

use OS\Includes\Classes\Nav_Walker_Class;
use OS\Includes\Classes\Comment_Walker_Class;

abstract class Hooked_Functions {

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
                echo '<div class="product__price">' . get_woocommerce_currency_symbol() . ' ' . number_format($product->get_sale_price(), 2)  . ' <span>' . get_woocommerce_currency_symbol() . ' ' . number_format($product->get_regular_price(), 2) . '</span></div>';
            } elseif ($product->get_type() == 'variable') {
                // print_r($product->get_variation_prices()['price']);
                echo '<div class="product__price">
                    ' . get_woocommerce_currency_symbol() . ' '
                    . min($product->get_variation_prices()['price']) . ' &#126; '
                    . get_woocommerce_currency_symbol() . ' '
                    . max($product->get_variation_prices()['price']) . '
                    </div>';
            } else {
                echo '<div class="product__price">' . get_woocommerce_currency_symbol() . ' ' .  number_format($product->get_price(), 2) . '</div>';
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
                            <a href="./index.html"><img src="' . get_template_directory_uri() . '/Asset/Images/logo.png' . '" alt=""></a>
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
    public function modify_search_form($form) {
        $form = '';
        $form .= '<form class="search-model-form" action="' . esc_url(home_url('/')) . '">';
        $form .= '<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search here.....">';
        $form .= '</form>';
        return $form;
    }
    public function theme_breadcumb() {
        global $post, $wp_query;
        if (!is_front_page()) {
            if (is_archive()) {
                echo get_the_archive_title();
            }
            if (is_single()) {
                echo get_the_title();
            }
            if (is_search()) {
                echo get_search_query();
            }
            if (is_home()) {
                $page_for_posts_id = get_option('page_for_posts');
                if ($page_for_posts_id) {
                    $post = get_page($page_for_posts_id);
                    setup_postdata($post);
                    echo '<span>' . get_the_title() . '</span>';
                }
            }
        }
    }
    public function post_cat($id) {
        // if(has_category())
        $cat = get_the_category($id);
        if ($cat) {
            foreach ($cat as $catagory) {
                echo '<a href="' . get_category_link($catagory->term_id) . '" class="tip">' . $catagory->name . '</a>' . ' ';
            }
        }
    }
    public function post_tag($id) {
        $tags = get_the_tags($id);
        if ($tags) {
            foreach ($tags as $tag) {
                echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
            }
        }
    }
    public function prev_post_link() {
        $previous = get_previous_post();
        if ($previous) {
            echo '<a href="' . get_permalink($previous) . '"><i class="fa fa-angle-left"></i> Previous posts</a>';
        }
    }
    public function next_post_link() {
        $next = get_next_post();
        if ($next) {
            echo '<a href="' . get_permalink($next) . '">Next posts <i class="fa fa-angle-right"></i></a>';
        }
    }
    public function list_comment() {
        $arg = [
            'format' => 'html5',
            'walker' => new Comment_Walker_Class,
            'style' => 'div',
            'avatar_size' => 90,
            'max_depth' => 3,
        ];
        wp_list_comments($arg);
    }
    public function filter_comment_form_fields($defaults) {
        $defaults['comment_field'] = '<h4 style="margin-bottom: 10px;">Your Comment :</h4>' .
            sprintf(
                '<p class="comment-form-comment">%s</p>',
                '<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea>'
            );
        $defaults['logged_in_as'] = '';
        return $defaults;
    }
    public function modify_archive_title($title) {
        $title = str_replace(':', '  &nbsp;<i class="fa fa-angle-right"></i>', $title);
        $title = '<span>' . $title . '</span>';
        return $title;
    }

    public function available_attribute($product) {
        $attributes = $product->get_attributes();
        if (!$attributes) {
            return;
        }
        foreach ($attributes as $attribute) {
            $terms = wp_get_post_terms($product->get_id(), $attribute->get_name());
            if ($attribute->get_name() == 'pa_color') {
                if (empty($terms)) {
                    return;
                }
                echo '<li>
            			    <span>Available color:</span>
                            <div class="color__checkbox">
                              ' . self::available_color($terms) . '
                            </div>
            		    </li>';
            } elseif ($attribute->get_name() == 'pa_size') {
                if (empty($terms)) {
                    return;
                }
                echo '<li>
            			<span>Available size:</span>
            			<div class="size__btn">
                            ' . self::available_size($terms) . '
            			</div>
            		</li>';
            } else {
                if (empty($terms)) {
                    return;
                }
                echo '<li>
                		<span>Available ' . $attribute->get_name() . ':</span>
                		<div class="size__btn">
                            ' . self::other_attributes($attribute->get_options()) . '
                		</div>
                	</li>';
            }
        }
    }
    public static function available_color($terms) {
        $labels = '';
        foreach ($terms as $term) {
            $labels .= '<label for="' . $term->slug . '">
                            <span style="background-color: ' . $term->slug . ';" class="checkmark"></span>
                        </label>';
        }
        return $labels;
    }
    public static function available_size($terms) {
        $labels = '';
        foreach ($terms as $term) {
            $labels .= '<label for="' . $term->slug . '">
                                                ' . $term->name . '
                                </label>';
        }
        return $labels;
    }
    public static function other_attributes(array $options) {
        $labels = '';
        foreach ($options as $option) {
            $labels .= '<label for="' . $option . '">
                                                ' . $option . '
                                </label>';
        }
        return $labels;
    }
}
