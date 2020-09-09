<?php

namespace OS\Includes\Classes;

class Nav_Menu {
    private static $parent_item_db_id;
    public function __construct() {
        add_action('after_setup_theme', [$this, 'setting_menu_to_nav_structure'], 12);
    }
    public static function menu_pages() {
        $menus = [
            [
                'title' => get_page_by_title('Home') ? 'Home' : false,
                'url' => home_url('/'),
                'is_parent_menu' => false,
            ],
            [
                'title' => get_page_by_title('Shop') ? 'Shop' : false,
                'url' => home_url('/'),
                'is_parent_menu' => false
            ],
            [
                'title' => get_page_by_title('Blog') ? 'Blog' : false,
                'url' => home_url('/'),
                'is_parent_menu' => false
            ],
            [
                'title' => get_page_by_title('Account') ? 'Account' : false,
                'url' => home_url('/'),
                'is_parent_menu' => true
            ],
            [
                'title' => get_page_by_title('My Account') ? 'My Account' : false,
                'url' => home_url('/'),
                'is_parent_menu' => false
            ],
            [
                'title' => get_page_by_title('Cart') ? 'Cart' : false,
                'url' => home_url('/'),
                'is_parent_menu' => false
            ],
            [
                'title' => get_page_by_title('Login') ? 'Login' : false,
                'url' => home_url('/'),
                'is_parent_menu' => false
            ],
            [
                'title' => get_page_by_title('Sign Up') ? 'Sign Up' : false,
                'url' => home_url('/'),
                'is_parent_menu' => false
            ],
        ];
        return $menus;
    }
    public  function setting_menu_to_nav_structure() {
        if (!current_theme_supports('menus')) {
            return false;
        }
        if (get_option('template') != 'online-store') {
            return;
        }
        $menu_name = 'Header Menu';
        $menu = wp_get_nav_menu_object($menu_name);
        if ($menu == false) {
            $menu_id = wp_create_nav_menu($menu_name);
            self::creating_menu($menu_id);
        }
    }
    public static function creating_menu($menu_id) {
        if (is_int($menu_id)) {
            $pages = self::menu_pages();
            foreach ($pages as $page) {
                if ($page['title'] == false) {
                    return;
                }
                if ($page['is_parent_menu']) {
                    self::$parent_item_db_id = self::create_nav_menu_item($menu_id, $page);
                }
                if ($page['title'] == 'My Account' || $page['title'] == 'Cart') {
                    self::create_nav_menu_item($menu_id, $page, self::$parent_item_db_id);
                } else {
                    self::create_nav_menu_item($menu_id, $page);
                }
            }
            self::set_menu_location($menu_id);
        }
    }
    public static function set_menu_location($menu_id) {
        $locations = get_theme_mod('nav_menu_locations');
        $locations['header_menu'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
    public static function create_nav_menu_item($menu_id, $page, $parent_id = 0) {
        $db_id = wp_update_nav_menu_item($menu_id, 0, [
            'menu-item-title' =>  __('' . $page['title'] . ''),
            'menu-item-object' => 'page',
            'menu-item-object-id' => get_page_by_title('' . $page['title'] . '')->ID,
            'menu-item-parent-id'   => $parent_id,
            'menu-item-type' => 'post_type',
            'menu-item-url'     => $page['url'],
            'menu-item-status'  => 'publish',
        ]);
        return $db_id;
    }
}
