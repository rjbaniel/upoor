<?php
  
  // widgetised by will docherty.
  // thanks will. -eston (9 october 2007)

?>

<div id="sidebar">
	
	<?php if(get_option('gridlock_about_blurb') != '') { ?>
  <img id="about" src="<?php bloginfo('stylesheet_directory'); ?>/images/about.gif" alt="<?php _e("about the author",TEMPLATE_DOMAIN); ?>" />

	<div id="aboutAuthor">

    <p><?php echo(wptexturize(stripslashes(get_option('gridlock_about_blurb')))); ?>
		
		<?php if(get_option('gridlock_about_slug') != '') { ?>
		<a href="<?php bloginfo('url'); ?>/<?php echo(get_option('gridlock_about_slug')); ?>"><?php _e("read more&hellip;",TEMPLATE_DOMAIN); ?></a></p>
		<?php } ?>
		
  </div> 
	<?php } ?>

  <ul>

<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()) : ?>


      <li><h2><?php _e("Pages",TEMPLATE_DOMAIN); ?></h2>
        <ul><li>
           <?php wp_list_pages('title_li=&depth=1'); ?>
        </li></ul>
		</li>



    <li><h2><?php _e("Categories",TEMPLATE_DOMAIN); ?></h2>
        <ul><li>
            <?php wp_list_categories('orderby=name&title_li=&style=list'); ?>
        </li></ul>
		</li>
        
		<?php 
			// Detect links to maintain XHTML validity in case no links exist.
			// Fehler-Bericht von Florian Holzhauer (fholzhauer.de). Danke sehr, Florian.
			
			if(get_bookmarks('-1', '<li>', '</li>', '<br />', FALSE, 'name', FALSE, FALSE, -1, FALSE, FALSE)) {
		?>
    <li><h2><?php _e("Links",TEMPLATE_DOMAIN); ?></h2>
           <ul>
				<?php get_bookmarks('-1', '<li>', '</li>', '<br />', FALSE, 'name', FALSE); ?>
           </ul>
		</li>
		<?php } ?>
        
        
        <li><h2><?php _e("Meta",TEMPLATE_DOMAIN); ?></h2>
        <ul>
            <li><?php wp_loginout(); ?></li>

			<?php if(get_option('gridlock_disable_sifr') == 'false') { ?>
            <li><a href="http://www.mikeindustries.com/sifr/" title="Scalable Inman Flash Replacement">sIFR</a> Rich Typography</li>
			<?php } ?>


            <?php wp_meta(); ?>
        </ul>
        </li>
<?php endif; // end widgetised sidebar. ?>

    </ul>

</div>
