<?php 

namespace Inc\MetaBoxes;

class DescriptionMetaBox
{
    public function register()
    {
        add_action( 'add_meta_boxes', array($this, 'contact_description_add_meta_box' ) );
        add_action( 'save_post', array($this,'save_description_data' ) );
    }
    
    public function contact_description_add_meta_box() 
    {
        add_meta_box( 'description', 'Contact Description', array($this,'contact_description_callback'), 'person', 'normal', 'default' );
    }

    public function contact_description_callback( $post ) 
    {
        wp_nonce_field( array($this,'save_description_data'), 'contact_description_meta_box_nonce' );

        $value = get_post_meta( $post->ID, '_description_value_key', true);

        echo'<label for="contact_description_field"><b>Description: </b></label>';
        echo'<br/>';
        echo'<textarea type="text" id="contact_description_field" name="contact_description_field" 
        value="" cols="100%" rows="6" placeholder="Short Description..." maxlength="70" >'.esc_textarea( $value ).'</textarea>';
    }
    public function save_description_data( $post_id ) 
    {
        if ( ! isset( $_POST['contact_description_meta_box_nonce'] ) ){
            return;
        }
        if( ! wp_verify_nonce($_POST['contact_description_meta_box_nonce'], array($this,'save_description_data') ) ) {
            return;
        }
        if( ! current_user_can( 'edit_post', $post_id) ) {
            return;
        }
        if( !isset( $_POST['contact_description_field'] ) ) {
            return;
        }
        $description = sanitize_text_field( $_POST['contact_description_field'] );
        update_post_meta($post_id, '_description_value_key', $description );
    }
}
?>