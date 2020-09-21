<?php
/*
Plugin Name: print Products
Author: mahdi
Version: 1.0.0
Description:print product with filter

*/
if (!defined('ABSPATH')) {
    die;
}
if (file_exists(dirname(__FILE__).'/vendor/autoload.php')){
    require_once dirname(__FILE__) .'/vendor/autoload.php';

}
 use Inc\Deactivate;
 use Inc\Init;
 use Inc\Base\activate;
 define('PLUGIN_PATH',plugin_dir_path(__FILE__));
 define('PLUGIN_URL_PATH',plugin_dir_url(__FILE__));

 if (class_exists('Inc\\init')){
     Inc\Init::register_services();
  }
 class MyPlugin
{

    public $baseName;

    public function __construct()
    {
        $this->baseName = plugin_basename(__FILE__);

    }

    public function register()
    {
        //  add setting to plugin where activate
        add_filter('plugin_action_links_' . $this->baseName, array($this, 'setting_link'));

    }


    public function setting_link($link)
    {
        $settings_link = '<a href="admin.php?page=print_products" >پرینت محصولات</a>';
        array_push($link, $settings_link);
        return $link;
    }

    public function activate()
    {
        activate::activate();
    }


    public static function uninstall()
    {
        $args = array(
            'numberposts' => -1,
            'post_type' => 'book'
        );
        $books = get_posts($args);
        if ($books) {
            foreach ($books as $book) {
                wp_delete_post($book->ID, true);
            }
        }

    }

}

if (class_exists('MyPlugin')){
    $myPlugin = new MyPlugin();
    $myPlugin->register();
}
// activation
register_activation_hook(__FILE__,array($myPlugin,'activate'));
//deactivation
register_deactivation_hook( __FILE__, array($myPlugin,'deactivate') );
if (!defined('WP_UNINSTALL_PLUGIN')){
    register_uninstall_hook( __FILE__, 'MyPlugin::uninstall' );

}

//uninstall