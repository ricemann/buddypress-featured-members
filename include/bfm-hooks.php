<?php
function bfm_make_featured_button(){
    global $bp;
    if( !is_user_logged_in() || !current_user_can('create_users') )
        return false;
    
    $uid = $bp->displayed_user->id;
    
    $is_featured = get_user_meta($uid, 'bfm_is_featured', true);
    if(!$is_featured){
       $id = $component = $wrapper_id = 'make-featured';
       $link_title = 'Make this user as Featured Member';
       $link_text = 'Make Featured';
       $link = $bp->displayed_user->domain.'?make-featured=true&process-featured=true';
       
    }
    else{
       $id = $wrapper_id = 'remove-featured';
       $link_title = 'Remove this user from Featured Member';
       $link_text = 'Remove Featured';
       $link = $bp->displayed_user->domain.'?remove-featured=true&process-featured=true';
       
    }
    echo bp_get_button( array(
                        'id'                => $id,
                        'component'         => 'members',
                        'must_be_logged_in' => true,
                        'wrapper_id'        => $wrapper_id,
                        'link_href'         => $link,
                        'link_title'        => __( $link_title, 'bfm' ),
                        'link_text'         => __( $link_text, 'bfm' ),
                        'link_class'        => 'make-remove-featured',
                ) );
}
add_action('bp_profile_header_meta','bfm_make_featured_button');

///////////////////////////////////////////////////////////////////////////////////////

function bfm_add_remove_featured_link_process(){
    global $bp;
    if( !is_user_logged_in() || !current_user_can('create_users') )
        return false;
    if( !isset($_GET['process-featured']) )
        return false;
        
    $uid = $bp->displayed_user->id;
    $is_featured = get_user_meta($uid, 'bfm_is_featured', true);
    if(!$is_featured){
        if ( update_user_meta($uid, 'bfm_is_featured', 1) )
                return true;
    }else{
        if ( update_user_meta($uid, 'bfm_is_featured', 0) )
                return true;
    }
}
add_action('wp_head','bfm_add_remove_featured_link_process');

///////////////////////////////////////////////////////////////////////////////////////
