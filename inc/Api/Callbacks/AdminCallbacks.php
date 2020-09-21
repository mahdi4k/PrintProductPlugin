<?php

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{

    public function adminPrintPage()
    {

       /* require_once ("$this->plugin_path/templates/admin.php");*/
       require_once ("$this->plugin_path/templates/tabPage.php");

    }

    public function adminCpt()
    {
        return require_once( "$this->plugin_path/templates/cpt.php" );
    }

    /*public function OptionsGroup($input)
    {
        return $input;
    }

    public function AdminSection()
    {
        echo 'Check this beautiful section';
    }*/

    public function textExample()
    {
        $value = esc_attr(get_option('text_example'));
        echo '<input type="text" class="regular-text" name="text_example" value="'.$value.'" placeholder="" >';
    }
    public function adminTaxonomy()
    {
        echo '<input type="text" class="regular-text" name="text_example"   placeholder="" >';
    }
}