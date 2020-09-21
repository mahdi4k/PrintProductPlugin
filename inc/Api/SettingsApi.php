<?php

namespace Inc\Api;

use Inc\Base\BaseController;

class SettingsApi extends BaseController
{
    /**
     * @var array
     * create admin page
     */
    public $admin_pages = array();
    /**
     * @var array
     * create admin subpage
     */
    public $admin_subpages = array();

    /**
     * @var array
     * create admin subpage
     */
    public $setting = array();


    private $admin_setting;
    private $admin_settings_field;
    private $admin_settings_section;

    public function register()
    {
        if (!empty($this->admin_pages) ||  !empty($this->admin_subpages)) {
            add_action('admin_menu', array($this, 'addAdminMenu'));
        }
        if ( !empty($this->admin_setting) ) {
            add_action('admin_init', array($this, 'registerCustomField'));
        }
    }

    public function AddPages(array $pages)
    {
        $this->admin_pages = $pages;
        return $this;
    }

    public function withSubPage($title = null)
    {
        if (empty($this->admin_pages)) {
            return $this;
        }
        $admin_page = $this->admin_pages[0];

        /*$subpages = array(
            array(
                'parent_slug' => 'print_products',
                'page_title' => 'پرینتتتت محصولات',
                'menu_title' => 'پرینتتتت محصولات',
                'capability' => 'manage_options',
                'menu_slug' => 'print_productss',
                'callback' => array($this,'tabpanle')

            )
        );
        $this->admin_subpages = $subpages;*/

        return $this;
    }

    public function tabpanle()
    {
        require_once ("$this->plugin_path/templates/tabPage.php");
    }
    public function addSubPages(array $pages = null)
    {
        $this->admin_subpages = array_merge($this->admin_subpages, $pages);

        return $this;
    }

    public function addAdminMenu()
    {
        foreach ($this->admin_pages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position']);
        }

        foreach ($this->admin_subpages as $page) {

            add_submenu_page($page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback']);
        }
    }

    public function admin_setting($setting)
    {
        $this->admin_setting = $setting;
        return $this;
    }

    public function admin_settings_section($setting)
    {
        $this->admin_settings_section = $setting;
        return $this;
    }

    public function admin_settings_field($setting)
    {
        $this->admin_settings_field = $setting;
        return $this;
    }

    public function registerCustomField()
    {

        //register setting
        foreach ($this->admin_setting as $setting) {
            register_setting($setting['option_group'], $setting['option_name'], isset($setting['callback']) ? $setting['callback'] : '');
        }

        // add settings section
        foreach ($this->admin_settings_section as $section) {
            add_settings_section($section['id'], $section['title'], isset($setting['callback']) ? $setting['callback'] : '', $section['page']);
        }

        //add settings fields
        foreach ($this->admin_settings_field as $field) {
            add_settings_field($field['id'], $field['title'],
                isset($field['callback']) ? $field['callback'] : '', $field['page'], $field['section']
                 ,isset($field['args']) ? $field['args'] : '');
        }
    }


}