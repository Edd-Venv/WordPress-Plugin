<?php

namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueue extends BaseController
{
    public function register()
    {
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue' ) ); 
    }

    public function enqueue()
    {
        // enqueue all scripts
        wp_enqueue_style( 'pluginstyle', $this->plugin_url . ( '/assets/style.css' ) );

        wp_enqueue_script( 'pluginstyle', $this->plugin_url . ( '/node_modules/jquery/dist/jquery.js' ) );
        
        wp_enqueue_script( 'pluginscript', $this->plugin_url . ( '/assets/jQuery.js' ) );
        
    }
}
?>