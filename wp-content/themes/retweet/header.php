<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php $the_title = wp_title(' - ', false); if ($the_title != '') : ?>
<title><?php echo wp_title('',false); ?> | <?php bloginfo('name'); ?></title>
<?php else : ?>
<title><?php bloginfo('name'); ?></title>
<?php endif; ?>
<?php $options = get_option('classic_options'); ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php if($options['retweet_design_switch']=='custom'): ?>
<style type="text/css" media="screen" >
body {background-image:url(<?php echo($options['retweet_design_background']); ?>);<?php if($options['retweet_design_background_tile']) : ?>background-repeat:repeat;background-attachment:scroll;<?php endif; ?>background-color:#<?php echo($options['retweet_design_bgcolor']); ?>;}
body,ul.top-navigation li.current_page_item a,#side h2, #side h3 {color:#<?php echo($options['retweet_design_text']); ?>;}
a, #logo .description {color:#<?php echo($options['retweet_design_links']); ?>;}
#logo h1 a {text-decoration:none;border-bottom:1px solid #<?php echo($options['retweet_design_links']); ?>;}
#side_base {background-color:#<?php echo($options['retweet_design_sidebar']); ?>;border-left:1px solid #<?php echo($options['retweet_design_sidebarborder']); ?>;}
#side h2, #side h3 {border-bottom:1px solid #<?php echo($options['retweet_design_sidebarborder']); ?>;}
</style>
<?php else: ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/main<?php echo($options['retweet_design_switch']); ?>.css" type="text/css" media="screen" />
<?php endif;?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" type="text/css" media="screen" />
<?php if($options['retweet_round_border']) : ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/round_border.css" type="text/css" media="screen" />
<?php endif; ?>
<style type="text/css" media="screen" >
<?php if($options['retweet_logo']==true):?>
#logo h1 a{text-align:left;text-indent:-9999px;width:155px;height:36px;background:url(<?php bloginfo('template_directory'); ?>/images/logo.png) no-repeat;display:block;border-bottom:0;}
#logo .description{display:none;}
<?php endif;?>
<?php if($_COOKIE['wide_container']=='0'): ?>
<?php elseif($_COOKIE['wide_container']=='1'): ?>
#container{width:880px;}
#content{width:680px;}
#profiletext{width:610px;}
<?php else: ?>
<?php if($options['retweet_wide']==true):?>
#container{width:880px;}
#content{width:680px;}
#profiletext{width:610px;}
<?php endif;?>
<?php endif;?>
</style>
<?php if (is_home()){
    $description = $options['retweet_description'];
} elseif (is_single()){
    if ($post->post_excerpt) {
        $description     = $post->post_excerpt;
    } else {
        $description = substr(strip_tags($post->post_content),0,220);
    }
}
?>
<meta name="description" content="<?php echo $description; ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php if($options['retweet_rss']) : ?><?php echo($options['retweet_rss']); ?><?php else: ?><?php bloginfo('rss2_url'); ?><?php endif; ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!-- favicon.ico location -->
<?php if(file_exists( WP_CONTENT_DIR . '/favicon.ico')) { //put your favicon.ico inside wp-content/ ?>
<link rel="icon" href="<?php echo WP_CONTENT_URL; ?>/favicon.ico" type="images/x-icon" />
<?php } elseif(file_exists( WP_CONTENT_DIR . '/favicon.png')) { //put your favicon.png inside wp-content/ ?>
<link rel="icon" href="<?php echo WP_CONTENT_URL; ?>/favicon.png" type="images/x-icon" />
<?php } elseif(file_exists( TEMPLATEPATH . '/favicon.ico')) { ?>
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="images/x-icon" />
<?php } elseif(file_exists( TEMPLATEPATH . '/favicon.png')) { ?>
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" type="images/x-icon" />
<?php } ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body id="custom" class="<?php if ((is_home()) && !(is_archive()) or (is_search()) or (is_date()) or (is_author()) or (is_tag()) or (is_category())) { ?>home<?php } else { ?>page<?php } ?>">
<div id="container" class="subpage">
<div id="header">
	<div id="logo">
		<h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>
		<div class="description"><?php bloginfo('description'); ?></div>
	</div>



   <div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="nav">

<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
<li>
<?php if(isset($_COOKIE['wide_container']) && $_COOKIE['wide_container']=='1'):?>
	<a href="#" class="wide-container" style="display:none;" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Wide', 'retweet') ?>"><?php _e('Wide', 'retweet') ?></a>
	<a href="#" class="normal-container" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Normal', 'retweet') ?>"><?php _e('Normal', 'retweet') ?></a>
<?php elseif(isset($_COOKIE['wide_container']) && $_COOKIE['wide_container']=='0'): ?>
	<a href="#" class="wide-container" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Wide', 'retweet') ?>"><?php _e('Wide', 'retweet') ?></a>
	<a href="#" class="normal-container" style="display:none;" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Normal', 'retweet') ?>"><?php _e('Normal', 'retweet') ?></a>
<?php else: ?>
<?php if($options['retweet_wide']==false):?>
	<a href="#" class="wide-container" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Wide', 'retweet') ?>"><?php _e('Wide', 'retweet') ?></a>
	<a href="#" class="normal-container" style="display:none;" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Normal', 'retweet') ?>"><?php _e('Normal', 'retweet') ?></a>
<?php else: ?>
	<a href="#" class="wide-container" style="display:none;" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Wide', 'retweet') ?>"><?php _e('Wide', 'retweet') ?></a>
	<a href="#" class="normal-container" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Normal', 'retweet') ?>"><?php _e('Normal', 'retweet') ?></a>
<?php endif;?>
<?php endif;?>
</li>
</ul>
<?php } else { ?>
<ul id="nav">
<?php wp_list_pages('title_li=&depth=1'); ?>
<li>
<?php if($_COOKIE['wide_container']=='1'):?>
	<a href="#" class="wide-container" style="display:none;" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Wide', 'retweet') ?>"><?php _e('Wide', 'retweet') ?></a>
	<a href="#" class="normal-container" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Normal', 'retweet') ?>"><?php _e('Normal', 'retweet') ?></a>
<?php elseif($_COOKIE['wide_container']=='0'): ?>
	<a href="#" class="wide-container" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Wide', 'retweet') ?>"><?php _e('Wide', 'retweet') ?></a>
	<a href="#" class="normal-container" style="display:none;" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Normal', 'retweet') ?>"><?php _e('Normal', 'retweet') ?></a>
<?php else: ?>
<?php if($options['retweet_wide']==false):?>
	<a href="#" class="wide-container" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Wide', 'retweet') ?>"><?php _e('Wide', 'retweet') ?></a>
	<a href="#" class="normal-container" style="display:none;" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Normal', 'retweet') ?>"><?php _e('Normal', 'retweet') ?></a>
<?php else: ?>
	<a href="#" class="wide-container" style="display:none;" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Wide', 'retweet') ?>"><?php _e('Wide', 'retweet') ?></a>
	<a href="#" class="normal-container" title="<?php _e('Switch to ', 'retweet') ?><?php _e('Normal', 'retweet') ?>"><?php _e('Normal', 'retweet') ?></a>
<?php endif;?>
<?php endif;?>
</li>
</ul>
<?php } ?>
</div>




</div>
<?php if (!(is_single() || is_page() || is_attachment()) ) { ?> 
<?php include (TEMPLATEPATH . '/profilebox.php'); ?>
<?php } ?>
<div class="content-bubble-arrow"></div>
