<?php
namespace Inc\CustomPostType;

class CustomPostType
{
    public function register()
    {
        add_filter('manage_person_posts_columns', array($this, 'person_set_contact_columns' ) );
        add_action( 'manage_person_posts_custom_column', array($this, 'person_custom_column'), 10, 2);
        add_action ('init', array($this, 'custom_post_type' ) );
        
    }

    public function custom_post_type()
    {
        register_post_type('person',array(
            'rewrite' => array('slug' => 'person'),
            'labels' => array(
                'name' => 'Persons',
                'singular_name' => 'Person',
                'add_new_item' => 'Add New Person',
                'edit_item' => 'Edit Person',
                'view_item' => 'View Person',
                'not_found' => 'No Persons Found'
            ), 
            'capability_type' => 'post',
            'menu-icon' => 'dasicons-clipboard',
            'menu_position' => 2,
            'public' => true,
            'has_archive'=> false,
            'supports' => array(
                'thumbnail', 'revisions', 'title'
            )
            ));
       
    }

    //Person Custom Post Type Columns
    public function person_set_contact_columns($columns)
    {
        $newColumns = array();
        $newColumns['title'] = 'Full Name';
        $newColumns['position'] = 'Position';
        $newColumns['description'] = 'Description';
        $newColumns['date'] = 'Date';
        return $newColumns;
    }
    public function person_custom_column($column, $post_id)
    {

        switch( $column )
        {

            case 'position' :
                $position = get_post_meta( $post_id, '_position_value_key', true);
                if ( is_string( $position ) ){
                    echo $position;
                }
                break;

            case 'description' :
                $description = get_post_meta( $post_id, '_description_value_key', true);
                if ( is_string( $description ) ){
                    echo $description;
                }
                break;
        }
    }
    
}
?>