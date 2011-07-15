<?php


define('T_URI', get_template_directory_uri() . '/');

add_theme_support('post-thumbnails');

register_nav_menu('nav', __( 'Navigation' ));


add_action('init', 'rcm_init');

function rcm_init(){

    add_image_size('page-thumbnail', 960, 240, true);
    add_image_size('player-thumbnail', 290, 290, true);

    register_post_type('player', array(
        'labels' => array('name' => 'Jucători',
                          'singular_name' => 'Jucător'),
        'public' => true,
        'rewrite' => array('slug' => 'jucator', 'with_front' => true),
        'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'custom-fields', 'post-formats', 'post-thumbnails')
    ));

    register_post_type('junior', array(
        'labels' => array('name' => 'Juniori',
                          'singular_name' => 'Junior'),
        'public' => true,
        'rewrite' => array('slug' => 'junior', 'with_front' => true),
        'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'custom-fields', 'post-formats', 'post-thumbnails')
    ));


    register_post_type('matches', array(
        'labels' => array('name' => 'Meciuri',
                          'singular_name' => 'Meci',
                          'add_new_item' => 'Adaugă un meci',
                          'edit_item' => 'Editează meciul'
                          ),
        'public' => true,
        'rewrite' => array('slug' => 'calendar-meciuri', 'with_front' => true),
        'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'custom-fields', 'post-formats', 'post-thumbnails')
    ));

    register_taxonomy('league', 'matches', array(

        

    ));



}


class extended_walker extends Walker_Nav_Menu{
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

        if ( !$element )
            return;

        $id_field = $this->db_fields['id'];

        //display this element
        if ( is_array( $args[0] ) )
            $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );

        //Adds the 'parent' class to the current item if it has children
        if( ! empty( $children_elements[$element->$id_field] ) )
            array_push($element->classes,'parent');

        $cb_args = array_merge( array(&$output, $element, $depth), $args);

        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

            foreach( $children_elements[ $id ] as $child ){

                if ( !isset($newlevel) ) {
                    $newlevel = true;
                    //start the child delimiter
                    $cb_args = array_merge( array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                }
                $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
            }
            unset( $children_elements[ $id ] );
        }

        if ( isset($newlevel) && $newlevel ){
            //end the child delimiter
            $cb_args = array_merge( array(&$output, $depth), $args);
            call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }

        //end this element
        $cb_args = array_merge( array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);
    }
}




function get_page_link_by_path( $page_slug ) {
    $page = get_page_by_path($page_slug);
    return ($page) ? get_permalink( $page->ID ) : '#';
}

function to_page($slug){ echo get_page_link_by_path($slug); }


function rcm_get_the_event_date(){
    global $post;
    if(! $post) return null;
    $meta = get_post_meta($post->ID, 'data', true);
    return $meta? $meta : get_the_date();
}


function rcm_the_event_date(){
    echo rcm_get_the_event_date();
}


function rcm_the_event_location(){
    global $post;
    echo get_post_meta($post->ID, 'unde', true);
}


function rcm_get_the_facebook_event_link(){
    global $post;
    return get_post_meta($post->ID, 'eveniment_facebook', true);
}

function rcm_the_facebook_event_link(){
    echo rcm_get_the_facebook_event_link();
}

function rcm_has_facebook_event(){
    return !!rcm_get_the_facebook_event_link();
}
