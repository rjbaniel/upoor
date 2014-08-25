<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
   <title>
<?php
if (is_home()) { echo bloginfo('name'); echo (' - '); bloginfo('description');}
elseif (is_404()) { bloginfo('name'); echo ' - Oops, this is a 404 page'; }
else if ( is_search() ) { bloginfo('name'); echo (' - Search Results');}
else { bloginfo('name'); echo (' - '); wp_title(''); }
?>
</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />

	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	
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
   <?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

<?php
    /*
    You can uncomment the below lines, which will give you a function to call for
    a comment preview IF you're not using the Live Preview: Admin Panel, Comments
    plug-in by Chris Davis, on which the code is based but modified from for my purposes
    Also, you'll need to uncomment a bunch of stuff in comments.php
    */
    // $javascript = "<script type=\"text/javascript\">\n<!--\nfunction ReloadTextDiv()\n{\nvar NewText = document.getElementById(\"comment\").value;\nsplitText = NewText.split(/\\n/).join(\"<br />\");\nvar DivElement = document.getElementById(\"TextDisplay\");\nDivElement.innerHTML = splitText;\n}\n//-->\n</script>\n";
    // echo $javascript;
?>
<script language="JavaScript" type="text/javascript">
<!--
// this is to open photo galleries
function openGallery(url) {
 window.open(url,'gallery','width=640,height=480, screenX=100,screenY=100,top=100,left=100,menubar=no,scrollbars=yes,resizable=yes,status=no,toolbar=no,location=no');
}
//-->
</script>

<?php /*
You can uncomment these two lines to enable buttons quicktags on the comment form
IF you're not using Owen Winkler's quicktags plugin <http://www.asymptomatic.net/wp-hacks>,
on which the buttons.js code is based, but slightly modified from

ob_start();
get_template_directory_uri();
$temp = ob_get_contents();
ob_end_clean();

print(
	 '<script src="'.get_option('siteurl').'/wp-admin/quicktags.js" type="text/javascript"></script>'."\n"
	.'<script src="'.$temp.'/buttons.js" type="text/javascript"></script>'."\n"
);
*/ ?>

</head>

<?php
// if you want to insert line breaks between words in the blog's title...
// doing this means you're going to have to adjust the #header field
// in style.css
//$wpTitle = get_option('blogname');
//$formatedWpTitle = str_replace(' ','<br />',$wpTitle)

// if you don't want line breaks in your title, comment out the above two lines
// and uncomment this line
$formatedWpTitle = get_option('blogname');
?>

<body id="custom">

<div id="header">

<?php if(get_header_textcolor() != 'blank') { ?>
<h1><a href="<?php bloginfo('url'); ?>"><?php echo $formatedWpTitle ?></a><br />
<small><?php bloginfo('description'); ?></small></h1>
<?php } ?>


</div>


<div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<?php if ( has_nav_menu( 'main-nav' ) ) { ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } ?>
<?php } else { ?>
<ul id="nav">
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?>
</div>
