<?php

namespace OS\Includes\Functions\Custom;

class Custom_Functions {
    public function front_large_item_data() {
        $terms = get_terms('product_cat');
        $attachment_data = [];
        if ($terms) {
            for ($i = 1; $i <= count($terms); $i++) {
                if ($i < 2) {
                    $attachment_data['cat_name'] = $terms[$i]->name;
                    $attachment_data['total_post'] = $terms[$i]->count;
                    $attachment_data['description'] = $terms[$i]->description ? $terms[$i]->description : 'Sitamet, consectetur adipiscing elit, sed do eiusmod tempor incidid-unt labore edolore magna aliquapendisse ultrices gravida.';
                    $attachment_data['image_url'] = wp_get_attachment_url(get_term_meta($terms[$i]->term_id, 'thumbnail_id', true)) ? wp_get_attachment_url(get_term_meta($terms[$i]->term_id, 'thumbnail_id', true)) : get_template_directory_uri() . "/Asset/Images/categories/category-1.jpg";
                    $attachment_data['cat_url'] = get_category_link($terms[$i]->term_id);
                    return $attachment_data;
                } else {
                    break;
                }
            }
        }
    }
    /**
     * @method is going to return a object of terms for product category
     * @param int $total_cat defined how many numbers of category to return
     * @return object $attachment_data
     */
    public function categories__item($total_cat = 6) {

        $terms = get_terms('product_cat');
        $attachment_data = [];
        if ($terms) {
            for ($i = 1; $i <= count($terms); $i++) {
                if ($i > 1 && $i < $total_cat) {
                    array_push(
                        $attachment_data,
                        [
                            'term_id' => $terms[$i]->term_id,
                            'cat_name' => $terms[$i]->name,
                            'cat_slug' => $terms[$i]->slug,
                            'total_post' => $terms[$i]->count,
                            'description' => $terms[$i]->description ? $terms[$i]->description : 'Sitamet, consectetur adipiscing elit, sed do eiusmod tempor incidid-unt labore edolore magna aliquapendisse ultrices gravida.',
                            'image_url' => wp_get_attachment_url(get_term_meta($terms[$i]->term_id, 'thumbnail_id', true)) ? wp_get_attachment_url(get_term_meta($terms[$i]->term_id, 'thumbnail_id', true)) : get_template_directory_uri() . "/Asset/Images/categories/category-" . $i . ".jpg",
                            'cat_url' => get_category_link($terms[$i]->term_id),
                        ]
                    );
                }
            }
        }
        return $attachment_data;
    }
    public function is_product_on_sale($post_id) {
        $is_on_sale = get_post_meta($post_id, '_sale_price', true);
        if ($is_on_sale) {
            return true;
        } else {
            return false;
        }
    }
    public function product_price($post_id) {
        if (get_post_meta($post_id, '_sale_price', true)) {
            return '<div class="product__price">' . get_woocommerce_currency_symbol() . ' ' . number_format(get_post_meta($post_id, '_sale_price', true), 2)  . ' <span>' . get_woocommerce_currency_symbol() . ' ' . number_format(get_post_meta($post_id, '_regular_price', true), 2) . '</span></div>';
        } elseif ($this->product_type($post_id) == 'variable') {
            return '<div class="product__price">
                        ' . get_woocommerce_currency_symbol() . ' '
                . min(get_post_meta($post_id)['_price']) . ' &#126; '
                . get_woocommerce_currency_symbol() . ' '
                . max(get_post_meta($post_id)['_price']) . '
                    </div>';
        } elseif ($this->product_type($post_id) == 'grouped') {
            return '<div class="product__price">' . get_woocommerce_currency_symbol() . ' ' .  number_format(get_post_meta($post_id)['_price'][0], 2) . '</div>';
        } else {
            return '<div class="product__price">' . get_woocommerce_currency_symbol() . ' ' .  number_format(get_post_meta($post_id, '_regular_price', true), 2) . '</div>';
        }
    }
    public function product_type($post_id) {
        if (class_exists('WC_Product_Data_Store_CPT')) {
            $product_class = new \WC_Product_Data_Store_CPT();
            return $product_class->get_product_type($post_id);
        }
    }
}
global $os_functions;
$os_functions = new Custom_Functions;
