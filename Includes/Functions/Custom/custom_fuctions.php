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
}
global $os_functions;
$os_functions = new Custom_Functions;
