

	<div id="sidebar">



	<div id="sidebar-left">

			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
					
<div class="tabshow1-t"></div>
<div class="contentlist1">
<h2>Meta</h2>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
					<?php wp_meta(); ?>
				</ul>
</div>
<div class="tabshow1-b"></div>

<?php endif; ?>


	</div>

	</div>
