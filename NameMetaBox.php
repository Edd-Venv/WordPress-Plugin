<?php

namespace Inc\MetaBoxes;

class NameMetaBox 
{
     public function register()
     {
        add_action( 'save_post', array($this,'save_name_data' ) );
        add_action( 'add_meta_boxes', array($this, 'contact_name_add_meta_box' ) );
     }


     public function contact_name_add_meta_box() 
     {
         add_meta_box( 'name', 'Contact Name', array($this,'contact_name_callback'), 'person', 'normal', 'high' );
     }
 
     public function contact_name_callback( $post ) 
     {
         wp_nonce_field( array($this,'save_name_data'), 'contact_name_meta_box_nonce' );
 
         $value = get_post_meta( $post->ID, '_name_value_key', true);
 
         echo'<label for="contact_name_field"><b>Full Name:</b> </label>';
         echo'<input type="text" id="contact_name_field" name="contact_name_field" 
         value="' . esc_attr( $value ) . '" size="25" placeholder="i.e John Doe" />';
     }
     public function save_name_data( $post_id ) 
     {
         if ( ! isset( $_POST['contact_name_meta_box_nonce'] ) ){
             return;
         }

         if( ! wp_verify_nonce($_POST['contact_name_meta_box_nonce'], array($this, 'save_name_data') ) ) {
             return;
         }
    
         if( ! current_user_can( 'edit_post', $post_id) ) {
             return;
         }

         if( !isset( $_POST['contact_name_field'] ) ) {
             return;
         }
         $name = sanitize_text_field( $_POST['contact_name_field'] );
         update_post_meta($post_id, '_name_value_key', $name );
     }
}
?>