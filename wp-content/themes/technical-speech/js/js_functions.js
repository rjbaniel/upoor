/* <![CDATA[ */
jQuery(document).ready(function($) 
{	
	$('.widgetbox2 li>a').hover(function(){
	$(this).parent().css('background-color','#CCC');
  	},function(){
    $(this).parent().css('background-color','');
  	});
	
	 function view_widsub() {
	 	$(this).children('ul').slideDown('medium');
     }
	 function hide_widsub() {
	 	$(this).children('ul').slideUp('medium');
     }
	 
	 function view_topsub() {
		if ($(this).children('ul').outerHeight() < 200 ){
		  $(this).children('ul').css('height','200px');
		  $(this).children('ul').css('border-bottom','1px solid #333');
	    }
		$(this).children('ul').slideDown('fast');
		$top_val = ($(this).outerHeight()) - 4;
	    $left_val = '0px';
	    $(this).children('ul').css('top',$top_val);
	    $(this).children('ul').css('left',$left_val);
		$(this).find('>a').css('background-color','#CCC');
		
     }
	 function hide_topsub() {
	 	$(this).children('ul').slideUp('fast');
		$(this).find('>a').css('background-color','');
     }
	 
	 function view_topsubchild() {
	    if ($(this).children('ul').outerHeight() < 200 ){
			$(this).children('ul').css('height','200px');
			$(this).children('ul').css('border-bottom','1px solid #333');
	  	}
	  	$(this).children('ul').slideDown('fast');
	  	$top_val2 = (-5);
	  	$left_val2 = $(this).outerWidth() - ($(this).outerWidth()/4);
	  	$(this).children('ul').css('top',$top_val2);
	  	$(this).children('ul').css('left',$left_val2);
		$(this).find('>a').css('background-color','#CCC');
   	 }
   
   	function hide_topsubchild() {
		$(this).children('ul').slideUp('fast');
		$(this).find('>a').css('background-color','');
   	}
	 
	 var widgetsubmenu = {    
     	interval: 100,
     	sensitivity: 4,
	 	over: view_widsub,
	 	timeout: 200,
     	out: hide_widsub
     };
	 
	 var topsubmenu = {    
     	interval: 200,
     	sensitivity: 4,
	 	over: view_topsub,
	 	timeout: 200,
     	out: hide_topsub
     };
	 
	 var topsubchild = {    
     	interval: 100,
     	sensitivity: 4,
	 	over: view_topsubchild,
	 	timeout: 200,
     	out: hide_topsubchild
     };
	 
	$(".widgetbox ul>li:has(ul)").hoverIntent(widgetsubmenu);
	$("#nav>ul>li:has(ul)").hoverIntent(topsubmenu);
	$("#nav>ul>li>ul li:has(ul)").hoverIntent(topsubchild);
	
	$heighpop = $('#pop_border').outerHeight();
	$heighrcp = $('#rcp_border').outerHeight();
	if($heighpop != 0){ $('#pop_border .postblock').css('height', $heighpop); }
	if($heighrcp != 0){ $('#rcp_border .postblock').css('height', $heighrcp); }
	
	$heighsidebar = $('#sidebar').outerHeight();
	$heighcon = $('#content').outerHeight();
	if ($heighsidebar != 0 && $heighcon != 0){
		if ($heighcon < $heighsidebar) {
			$('#content').css('height',$heighsidebar);
		}
	}
	
	$('#headsearch img').click(function(){$('#headsearch form').submit();});
	$('#side_search a').click(function(){$('#side_search form').submit();});
	$('#searchform_onpage a').click(function(){$('#searchform_onpage form').submit();});
	
});
/* ]]> */