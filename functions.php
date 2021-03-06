<?php


define('T_URI', get_template_directory_uri() . '/');
define('RCM_HEADER_SLIDE_WIDTH', 928);
define('RCM_HEADER_SLIDE_HEIGHT', 321);

add_theme_support('post-thumbnails');

register_nav_menu('nav', __( 'Navigation' ));


add_action('init', 'rcm_init');

function rcm_init(){


    add_image_size('page-thumbnail', 940, 240, true);
    add_image_size('slide', RCM_HEADER_SLIDE_WIDTH, RCM_HEADER_SLIDE_HEIGHT, true);
    add_image_size('player-thumbnail', 290, 290, false);
    add_image_size('partner-thumb', 120, 120, false);

    register_post_type('player', array(
        'labels' => array('name' => 'Jucători',
                          'singular_name' => 'Jucător'),
        'public' => true,
        'rewrite' => array('slug' => 'jucator', 'with_front' => true),
        'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'custom-fields', 'post-formats', 'post-thumbnails')
    ));

    register_post_type('staff', array(
        'labels' => array('name' => 'Membrii',
                          'singular_name' => 'Membru'),
        'public' => true,
        'rewrite' => array('slug' => 'membrii', 'with_front' => true),
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

    register_post_type('tv_schedule', array(
        'labels' => array(
            'name' => 'Program TV',
            'singular_name' => 'Program TV',
            'add_new_item' => 'Adaugă o Emisiune',
            'edit_item' => 'Schimbă Emisiunea'
        ),
        'public' => true,
        'supports' => array('title', 'excerpt', 'custom-fields')
    ));


    register_taxonomy('league', 'matches', array(
        'labels' => array(
            'name' => 'Campionate',
            'singular_name' => 'Campionat',
            'choose_from_most_used' => 'Alege dintre cele mai folosite'
        )
    ));

    register_taxonomy('stadium', 'matches', array(
        'labels' => array( 'name' => 'Stadioane',
                           'singular_name' => 'Stadion',
                           'choose_from_most_used' => 'Alege dintre cele mai folosite'
    )));

    register_taxonomy('versus', 'matches', array(
        'labels' => array(
            'name' => 'Echipe',
            'singular_name' => 'Echipa',
            'choose_from_most_used' => 'Alege dintre cele mai folosite'
        )
    ));

    register_taxonomy('staff_category', 'staff', array(
        'labels' => array(
            'name' => 'Categorie',
            'singular_name' => 'Categorie',
            'choose_from_most_used' => 'Alege dintre cele mai folosite'
        )
    ));


    register_post_type('rankings', array(
        'labels' => array(
            'name' => 'Pozitii in Clasament',
            'singular_name' => 'Pozitie'
        ),
        'public' => true,
        'supports' => array('custom-fields', 'title')
    ));

    register_taxonomy_for_object_type('league', 'rankings');
    register_taxonomy_for_object_type('versus', 'rankings');
    register_taxonomy_for_object_type('versus', 'tv_schedule');
    register_taxonomy_for_object_type('league', 'tv_schedule');


    register_taxonomy('tv_program', 'tv_schedule', array(
        'labels' => array(
            'name' => 'Programe',
            'singular_name' => 'Program',
            'choose_from_most_used' => 'Alege dintre cele mai folosite'
        )
    ));

    register_post_type('slide', array(
        'labels' => array('name' => 'Imagini Header',
                          'singular_name' => 'Imagine'),
        'public' => true,
        'ui' => true,
        'supports' => array('title', 'thumbnail', 'post-formats', 'post-thumbnails')
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


function rcm_term_name($term){
    return $term->description? $term->description : $term->name;
}



$rcm_meta_boxes = array(
    'tv_schedule' => array(
        'id' => 'schedule-entry-id',
        'title' => 'ID-ul Emisiunii',
        'page' => 'tv_schedule',
        'context' => 'side',
        'priority' => 'high',
        'callback'=> 'rcm_show_tv_schedule_meta_box'
    ),
    'article_ID' => array(
        'id' => 'this-article-id',
        'title' => 'ID-ul Articolului',
        'page' => 'post',
        'context' => 'side',
        'priority' => 'high',
        'callback'=> 'rcm_show_article_ID_meta_box'
    )

);

add_action('admin_menu', 'rcm_add_meta_boxes');
function rcm_add_meta_boxes(){
    global $rcm_meta_boxes;
    foreach($rcm_meta_boxes as $m)
        add_meta_box($m['id'], $m['title'], $m['callback'], $m['page'], $m['context'], $m['priority']);
}

function rcm_show_tv_schedule_meta_box(){
    rcm_show_ID_meta_box('tv_schedule');
}


function rcm_show_article_ID_meta_box(){
    rcm_show_ID_meta_box('article_ID');
}

function rcm_show_ID_meta_box($config){
    global $tk_meta_boxes, $post;
    $m = $tk_meta_boxes[$config];
    if($post->ID): ?>
    <?php echo @$m['label']? $m['label'] : $m['title']; ?> <strong><?php echo $post->ID; ?></strong>
    <?php endif;
}


add_filter('body_class', 'rcm_body_class');
function rcm_body_class($list){
    global $post;
    if(is_page()){
        $list[] = "page-slug-{$post->post_name}";
    }

    return $list;
}

function rcm_get_match_stadium($match_ID = null){
    ( null == $match_ID ) && ( $match_ID = get_the_ID() );
    $stadium = @array_shift( get_the_terms($match_ID, 'stadium') );
    return $stadium ? $stadium->name : get_post_meta($match_ID, 'unde', true);
}

function rcm_get_match_stadium_link($match_ID = null){
    ( null == $match_ID ) && ( $match_ID = get_the_ID() );
    $stadium = @array_shift( get_the_terms($match_ID, 'stadium') );
    return $stadium && $stadium->description ? $stadium->description : null;
}


define('PRESS_RELEASE_CATEGORY', get_category_by_slug('comunicate-de-presa')->cat_ID);

add_filter('the_date', 'rcm_set_date_to_ro_RO');
function rcm_set_date_to_ro_RO($str){
    return strtr($str, array(
        'January' => 'ianuarie',
        'February' => 'februarie',
        'March' => 'martie',
        'April' => 'aprilie',
        'May' => 'mai',
        'June' => 'iunie',
        'July' => 'iulie',
        'August' => 'august',
        'September' => 'septembrie',
        'October' => 'octombrie',
        'october' => 'octombrie',
        'November' => 'noiembrie',
        'December' => 'decembrie'


    ));
}

add_filter('the_content', 'rcm_the_content_filter');
function rcm_the_content_filter($content){
    return str_replace('Echipa anterioara', 'Echipa de formare', $content);
}

function reduce_by_global_league($match){
    global $league;
    return is_object_in_term($match->ID, 'league', $league);
}

function get_header_images_hash () {
    $slides = array();
    foreach(query_posts('post_type=slide&posts_per_page=-1') as $slide){
        $slides[] = array('caption' => $slide->post_title, 'image_src' =>
            wp_get_attachment_image_src( get_post_thumbnail_id( $slide->ID ), 'slide' )
        );
    }
    return $slides;
}

