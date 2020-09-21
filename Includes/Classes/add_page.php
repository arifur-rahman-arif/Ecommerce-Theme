<?php

namespace OS\Includes\Classes;

class Add_Page {
    public function __construct() {
        add_action('after_switch_theme', [$this, 'add_page']);
        add_action('init', [$this, 'set_page_states_filter_hook']);
    }
    public function add_page() {
        self::page_info();
        $home_page_id = get_page_by_title('Home');
        $blog_page_id = get_page_by_title('Blog');
        update_option('page_on_front', $home_page_id->ID);
        update_option('page_for_posts', $blog_page_id->ID);
        update_option('show_on_front', 'page');
    }
    public static function post_arr(string $title, int $page_id) {
        return [
            'ID' => $page_id,
            'post_title' => $title,
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_content' => "",
        ];
    }
    public static function page_info() {
        /* pages that will be created */
        $pages = [
            'Home',
            'Blog',
            'Contact',
            'Account',
            'Login',
            'Sign Up',
        ];
        foreach ($pages as $page) {
            self::create_page($page);
        }
    }
    public static function create_page(string $page) {
        /* if page exists and page status == trash then update the page */
        if (get_page_by_title($page) && get_post_status(get_page_by_title($page)->ID) == 'trash') {
            wp_update_post(self::post_arr($page, get_page_by_title($page)->ID));
        }

        /* if page don't exists then create the page */
        if (get_page_by_title($page) == null) {
            wp_insert_post(self::post_arr($page, 0), true);
        }
    }
    public function set_page_states_filter_hook() {
        add_filter('display_post_states', [$this, 'set_page_states'], 10, 2);
    }
    public function set_page_states($post_states, $post) {
        if (get_page_by_title('Contact')->ID === $post->ID) {
            $post_states[] = __('Contact Page', 'OS');
        }
        if (get_page_by_title('Account')->ID === $post->ID) {
            $post_states[] = __('Account Page', 'OS');
        }
        if (get_page_by_title('Login')->ID === $post->ID) {
            $post_states[] = __('Login Page', 'OS');
        }
        if (get_page_by_title('Sign Up')->ID === $post->ID) {
            $post_states[] = __('Sign Up Page', 'OS');
        }
        return $post_states;
    }
}
