jQuery(document).ready(function($) {
	
	//responsive for IE-8 code here
        // Normal Case
        var size = jQuery('body').width();
        if (size <= 767) {
            jQuery('body').removeClass('tablet').removeClass('desktop');
            jQuery('body').addClass("mobile");
        } else if (size >= 768 && size <= 960) {
            jQuery('body').removeClass('mobile').removeClass('desktop');
            jQuery('body').addClass("tablet");
			//jQuery('#main-message').hide();
			//alert('tablet');
        } else if (size >= 961) {
            jQuery('body').removeClass('mobile').removeClass('tablet');
            jQuery('body').addClass("deskop");
        }
        else {

            jQuery('body').removeClass('mobile').removeClass('tablet');
            jQuery('body').addClass("deskop");
        }

        // Resize
        jQuery(window).resize(function () {
            var size = jQuery('body').width();
            if (size <= 767) {
                jQuery('body').removeClass('tablet').removeClass('deskop');
                jQuery('body').addClass("mobile");
            } else if (size >= 768 && size <= 960) {
                jQuery('body').removeClass('mobile').removeClass('deskop');
                jQuery('body').addClass("tablet");
            } else if (size >= 961) {
                jQuery('body').removeClass('mobile').removeClass('tablet');
                jQuery('body').addClass("deskop");
            }
            else {
                jQuery('body').removeClass('mobile').removeClass('tablet');
                jQuery('body').addClass("deskop");
            }
        });
		
	/////////////////////////////////
	$('.nav-toggle').click(function() {
    $('#main-menu div ul:first-child').slideToggle(250);
    return false;
  });
  
	if( (size > 640) || (size > 640) ) {
        $('#main-menu li').mouseenter(function() {
			$(this).children('ul').css('display', 'none').stop(true, true).slideToggle(250).css('display', 'block').children('ul').css('display', 'none');
		});
		
		$('#main-menu li').mouseleave(function() {
				$(this).children('ul').stop(true, true).fadeOut(250).css('display', 'block');
		});
    } else {
		$('#main-menu li').each(function() {
		if($(this).children('ul').length){
			//$(this).append('<span class="drop-down-toggle"><span class="drop-down-arrow"></span></span>');
			$(this).append('<span class="drop-down-toggle-wrapper"><span class="drop-down-toggle"><span class="drop-down-arrow"></span></span></span>');
		}
    });
    $('.drop-down-toggle-wrapper').click(function() {
      $(this).parent().children('ul').slideToggle(250);
    });
  }
  
  //Secondary Sub Menu
  $('#block-menu-menu-topbar-links').find('.menu').slicknav({
	label: '',});
 
});