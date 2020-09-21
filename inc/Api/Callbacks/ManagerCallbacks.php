<?php

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{

    public function checkboxSanitize($input)
    {
        //return filter_var($input,FILTER_SANITIZE_NUMBER_INT);

        //return (isset($input) ? true : false);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $output = array();

            $output['cpt_manager'] = $input['cpt_manager'];
            $output['taxonomy_manager'] = $input['taxonomy_manager'];
            $output['media_widget'] = $input['media_widget'];
            $output['gallery_manager'] = $input['gallery_manager'];
            $output['testimonial_manager'] = $input['testimonial_manager'];
            $output['templates_manager'] = $input['templates_manager'];
            $output['membership_manager'] = $input['membership_manager'];
            $output['login_manager'] = $input['login_manager'];
            $output['chat_manager'] = $input['chat_manager'];


            return $output;
        }
    }


    public function adminSectionManager()
    {
        echo 'Manage the section and features of this plugin by activating the checkboxes';
    }

    public function checkboxField($args)
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $checkbox = get_option($option_name);
        $checkboxChecked = false;
        if ($checkbox){
            $checkboxChecked =   $checkbox[$name];
        }

        echo '
        <div 
        class="' . $classes . '">
        
        <label class="switch" for="' . $name . '">
        <input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ($checkboxChecked == 1 ? 'checked' : '') . ' > 
         <span class="slider round"></span>
        </label>
           
        </div>';
    }

 }