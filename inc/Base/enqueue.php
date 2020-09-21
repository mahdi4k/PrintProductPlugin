<?php
namespace Inc\Base;

class enqueue
{
    public function register()
    {
       add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }
    public function enqueue()
    {
        wp_enqueue_style('bootstrap', plugins_url('PrintProduct/assets/bootstrap.min.css'));
        wp_enqueue_style('mystyle', plugins_url('PrintProduct/assets/mystyle.css'));
        wp_enqueue_style('select2',  'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css');
        wp_enqueue_script('ajax', plugins_url('PrintProduct/assets/app.js'));
        wp_enqueue_script('myscript', plugins_url('PrintProduct/assets/myscript.js'));
        wp_localize_script('ajax', 'wpAjax', array('ajaxUrl' => admin_url('admin-ajax.php')));
    }
}