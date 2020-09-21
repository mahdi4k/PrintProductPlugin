<?php

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\ManagerCallbacks;
use Inc\Base\BaseController;

class Admin extends BaseController
{

    public $setting;
    public $subpage;
    public $callback;
    public $callback_mngr;



    public function register()
    {
        $this->callback = new AdminCallbacks();
        $this->setting = new SettingsApi();
        $this->callback_mngr = new ManagerCallbacks();

        $this->setSettings();
        $this->setSections();
        $this->setFields();
        $pages = [
            [
                'page_title' => 'پرینت محصولات ',
                'menu_title' => 'پریتت محصولات',
                'capability' => 'manage_options',
                'menu_slug' => 'print_products',
                'callback' => array($this->callback, 'adminPrintPage'),
                'icon_url' => 'dashicons-store',
                'position' => 110
            ]
        ];

        $this->setting->AddPages($pages)->withSubPage()->register();

    }


    public function setSettings()
    {

        $args = array(
            array(
                'option_group' => 'plugin_setting',
                'option_name' => 'print_products',
                'callback' => array( $this->callback_mngr, 'checkboxSanitize' )
            )

        );

        //var_dump($args);
        $this->setting->admin_setting($args);
    }

    public function setSections()
    {
        $args = [
            [
                'id' => 'option_group',
                'title' => 'Settings Managerr',
                'callback' => array($this->callback_mngr, 'AdminSection'),
                'page' => 'print_products'
            ]
        ];
        $this->setting->admin_settings_section($args);
    }

    public function setFields()
    {
        $args = array();

        foreach ( $this->managers as $key => $value ) {
            $args[] = [

                    'id' => $key,
                    'title' => $value,
                    'callback' => array( $this->callback_mngr, 'checkboxField' ),
                    'page' => 'print_products',
                    'section' => 'option_group',
                    'args' => array(
                        'option_name' => 'print_products',
                        'label_for' => $key,
                        'class' => 'ui-toggle'
                    )

            ];
        }



        $this->setting->admin_settings_field($args);
    }
}