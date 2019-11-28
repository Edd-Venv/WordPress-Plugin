<?php

namespace Inc;


final class Init
{
    /*
    Store All the Classes inside an array
    @return array full list of classes
    */
    public static function get_services(){
        return [
            Base\Enqueue::class,
            Base\TemplateController::class,
            Base\Thumbnail::class,
            CustomPostType\CustomPostType::class,
            MetaBoxes\DescriptionMetaBox::class,
            MetaBoxes\NameMetaBox::class,
            MetaBoxes\PositionMetaBox::class,
            MetaBoxes\SocialLinks::class,
            
        ];
    }

    /*
    Loop through the classes, initialize them, and call the register()
    method if it exists
    @return
    */
   public static function register_services() {
        foreach ( self::get_services() as $class){
            $service = self::instantiate($class);
            if(method_exists($service, 'register')){
                $service->register();
            }
        }
    }

    /*
    Initialize the class
    @param $class  from the services array
    @return class instance new instance of the class
    */
    private static function instantiate( $class)
    {
        $service = new $class();
        return $service;
    }
}

?>