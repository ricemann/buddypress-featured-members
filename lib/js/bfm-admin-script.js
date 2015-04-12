var jq = jQuery;
jq(document).ready(function(){
    jq('.bfm-donate-form').submit(function(){
       var donate = jq('.bfm-donate-form select').val();
       if(!donate){
           alert('umm! may be you forgot to select amount');
           return false;
       }
    });
    jq('.filter_radio_box span.option').click(function(){
        jq('.filter_radio_box span.option').removeClass('selected');
        jq(this).addClass('selected');
        jq('input#filter').val(jq(this).attr('value'));
    });
    jq('.user_type_radio_box span.option').click(function(){
        jq('.user_type_radio_box span.option').removeClass('selected');
        jq(this).addClass('selected');
        jq('input#user_type').val(jq(this).attr('value'));
    });
    jq('.view_radio_box span.option').click(function(){
        jq('.view_radio_box span.option').removeClass('selected');
        jq(this).addClass('selected');
        jq('input#view_mode').val(jq(this).attr('value'));
    });
    jq('.avatar-style-box .avatar-box').click(function(){
        var style = jq(this).find('img').attr('class');
        jq('.avatar-style-box .avatar-box').removeClass('selected');
        jq(this).addClass('selected');
        jq('input#avatar_style').val(style);
        jq('.avatar-size-box').find('img').attr('class',style);
    });
    
    jq( "#slider-range-max" ).slider({
      range: "max",
      max: 110,
      
      slide: function( event, ui ) {
        jq( "#avatar_size" ).val( 150-ui.value );
        jq('.avatar-size-box').find('img').css('width',150-ui.value );
      }
    });
    jq( "#avatar_size" ).val( 150 - ( jq( "#slider-range-max" ).slider( "value" ) ) );
    
    jq('a.res').click(function(){
        alert(jq('input#view_mode').val());
        return false;
    });
    jq('.generate_shortcode').click(function(){
        var shortcode = '';
        var max = jq('input#max_featured_member').val();
        var filter = jq('input#filter').val();
        var view = jq('input#view_mode').val();
        var astyle = jq('input#avatar_style').val();
        var asize = jq('input#avatar_size').val();
        var user_type = jq('input#user_type').val();
        shortcode = '[bfm view="'+view+'" max="'+max+'" filter="'+filter+'"' 
        if(user_type)
        shortcode +=  ' user_type="'+user_type+'"';
        shortcode += ' astyle="'+astyle+'" asize="'+asize+'"]';
        jq('.bfm_shortcode').css('display','block').hide().text(shortcode).fadeIn(500);
        return false;
    });
});