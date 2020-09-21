<?php


namespace Inc\Base;


class activate
{
    public static function custom_post_type()
    {
        register_post_type('Mybooks', ['public' => true, 'label' => 'Books']);
    }
    public static function activate()
    {
        //self::custom_post_type();
         flush_rewrite_rules();
        $default = array();
        if ( ! get_option( 'print_products' ) ) {
            update_option( 'alecaddd_plugin', $default );
        }


        if ( ! get_option( 'alecaddd_plugin_cpt' ) ) {
            update_option( 'alecaddd_plugin_cpt', $default );
        }

    }

}