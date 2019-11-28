<?php

namespace Inc\MetaBoxes;

class PositionMetaBox
{
    public function register()
    {
       add_action( 'save_post', array($this,'save_position_data' ) );
       add_action( 'add_meta_boxes', array($this, 'contact_position_add_meta_box' ) );
    }

    public function contact_position_add_meta_box() 
    {
        add_meta_box( 'position', 'Contact Position', array($this,'contact_position_callback'), 'person', 'normal', 'high' );
    }

    public function contact_position_callback( $post ) 
    {
        wp_nonce_field( array($this,'save_position_data'), 'contact_position_meta_box_nonce' );

        $value = get_post_meta( $post->ID, '_position_value_key', true);

        echo'<label for="contact_position_field"><b>Postion:</b> </label>';
        echo'<input type="text" id="contact_positon_field" name="contact_position_field" 
        value="' . esc_attr( $value ) . '" size="25" placeholder="i.e CEO, Developer" />';
    }
    public function save_position_data( $post_id ) 
    {
        if ( ! isset( $_POST['contact_position_meta_box_nonce'] ) ){
            return;
        }
        if( ! wp_verify_nonce($_POST['contact_position_meta_box_nonce'], array($this,'save_position_data') ) ) {
            return;
        }
        if( ! current_user_can( 'edit_post', $post_id) ) {
            return;
        }
        if( !isset( $_POST['contact_position_field'] ) ) {
            return;
        }
        $position = sanitize_text_field( $_POST['contact_position_field'] );
        update_post_meta($post_id, '_position_value_key', $position );
    }
}
?>