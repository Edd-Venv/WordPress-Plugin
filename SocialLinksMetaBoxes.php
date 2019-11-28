<?php 
namespace Inc\MetaBoxes;

class SocialLinksMetaBoxes 
{

    public function register()
    {
        add_action( 'add_meta_boxes', array($this, 'contact_social_media_add_meta_box' ) );
        add_action( 'save_post', array($this, 'save_social_media_data' ) );   
    }


    public function __construct( $link = '' )
    {
        $Link = "";
        $this->$Link = $link;
    }

    public function contact_social_media_add_meta_box() 
    {
        $social_link = $this->$Link;
        
        add_meta_box( "$social_link", "$social_link", array($this,'contact_social_media_callback'), 'person', 'normal', 'low' );
    }
    public function contact_social_media_callback( $post ) 
    {
        $social_link = $this->$Link;

        wp_nonce_field( array($this,'save_social_media_data'), 'contact_social_media_' . $social_link . '_meta_box_nonce' );

        $data = get_post_meta( $post->ID, '_social_media_' . $social_link . '_key', true);

        echo'<label for="contact_social_media_' . $social_link . '_field"><b>' . $social_link . ':</b> </label>';
        echo'<input type="text" id="contact_social_media_' . $value2 . '_field" name="contact_social_media_' . $social_link . '_field" 
        value="' . esc_attr( $data ) . '" size="25" placeholder="i.e www.' . $social_link . '.com" />';
    }
    
     public function save_social_media_data( $post_id ) 
    {
        $social_link = $this->$Link;
        
        if ( ! isset( $_POST['contact_social_media_' . $social_link . '_meta_box_nonce'] ) ){
            return;
        }
        if( ! wp_verify_nonce($_POST['contact_social_media_' . $social_link . '_meta_box_nonce'], array($this, 'save_social_media_data') ) ) {
            return;
        }
        if( ! current_user_can( 'edit_post', $post_id) ) {
            return;
        }
        if( !isset( $_POST['contact_social_media_' . $social_link . '_field'] ) ) {
            return;
        }
        
        $LinkData = sanitize_text_field( $_POST['contact_social_media_' . $social_link . '_field'] );
        update_post_meta( $post_id , '_social_media_' . $social_link . '_key', $LinkData );
    }
}
    
?>