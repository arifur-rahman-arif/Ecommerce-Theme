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

        /* Registering all assets files */
        new \OS\Includes\Classes\Enqueue_Files;

        /* Adding page when theme is activated */
        new \OS\Includes\Classes\Add_Page;

        /* Configuring theme support for this theme */
        new \OS\Includes\Classes\Theme_Support;

        /* Configuring theme support for this theme */
        new \OS\Includes\Hooks\Custom_Hook;

        /* Configuring theme support for this theme */
        new \OS\Includes\Hooks\Woocommerce\Woocommerce_Modifiying_Hooks;

        /* OS theme custom functions */
        new \OS\Includes\Functions\Custom\Custom_Functions;
    }
}
new OS_Function;
