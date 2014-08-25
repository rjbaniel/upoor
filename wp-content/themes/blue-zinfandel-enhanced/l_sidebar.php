<!-- begin l_sidebar -->





	<div id="l_sidebar">


	<ul id="l_sidebarwidgeted">



	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>


	







	<li id="Categories">


	<h2><?php _e('Categories', 'blue-zinfandel');?></h2>


		<ul>


		<?php wp_list_categories('sort_column=name'); ?>


		</ul>

            </li>
		


	<li id="Archives">


	<h2><?php _e('Archives', 'blue-zinfandel');?></h2>


		<ul>


		<?php wp_get_archives('type=monthly'); ?>


		</ul>


		           </li>


	<li id="Blogroll">


	<h2><?php _e('Blogroll', 'blue-zinfandel');?></h2>


		<ul>


		<?php get_bookmarks(-1, '<li>', '</li>', ' - '); ?>


		</ul>


		
                    </li>

	<li id="Admin">


	<h2><?php _e('Admin', 'blue-zinfandel');?></h2>


		<ul>


		<?php wp_register(); ?>


		<li><?php wp_loginout(); ?></li>


		<?php wp_meta(); ?>

             

		</ul>

                   </li>
		


	<h2><?php ('Search');?></h2>


	   	<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">


		<input type="text" name="s" id="s" size="30" value=<?php _e("search this site...", 'blue-zinfandel'); ?> /></form>


		


		<?php endif; ?>


		</ul>


			


</div>





<!-- end l_sidebar -->
