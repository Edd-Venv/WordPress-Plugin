<?php

namespace Inc\MetaBoxes;

class SocialLinks extends SocialLinksMetaBoxes
{
    public function register()
    {
        add_action( 'init', array($this, 'social_links_meta_boxes_foreach' ) );   
    }

    public function social_links_meta_boxes_foreach() 
    {
        //A foreach to loop through the array and create a custom metabox for each Element.
        
        $links = array('Facebook', 'Github', 'LinkedIn', 'Xing');
    
        foreach ($links as $link) 
        {
           $SocialMediaLinks = new SocialLinksMetaBoxes($link);
           $SocialMediaLinks->register();
        }
    }
}
?>