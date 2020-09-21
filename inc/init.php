<?php
namespace Inc;
 final class Init{


    /**
     * @return string[]
     * store all the classes inside array
     */
    public static function get_services()
    {
        return [

            Pages\Admin::class,
            Pages\AjaxResponse::class,
            Base\enqueue::class,
           /* Base\CustomPostTypeController::class*/
        ];
    }

     /**
     * Loop through the classes ,initialize them,
     *
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class){

            $service = self::instantiate($class);

            if (method_exists($service,'register')){
                $service->register();
            }

        }
    }

    private static function instantiate($class)
    {
        return new $class;
    }
}