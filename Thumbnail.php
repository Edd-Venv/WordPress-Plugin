<?php

namespace Inc\Base;

class Thumbnail 
{
    public function register() 
    {
        add_action( 'after_setup_theme', array($this, 'wpdocs_setup_theme' ) );
    }

    public function wpdocs_setup_theme() 
    {
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'small-thumbnail' , 50, 50, true);
        add_image_size('medium-thumbnail' , 150, 150, true);
    }
}
?>