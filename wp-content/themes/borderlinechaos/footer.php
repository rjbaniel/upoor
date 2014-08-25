	</div>



<div id="footer">
<br />
<?php if( SHOW_AUTHORS != 'false') { ?>
<br />This theme started out as <A class="footerLink" href="http://www.thoughtmechanics.com/blog/templates">Benevolence</A><br /> and ended up as  <a class="footerLink" href="http://theloo.org/2005/03/06/borderline-chaos/">Borderline Chaos (1.9)</a>. <br />
<?php } ?>
<a class="footerLink" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a> is &copy; the Author.&nbsp;&nbsp;&nbsp;Care to <?php wp_loginout(); ?>?

<br /><?php _e('Syndicate entries using');?> <a class="footerLink" href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?> ">

   <?php _e('<abbr title="Really Simple Syndication">RSS (Posts)</abbr>'); ?></a> or <a class="footerLink" href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('RSS (Comments)')?></a><a target=_blank href="">.</a>



<br />

<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
&nbsp;&nbsp;&nbsp;<?php _e('Hosted by', 'borderline'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>

<br />
<?php wp_footer(); ?>
</div>



</div>



</body>

</html>

