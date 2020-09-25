<?php

namespace OS\Includes\Classes;

class Enqueue_Files {
    public function __construct() {
        add_action("wp_enqueue_scripts", [$this, 'enqueue_files']);
    }
    public function enqueue_files() {
        /* Google Font */
        wp_enqueue_style('OS_fonts', '//fonts.googleapis.com/css2?family=Cookie&display=swap', [], OS_Version, 'all');
        wp_enqueue_style('OS_montserrat', '//fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap', [], OS_Version, 'all');

        /*  Css Styles */
        wp_enqueue_style('OS_bootstrap', get_template_directory_uri() .  '/Asset/Css/bootstrap.min.css', [], OS_Version, 'all');
        wp_enqueue_style('OS_fontawesome', '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', [], OS_Version, 'all');
        wp_enqueue_style('OS_elegant_icons', get_template_directory_uri() .  '/Asset/Css/elegant-icons.css', [], OS_Version, 'all');
        wp_enqueue_style('OS_jquery_ui', get_template_directory_uri() .  '/Asset/Css/jquery-ui.min.css', [], OS_Version, 'all');
        wp_enqueue_style('OS_magnific_popup', get_template_directory_uri() .  '/Asset/Css/magnific-popup.css', [], OS_Version, 'all');
        wp_enqueue_style('OS_owl_carosoul', get_template_directory_uri() .  '/Asset/Css/owl.carousel.min.css', [], OS_Version, 'all');
        wp_enqueue_style('OS_slick_nav', get_template_directory_uri() .  '/Asset/Css/slicknav.min.css', [], OS_Version, 'all');
        wp_enqueue_style('OS_css', get_template_directory_uri() .  '/Asset/Css/style.css', [], '' . microtime() . '', 'all');

        /* Theme Javascript */
        // wp_enqueue_script('OS_jquery', '//code.jquery.com/jquery-3.5.1.min.js', [], OS_Version, true);
        wp_enqueue_script('jquery');
        wp_deregister_script('wc-add-to-cart');
        wp_dequeue_script('wc-add-to-cart');
        wp_enqueue_script('comment-reply');
        wp_enqueue_script('OS_bootstrap', get_template_directory_uri() .  '/Asset/Scripts/bootstrap.min.js', [], OS_Version, true);
        wp_enqueue_script('OS_magnific_popup', get_template_directory_uri() .  '/Asset/Scripts/jquery.magnific-popup.min.js', [], OS_Version, true);
        wp_enqueue_script('OS_jquery_ui', get_template_directory_uri() .  '/Asset/Scripts/jquery-ui.min.js', [], OS_Version, true);
        wp_enqueue_script('OS_mixitup', get_template_directory_uri() .  '/Asset/Scripts/mixitup.min.js', [], OS_Version, true);
        wp_enqueue_script('OS_countdown', get_template_directory_uri() .  '/Asset/Scripts/jquery.countdown.min.js', [], OS_Version, true);
        wp_enqueue_script('OS_slicknav', get_template_directory_uri() .  '/Asset/Scripts/jquery.slicknav.js', [], OS_Version, true);
        wp_enqueue_script('OS_owl_carosoul', get_template_directory_uri() .  '/Asset/Scripts/owl.carousel.min.js', [], OS_Version, true);
        wp_enqueue_script('OS_niceScroll', get_template_directory_uri() .  '/Asset/Scripts/jquery.nicescroll.min.js', [], OS_Version, true);
        wp_enqueue_script('OS_js', get_template_directory_uri() .  '/Asset/Scripts/main.js', [], OS_Version, true);
        wp_enqueue_script('wc-add-to-cart', get_template_directory_uri() .  '/Asset/Scripts/woocommerce-ajax.js', ['jquery', 'jquery-blockui'], OS_Version, true);
    }
}
