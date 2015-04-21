
jQuery(document).ready(function($){
   $('.make-remove-featured').on('click',function(){
       var bfm_action = $(this).parent().attr('id');

       $.post( ajaxurl,{ 'action': 'bfm_featured_process', 'bfm_action': bfm_action },function(res){
          $('.make-remove-featured').text(res);
          var notice = '';
          var style = '';
          if( res == 'Make Featured' ){
              notice = 'Member removed from featured';
              style = 'error';
          }
          else if ( res == 'Remove Featured' ){
              notice = 'Member marked as featured';
              style = 'updated';
          }
          var html = '<div id="message" class="bp-template-notice '+style+' bfm-notice">'
                     +'<p>'+notice+'</p>'
                     +'</div>';
          $('.bfm-notice').remove();
          $('#item-header-content').after(html);
          $('.bfm-notice').hide().fadeIn(1500).fadeOut(1500);
       });
       return false;
   });
    $('#slider').carouFredSel({
        circular: true,
        infinite: true,
        auto 	: true,
        width   : '95%',
        align: "center",
        prev	: {
            button	: "#bfm_prev",
            key		: "left"
        },
        next	: {
            button	: "#bfm_next",
            key		: "right"
        },

        direction: "right",
        scroll : {
            items            : 3,
            easing            : "elastic",
            duration        : 1000,
            pauseOnHover    : true
        }
        //pagination	: "#foo2_pag"
    });

    $('.bfm_nav').width( $('.bfm_members').width()+10 );
    $('.bfm_nav').css('margin-top',( ( $('.bfm_single_member img').eq(1).height() )/ 2 ) + 15  );
    $('.caroufredsel_wrapper').height(  $('.bfm_single_member img').eq(1).height()*2 );
    $('.caroufredsel_wrapper').css('margin-left', '-20px');
    $('.bfm_nav').css('z-index', '2');
    $('.caroufredsel_wrapper').css('z-index', '1');
});