<?php

function bfm_get_all_users($featured = ''){
    global $wpdb;
    $query = "SELECT ID as user_id FROM $wpdb->users";

    $metakey = 'bfm_is_featured';
    if($featured){

        $query = "SELECT user_id FROM $wpdb->usermeta WHERE meta_key = %s AND meta_value = 1";
        $result = $wpdb->get_results($wpdb->prepare($query, $metakey), ARRAY_A);
    }else{
        $result = $wpdb->get_results($query, ARRAY_A);
    }

    $i=0;
    $uids = array();
    foreach ($result as $udata) {
        $uids[$i] = $udata['user_id'];
        $i++;
    }
    return (array) $uids;
}

//////////////////////////////////////////////////////////////////////////////////////////////

function bfm_get_exclution_ids(){
    $all = bfm_get_all_users();
    $featured = bfm_get_all_users(true);
    $i = 0;
    foreach ($all as $id ) {
        if( !in_array($id, $featured) )
            $excludes[$i++] = $id;
    }
    return (array) $excludes;
}

//////////////////////////////////////////////////////////////////////////////////////////////

function bfm_featured_members_markup($query,$view,$astyle,$asize){
    if(!$query)
        return;

    if(bp_has_members($query)) {
        $html = '<div id="bfm_members">';
        if ($view == 'slider') {
            $html .= '<div class="bfm_nav">';
            $html .= '<a class="prev" id="bfm_prev" href="#"><span>prev</span></a>';
            $html .= '<a class="next" id="bfm_next" href="#"><span>prev</span></a>';
            $html .= '</div>';
        }
        $html .= '<div id="' . $view . '">';
        while (bp_members()) {
            bp_the_member();
            $html .= '<div class="bfm_single_member">';
            $avatar = bp_get_member_avatar(array(
                'type' => 'full',
                'width' => $asize,
                'height' => $asize,
                'class' => $astyle . ' bfm_member',
                'alt' => bp_get_member_name()
            ));
            $html .= '<a href="' . bp_get_member_permalink() . '">' . $avatar . '</a>';
            $html .= '<p class="bfm_member_name">' . bp_get_member_name() . '</p>';
            $html .= '</div>';
        }
        $html .= '</div>';
        if ($view == 'slider'){

        }
        $html .= '<div class="clear"></div>';
        $html .= '</div>';
    }
    return $html;
}

//////////////////////////////////////////////////////////////////////////////////////////////

function bfm_shortcode($atts ){
    extract( shortcode_atts( array(
		'max' => 5,
		'view' => 'slider',
                'filter' => 'active',
                'user_type' => null,
                'astyle' => 'round_0',
                'asize' => '150'
	), $atts ) );
    $query = "type=$filter&max=$max";
    $excludes = '-1';//bfm_get_exclution_ids();
    /*if( is_plugin_active('buddypress-user-account-type-pro/buddypress-user-account-type-pro.php') && $user_type){
        $user_type_excludes = buatp_get_filtered_members('exclude',$user_type);
        $excludes = array_merge($excludes,$user_type_excludes);
    }*/
    //$query .= '&exclude='.implode(',', $excludes);
    return bfm_featured_members_markup($query,$view,$astyle,$asize);
}
add_shortcode('bfm', 'bfm_shortcode');

//////////////////////////////////////////////////////////////////////////////////////////////

function bfm_donate_button(){
?>
<div class="bfm_box bfm-donate">
<form class="bfm-donate-form" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="DXBUMBXSF5JS4">
<input type="hidden" name="on0" value="bp-featured-member">
<p class="bfm-donate-text">Hey! Wanna offer some coffe?</p>
<select name="os0">
	<option value="">------------------------------------</option>
	<option value="$10">$10</option>
	<option value="$15">$15</option>
	<option value="$20">$20</option>
	<option value="$30">$30</option>
	<option value="$50">$50</option>
</select>
<br>
<input type="hidden" name="currency_code" value="USD">
<input class="bfm-donate-submit" type="image" src="<?php echo BFM_LIB_URL ?>images/donate-coffe.png" border="0" name="submit" alt="Drink Coffe, Do Code!" title="Drink Coffe, Do Code!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
<?php
}
add_filter('bfm_donation_markup','bfm_donate_button');
?>