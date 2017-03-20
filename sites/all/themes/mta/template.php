<?php
function mta_js_alter(&$js) {
    unset($js['misc/tableheader.js']);
}


function mta_preprocess_page(&$vars) {
	
  if (isset($vars['node']->type)) {
	   if($vars['node']->type == 'news_article'){
	      $vars['title'] ='default';
	      
	    if (!empty($vars['node']->field_news_page_headline['und'][0]['value'])) {
	      $vars['title'] = $vars['node']->field_news_page_headline['und'][0]['value'];
	    }elseif (!empty($vars['node']->field_headline['und'][0]['value'])) {
	      $vars['title'] = $vars['node']->field_headline['und'][0]['value'];
	    }elseif (!empty($vars['node']->field_emergency_headline['und'][0]['value'])) {
	      $vars['title'] = $vars['node']->field_emergency_headline['und'][0]['value'];
	    }
   }
  	
  		if ($vars['node']->type == "page_with_ad" || $vars['node']->type == "news_article")  {
    	 $vars['theme_hook_suggestions'][] = 'page__ad';
  		} 
  		
  		if ($vars['node']->type == "weekender" || $vars['node']->type == "weekender") {
  			$vars['theme_hook_suggestions'][] = 'page__weekender';
  		}
                if ($vars['node']->type == "weekendertwo" || $vars['node']->type == "weekendertwo") {
                        $vars['theme_hook_suggestions'][] = 'page__weekendertwo';
                }
  		
  		if ($vars['node']->type == "page_with_ad" || $vars['node']->type == "news_story")  {
  			$vars['theme_hook_suggestions'][] = 'page__ad';
  		}
  		
  		if ($vars['node']->type == "page_with_ad" || $vars['node']->type == "gallery_page")  {
  			$vars['theme_hook_suggestions'][] = 'page__ad';
  		}
  		
  		
  		if($vars['node']->type == 'press_release'){
  			$vars['title'] = '<a href="/press-releases">MTA Press Releases</a>';
  		}
  		
  		  		 		  		  	
  		else {
  	if ($vars['node']->type == "home_page") {
    	 $vars['theme_hook_suggestions'][] = 'page__home';
  		} 
  	}  
  }
  
 
  
  
  
  
 // adds the colorbox image gallery
 
  
  $vars['node']= '';
		if (isset($vars['node']->field_gallery_image)) {
  	foreach ($vars['node']->field_gallery_image[$vars['node']->language] as $key => $val) {
  		$full_img_url = file_create_url($val['uri']);
  		if ($key == 0) {
  			$thumbnail_url = image_style_url('thumbnail', $val['uri']);
  			$vars['gallery'] .= '<a class="colorbox-load" rel="gallery" href="'. $full_img_url .'"><img src="'. $thumbnail_url .'" alt="Gallery image" /></a>';
  		}
  		else {
  			$vars['node'] .= '<a class="colorbox-load" rel="gallery" href="'. $full_img_url .'"></a>';
  		}
  	}
  }
  
  
  /*************************Mobile View***********************/
	$mobile_blocks_array = array();
  if (drupal_is_front_page()) { //For home page

	$mobile_blocks_array[] = "servicestatus";
	$mobile_blocks_array[] = "tripplanner";
	$mobile_blocks_array[] = "rotaterimage";
	$mobile_blocks_array[] = "traveltime";
	$mobile_blocks_array[] = "mymtaalerts";
	$mobile_blocks_array[] = "appcenter";
	mobileblock_content_dynamic_home();
  } else if(drupal_get_path_alias() == 'nyct'){
    $mobile_blocks_array[] = "servicestatus";
	$mobile_blocks_array[] = "tripplanner";
	$mobile_blocks_array[] = "servicestatusnotices";
	$mobile_blocks_array[] = "specialservicenoties1";
	$mobile_blocks_array[] = "rotaterimage";
	$mobile_blocks_array[] = "secondavenuesubway";
	$mobile_blocks_array[] = "canarsietunnelreconstruction";
	$mobile_blocks_array[] = "traveltime";
	$mobile_blocks_array[] = "fixfortify";
	$mobile_blocks_array[] = "advertisewithus";
	mobileblock_content_dynamic_nyct();
  } else if(drupal_get_path_alias() == 'lirr'){
    $mobile_blocks_array[] = "servicestatus";
	$mobile_blocks_array[] = "tripplanner";
	$mobile_blocks_array[] = "servicestatusnotices";
	$mobile_blocks_array[] = "rotaterimage";
	$mobile_blocks_array[] = "secondavenuesubway";
	$mobile_blocks_array[] = "canarsietunnelreconstruction";
	$mobile_blocks_array[] = "traveltime";
	$mobile_blocks_array[] = "fixfortify";
	$mobile_blocks_array[] = "b711";
	mobileblock_content_dynamic_lirr();
  } else if(drupal_get_path_alias() == 'mnr'){
    $mobile_blocks_array[] = "servicestatus";
	$mobile_blocks_array[] = "tripplanner";
	$mobile_blocks_array[] = "servicestatusnotices";
	$mobile_blocks_array[] = "rotaterimage";
	$mobile_blocks_array[] = "secondavenuesubway";
	$mobile_blocks_array[] = "canarsietunnelreconstruction";
	$mobile_blocks_array[] = "traveltime";
	$mobile_blocks_array[] = "fixfortify";
	$mobile_blocks_array[] = "b286";
	$mobile_blocks_array[] = "b966";
	$mobile_blocks_array[] = "b1251";
	$mobile_blocks_array[] = "b651";
	$mobile_blocks_array[] = "b1451";
	$mobile_blocks_array[] = "b706";
	
	
	
	mobileblock_content_dynamic_mnr();
  } else if(drupal_get_path_alias() == 'bandt'){
    $mobile_blocks_array[] = "servicestatus";
	$mobile_blocks_array[] = "tripplanner";
	$mobile_blocks_array[] = "servicestatusnotices";
	$mobile_blocks_array[] = "rotaterimage";
	$mobile_blocks_array[] = "secondavenuesubway";
	$mobile_blocks_array[] = "canarsietunnelreconstruction";
	$mobile_blocks_array[] = "traveltime";
	$mobile_blocks_array[] = "fixfortify";
	$mobile_blocks_array[] = "b286";
	$mobile_blocks_array[] = "b966";
	$mobile_blocks_array[] = "b1251";
	$mobile_blocks_array[] = "b651";
	$mobile_blocks_array[] = "b1451";
	
	
	
	mobileblock_content_dynamic_bandt();
  }
  
  

  $mobile_blocks_var = "";
  foreach($mobile_blocks_array as $mobile_blocks){
	  $mobile_blocks_var .= mobileblock_set($mobile_blocks);
  }
  if(!empty($mobile_blocks_var))
    $vars['mobile_blocks'] = $mobile_blocks_var;

}

function mobileblock_set($id){
	
	$block = "";
	$block = '<div id="mobile-blocks-' . $id . '"></div>';
    return $block;
}
function mobileblock_content_dynamic_bandt(){
	$js = 'jQuery(document).ready(function($) {
  //On Window Load
  $( window ).load(function() {
    $("#mobile-blocks-servicestatus").html(\'<div class="block-heading-container">'. get_toggle_open('Service Status', 'icon-plus', 'open') . '<div id="block-servicestatus-mta-service-status" class="block-heading roundCorners featurebox open">\' + $(\'#block-servicestatus-mta-service-status\').html() + \'</div></div>\');
	
	$("#mobile-blocks-tripplanner").html(\'<div class="block-heading-container">'. get_toggle_open('TripPlanner', 'icon-plus') . '<div id="block-heading block-block-591" class="block-heading block block-block">\' + $(\'#block-block-591\').html() + \'</div></div>\');
	
	$("#mobile-blocks-servicestatusnotices").html(\'<div class="block-heading-container">'. get_toggle_open('Special Service Notices', 'icon-plus') . '<div id="block-service-notice-service-notice-bandt" class="block-heading block block-service-notice">\' + $(\'#block-service-notice-service-notice-bandt\').html() + \'</div></div>\');
	
	$("#mobile-blocks-rotaterimage").html(\'<div class="block-heading-container">'. get_toggle_open('Rotator', 'icon-plus') . '<div id="block-views-news-rotator-block-3" class="block-heading block block-views">\' + $(\'#block-views-news-rotator-block-3\').html() + \'</div></div>\');
	
	$("#mobile-blocks-appcenter").html(\'<div class="block-heading-container">'. get_toggle_open('App Center', 'icon-plus') .' <div id="block-block-381" class="block-heading block block-block contextual-links-region">\' + $(\'#block-block-381\').html() + \'</div></div>\');

	
$( ".block-toogle-heading" ).click(function() {
	  $(this).next( ".block-heading" ).toggle("slow");
	  $(this).toggleClass("open");
	  $(this).find(".title").toggle();
	  
	  $(this).find(".toggle-sign").toggleClass("open");
	  $(this).find(".toggle-sign").find(".icon").toggleClass("icon-plus");
	  $(this).find(".toggle-sign").find(".icon").toggleClass("icon-minus");
	});
	
	
  });
});';
  drupal_add_js($js, 'inline');
}

function mobileblock_content_dynamic_mnr(){
	$js = 'jQuery(document).ready(function($) {
  //On Window Load
  $( window ).load(function() {
    $("#mobile-blocks-servicestatus").html(\'<div class="block-heading-container">'. get_toggle_open('Service Status', 'icon-plus', 'open') . '<div id="block-servicestatus-mta-service-status" class="block-heading  roundCorners featurebox open">\' + $(\'#block-servicestatus-mta-service-status\').html() + \'</div></div>\');
	
	$("#mobile-blocks-tripplanner").html(\'<div class="block-heading-container">'. get_toggle_open('TripPlanner', 'icon-plus') . '<div id="block-tripplanner-tripplanner" class="block-heading block block-tripplanner">\' + $(\'#block-tripplanner-tripplanner\').html() + \'</div></div>\');
	
	$("#mobile-blocks-servicestatusnotices").html(\'<div class="block-heading-container">'. get_toggle_open('Special Service Notices', 'icon-plus') . '<div id="block-service-notice-service-notice-mnr" class="block-heading  block block-service-notice">\' + $(\'#block-service-notice-service-notice-mnr\').html() + \'</div></div>\');
	
	$("#mobile-blocks-rotaterimage").html(\'<div class="block-heading-container">'. get_toggle_open('Rotator', 'icon-plus') . '<div id="block-views-news-rotator-block-4" class="block-heading  block block-views">\' + $(\'#block-views-news-rotator-block-4\').html() + \'</div></div>\');
	
	
	$("#mobile-blocks-canarsietunnelreconstruction").html(\'<div class="block-heading-container">'. get_toggle_open('MTA eTix', 'icon-plus') . '<div id="block-block-1376" class="block-heading  block block-block">\' + $(\'#block-block-1376\').html() + \'</div></div>\');
	
	//$("#mobile-blocks-traveltime").html(\'<div class="block-heading-container">'. get_toggle_open('Conatc us', 'icon-plus') . '<div id="block-block-751" class="block-heading  block block-block">\' + $(\'#block-block-751\').html() + \'</div></div>\');
	
	$("#mobile-blocks-fixfortify").html(\'<div class="block-heading-container">'. get_toggle_open('Win 10 Rides ', 'icon-plus') . '<div id="block-block-771" class="block-heading  block block-block">\' + $(\'#block-block-771\').html() + \'</div></div>\');
	
	$("#mobile-blocks-b286").html(\'<div class="block-heading-container">'. get_toggle_open('Ways to Pay', 'icon-plus') . '<div id="block-block-286" class="block-heading  block block-block">\' + $(\'#block-block-286\').html() + \'</div></div>\');
	
	//$("#mobile-blocks-b966").html(\'<div class="block-heading-container">'. get_toggle_open('Metro North', 'icon-plus') . '<div id="block-block-966" class="block-heading  block block-block">\' + $(\'#block-block-966\').html() + \'</div></div>\');
	
	$("#mobile-blocks-b1251").html(\'<div class="block-heading-container">'. get_toggle_open('Deals and Gateway', 'icon-plus') . '<div id="block-block-1251" class="block-heading  block block-block">\' + $(\'#block-block-1251\').html() + \'</div></div>\'); 
	
	//$("#mobile-blocks-b651").html(\'<div class="block-heading-container">'. get_toggle_open('Safeguard Your Stuff', 'icon-plus') . '<div id="block-block-651" class="block-heading  block block-block">\' + $(\'#block-block-651\').html() + \'</div></div>\');
	
	$("#mobile-blocks-b1451").html(\'<div class="block-heading-container">'. get_toggle_open('My Alerts', 'icon-plus') . '<div id="block-block-1431" class="block-heading block block-block">\' + $(\'#block-block-1431\').html() + \'</div></div>\');
	
	$("#mobile-blocks-b706").html(\'<div class="block-heading-container">'. get_toggle_open('Travel Time', 'icon-plus') . '<div id="block-block-706" class="block-heading block block-block">\' + $(\'#block-block-706\').html() + \'</div></div>\');
	
	$( ".block-toogle-heading" ).click(function() {
	  $(this).next( ".block-heading" ).toggle("slow");
	  $(this).toggleClass("open");
	  $(this).find(".title").toggle();
	  
	  $(this).find(".toggle-sign").toggleClass("open");
	  $(this).find(".toggle-sign").find(".icon").toggleClass("icon-plus");
	  $(this).find(".toggle-sign").find(".icon").toggleClass("icon-minus");
	});
	
  });
});';
  drupal_add_js($js, 'inline');
}

function mobileblock_content_dynamic_lirr(){
	$js = 'jQuery(document).ready(function($) {
  //On Window Load
  $( window ).load(function() {
    $("#mobile-blocks-servicestatus").html(\'<div class="block-heading-container">'. get_toggle_open('Service Status', 'icon-plus', 'open') .' <div id="block-servicestatus-mta-service-status" class="block-heading roundCorners featurebox open">\' + $(\'#block-servicestatus-mta-service-status\').html() + \'</div></div>\');
	
	$("#mobile-blocks-tripplanner").html(\'<div class="block-heading-container">'. get_toggle_open('TripPlanner', 'icon-plus') .' <div id="block-tripplanner-tripplanner" class="block-heading block block-tripplanner">\' + $(\'#block-tripplanner-tripplanner\').html() + \'</div></div>\');
	
	$("#mobile-blocks-servicestatusnotices").html(\'<div class="block-heading-container">'. get_toggle_open('Special Service Notices', 'icon-plus') .' <div id="block-service-notice-service-notice-lirr" class="block-heading block block-service-notice">\' + $(\'#block-service-notice-service-notice-lirr\').html() + \'</div></div>\');
	
	$("#mobile-blocks-rotaterimage").html(\'<div class="block-heading-container">'. get_toggle_open('Rotator', 'icon-plus') .' <div id="block-views-news-rotator-block-2" class="block-heading block block-views">\' + $(\'#block-views-news-rotator-block-2\').html() + \'</div>\');
	
	$("#mobile-blocks-secondavenuesubway").html(\'<div class="block-heading-container">'. get_toggle_open('MTA Tix', 'icon-plus') .' <div id="block-block-1371" class="block-heading block block-block">\' + $(\'#block-block-1371\').html() + \'</div></div>\');
	
	$("#mobile-blocks-canarsietunnelreconstruction").html(\'<div class="block-heading-container">'. get_toggle_open('Ways to Pay', 'icon-plus') .' <div id="block-block-251" class="block-heading block block-block">\' + $(\'#block-block-251\').html() + \'</div></div>\');
	
	$("#mobile-blocks-traveltime").html(\'<div class="block-heading-container">'. get_toggle_open('Your Sport, Your Team, Your LIRR', 'icon-plus') .' <div id="block-block-1391" class="block-heading block block-block">\' + $(\'#block-block-1391\').html() + \'</div></div>\');
	
	$("#mobile-blocks-fixfortify").html(\'<div class="block-heading-container">'. get_toggle_open('My MTA Alerts®', 'icon-plus') .' <div id="block-block-1431" class="block-heading block block-block">\' + $(\'#block-block-1431\').html() + \'</div></div>\');
	
	$("#mobile-blocks-b711").html(\'<div class="block-heading-container">'. get_toggle_open('Train Time', 'icon-plus') .' <div id="block-block-711" class="block-heading block block-block">\' + $(\'#block-block-711\').html() + \'</div></div>\');
	
	$( ".block-toogle-heading" ).click(function() {
	  $(this).next( ".block-heading" ).toggle("slow");
	  $(this).toggleClass("open");
	  $(this).find(".title").toggle();
	  
	  $(this).find(".toggle-sign").toggleClass("open");
	  $(this).find(".toggle-sign").find(".icon").toggleClass("icon-plus");
	  $(this).find(".toggle-sign").find(".icon").toggleClass("icon-minus");
	});
  });
});';
  drupal_add_js($js, 'inline');
}

function mobileblock_content_dynamic_nyct(){
	$js = 'jQuery(document).ready(function($) {
  //On Window Load
  $( window ).load(function() {
    $("#mobile-blocks-servicestatus").html(\'<div class="block-heading-container">'. get_toggle_open('Service Status', 'icon-plus' , 'open' ) .' <div id="block-servicestatus-mta-service-status" class="block-heading  roundCorners featurebox open">\' + $(\'#block-servicestatus-mta-service-status\').html() + \'</div></div>\');
	
	$("#mobile-blocks-tripplanner").html(\'<div class="block-heading-container">'. get_toggle_open('TripPlanner', 'icon-plus') .' <div id="block-tripplanner-tripplanner" class="block-heading  block block-tripplanner">\' + $(\'#block-tripplanner-tripplanner\').html() + \'</div></div>\');
	
	$("#mobile-blocks-servicestatusnotices").html(\'<div class="block-heading-container">'. get_toggle_open('Special Service Notices', 'icon-plus') .' <div id="block-service-notice-service-notice-nyct" class="block-heading  block block-service-notice">\' + $(\'#block-service-notice-service-notice-nyct\').html() + \'</div></div>\');
	
	$("#mobile-blocks-specialservicenoties1").html(\'<div class="block-heading-container">'. get_toggle_open('Special Service Notices & Fasttrack', 'icon-plus') .' <div id="block-block-521" class="block-heading  block block-block">\' + $(\'#block-block-521\').html() + \'</div></div>\');
	
	$("#mobile-blocks-rotaterimage").html(\'<div class="block-heading-container">'. get_toggle_open('Rotator', 'icon-plus') .' <div id="block-views-news-rotator-block-5" class="block-heading  block block-views">\' + $(\'#block-views-news-rotator-block-5\').html() + \'</div></div>\');
	
	//$("#mobile-blocks-secondavenuesubway").html(\'<div class="block-heading-container">'. get_toggle_open('Second Avenue Subway ', 'icon-plus') .' <div id="block-block-1466" class="block-heading  block block-block">\' + $(\'#block-block-1466\').html() + \'</div></div>\');
	
	//$("#mobile-blocks-canarsietunnelreconstruction").html(\'<div class="block-heading-container">'. get_toggle_open('Canarsie Tunnel Reconstruction', 'icon-plus') .' <div id="block-block-1486" class="block-heading  block block-block">\' + $(\'#block-block-1486\').html() + \'</div></div>\');
	
	$("#mobile-blocks-traveltime").html(\'<div class="block-heading-container">'. get_toggle_open('Travel Time', 'icon-plus') .' <div id="block-block-231" class="block-heading  block block-block">\' + $(\'#block-block-231\').html() + \'</div></div>\');
	
	//$("#mobile-blocks-fixfortify").html(\'<div class="block-heading-container">'. get_toggle_open('Fix&Fortify', 'icon-plus') .' <div id="block-block-456" class="block-heading  block block-block">\' + $(\'#block-block-456\').html() + \'</div></div>\');
	
	$("#mobile-blocks-advertisewithus").html(\'<div class="block-heading-container">'. get_toggle_open('Advertise with Us', 'icon-plus') .' <div id="block-block-396" class="block-heading  block block-block">\' + $(\'#block-block-396\').html() + \'</div></div>\');
	
	$( ".block-toogle-heading" ).click(function() {
	  $(this).next( ".block-heading" ).toggle("slow");
	  $(this).toggleClass("open");
	  $(this).find(".title").toggle();
	  
	  $(this).find(".toggle-sign").toggleClass("open");
	  $(this).find(".toggle-sign").find(".icon").toggleClass("icon-plus");
	  $(this).find(".toggle-sign").find(".icon").toggleClass("icon-minus");
	});
	
  });
});';
  drupal_add_js($js, 'inline');
}


function mobileblock_content_dynamic_home(){
	$js = 'jQuery(document).ready(function($) {
  //On Window Load
  $( window ).load(function() {
    $("#mobile-blocks-servicestatus").html(\' <div class="block-heading-container">'. get_toggle_open('Service Status', 'icon-plus', 'open') .' <div id="block-servicestatus-mta-service-status" class="block-heading roundCorners featurebox open">\' + $(\'#block-servicestatus-mta-service-status\').html() + \'</div></div>\');
	
	$("#mobile-blocks-tripplanner").html(\' <div class="block-heading-container">'. get_toggle_open('TripPlanner', 'icon-plus') .'<div id="block-tripplanner-tripplanner" class="block-heading block block-tripplanner">\' + $(\'#block-tripplanner-tripplanner\').html() + \'</div></div>\');
	
	$("#mobile-blocks-rotaterimage").html(\'<div class="block-heading-container">'. get_toggle_open('Rotator' , 'icon-plus') .' <div id="block-views-news-rotator-block-1" class="block-heading block block-views contextual-links-region">\' + $(\'#block-views-news-rotator-block-1\').html() + \'</div></div>\');
	
	$("#mobile-blocks-traveltime").html(\'<div class="block-heading-container">'. get_toggle_open('Travel Time ', 'icon-plus') .' <div id="block-block-156" class="block-heading block block-block contextual-links-region">\' + $(\'#block-block-156\').html() + \'</div></div>\');
	
	$("#mobile-blocks-mymtaalerts").html(\'<div class="block-heading-container">'. get_toggle_open('MTA Alerts', 'icon-plus') .' <div id="block-block-1426" class="block-heading block block-block contextual-links-region">\' + $(\'#block-block-1426\').html() + \'</div></div>\');
	
	$("#mobile-blocks-appcenter").html(\'<div class="block-heading-container">'. get_toggle_open('App Center', 'icon-plus') .' <div id="block-block-381" class="block-heading block block-block contextual-links-region">\' + $(\'#block-block-381\').html() + \'</div></div>\');
	
	$( ".block-toogle-heading" ).click(function() {
	  $(this).next( ".block-heading" ).toggle("slow");
	  $(this).toggleClass("open");
	  $(this).find(".title").toggle();
	  
	  $(this).find(".toggle-sign").toggleClass("open");
	  $(this).find(".toggle-sign").find(".icon").toggleClass("icon-plus");
	  $(this).find(".toggle-sign").find(".icon").toggleClass("icon-minus");
	});
  });
});';
  drupal_add_js($js, 'inline');


}


function get_toggle_open($title, $class, $op = 'close'){
	if(!empty($op) && $op == 'open'){
		$output = '<div class="block-toogle-heading toogle-open"><div class="title">' . $title . ' </div><div class="toggle-sign open"><div class="icon icon-minus">&nbsp;</div></div></div>';
	} else {
		$output = '<div class="block-toogle-heading "><div class="title">' . $title . ' </div><div class="toggle-sign open"><div class="icon ' . $class . '">&nbsp;</div></div></div>';
	}
		
	

return $output;
	
}
//
