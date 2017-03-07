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
            jQuery('body').addClass("desktop");
        }
        else {

            jQuery('body').removeClass('mobile').removeClass('tablet');
            jQuery('body').addClass("desktop");
        }

        // Resize
        jQuery(window).resize(function () {
            var size = jQuery('body').width();
            if (size <= 767) {
                jQuery('body').removeClass('tablet').removeClass('desktop');
                jQuery('body').addClass("mobile");
            } else if (size >= 768 && size <= 960) {
                jQuery('body').removeClass('mobile').removeClass('deskop');
                jQuery('body').addClass("tablet");
            } else if (size >= 961) {
                jQuery('body').removeClass('mobile').removeClass('tablet');
                jQuery('body').addClass("desktop");
            }
            else {
                jQuery('body').removeClass('mobile').removeClass('tablet');
                jQuery('body').addClass("desktop");
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
  
  //On Window Load
  /*$( window ).load(function() {
    $("#mobile-blocks-servicestatus").html('<div id="block-servicestatus-mta-service-status" class="roundCorners featurebox">' + $('#block-servicestatus-mta-service-status').html() + '</div>');
	$("#mobile-blocks-tripplanner").html('<div id="block-tripplanner-tripplanner" class="block block-tripplanner">' + $('#block-tripplanner-tripplanner').html() + '</div>');
	$("#mobile-blocks-rotaterimage").html('<div id="block-views-news-rotator-block-1" class="block block-views contextual-links-region">' + $('#block-views-news-rotator-block-1').html() + '</div>');
	$("#mobile-blocks-traveltime").html('<div id="block-block-156" class="block block-block contextual-links-region">' + $('#block-block-156').html() + '</div>');
	$("#mobile-blocks-mymtaalerts").html('<div id="block-block-1426" class="block block-block contextual-links-region">' + $('#block-block-1426').html() + '</div>');
	$("#mobile-blocks-appcenter").html('<div id="block-block-381" class="block block-block contextual-links-region">' + $('#block-block-381').html() + '</div>');
  });
  */
  
  //Secondary Sub Menu
 
 
});