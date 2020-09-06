<?php
namespace OS\Includes\Classes;

class Theme_Support {
    public function __construct() {
        add_filter('clean_url', [$this, 'defer_parsing_of_js'], 11, 1);
    }
     public function defer_parsing_of_js($url) {
        if (FALSE === strpos($url, '.js')) return $url;
        return "$url' defer ";
    }
}
