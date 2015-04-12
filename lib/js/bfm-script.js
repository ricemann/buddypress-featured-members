var jq = jQuery;
jq(document).ready(function(){
   jq('.make-remove-featured').live('click',function(){
       var bfm_action = jq(this).parent().attr('id');
       jq.post( ajaxurl,{ 'action': 'bfm_featured_process', 'bfm_action': bfm_action },function(response){
          jq('.make-remove-featured').text(response);
          var notice = '';
          var style = '';
          if( response == 'Make Featured' ){
              notice = 'Member removed from featured';
              style = 'error';
          }
          else if ( response == 'Remove Featured' ){
              notice = 'Member marked as featured';
              style = 'updated';
          }
          var html = '<div id="message" class="bp-template-notice '+style+' bfm-notice">'
                     +'<p>'+notice+'</p>'
                     +'</div>';
          jq('.bfm-notice').remove();
          jq('#item-header-content').after(html);
          jq('.bfm-notice').hide().fadeIn(1500).fadeOut(1500);
       });
       return false;
   });
   
   jq("div#slider").carouFredSel({
	circular: false,
	infinite: false,
	auto 	: false,
	prev	: {	
		button	: "#bfm_prev",
		key		: "left"
	},
	next	: { 
		button	: "#bfm_next",
		key		: "right"
	}
	//pagination	: "#foo2_pag"
    });
    jq('.bfm_nav').width( jq('#bfm_members').width()+20 );
    jq('.bfm_nav').css('margin-top',( ( jq('.bfm_single_member img').eq(1).height() )/ 2 ) + 15  );
    jq('.caroufredsel_wrapper').height(  jq('.bfm_single_member img').eq(1).height()*2 );
});