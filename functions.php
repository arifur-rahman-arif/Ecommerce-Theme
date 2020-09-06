<?php
if (!defined('ABSPATH')) {
    return;
}
if (!defined('OS_Version')) {
    define('OS_Version', '1.0.0');
}
if (!defined('OS_Base_Path')) {
    define('OS_Base_Path', get_theme_file_path() . '/');
}
class OS_Function {
    public function __construct() {
        $this->include_class();
    }
    public function include_class() {
        require_once OS_Base_Path . 'vendor/autoload.php';
        new \OS\Includes\Classes\Add_Page;
        new \OS\Includes\Classes\Enqueue_Files;
        new \OS\Includes\Classes\Theme_Support;
    }
}
new OS_Function;
