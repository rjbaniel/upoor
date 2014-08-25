<div id="sidebar">

		<form action="<?php bloginfo('url') ?>" method="get" id="search">
		<p><label for="s"><?php _e('search','regulus'); ?></label>
		<input value="" name="s" id="s" />
		<input type="submit" value="<?php _e('go!','regulus'); ?>" class="button" id="searchbutton" name="searchbutton" /></p>
		</form>
		
		<ul>
		
		<?php
		
			bm_writeAbout();
			
			// ---------------
			// add child pages
			// ---------------
			if ( is_page() ) {
			
			    //global $bm_pageID;
			    $bm_parentID = BX_top_parent_page();

			    $bm_pages		= wp_list_pages( 'sort_column=menu_order&depth=1&title_li=&echo=0&child_of=' . $bm_parentID );

			    if ( $bm_pages <> "" ) {
			        echo "<li>";
			        echo "<ul id=\"subpages\">\n";
			        echo "<li><h2>";
					_e('Sub Pages','regulus');
					echo "</h2></li>";
			        echo $bm_pages;
			        echo "</ul>";
					echo "</li>";
				}
			}

       		// -----------------
			// display admin bar
			// -----------------
			if( bm_getProperty( 'admin' ) == 1 ) {
				bm_admin_bar();
			}
				
			// -------
			// WIDGETS
			// -------
	
			if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) { } else {
			
				// ----------------
				// display calendar
				// ----------------
				if( bm_getProperty( 'calendar' ) == 1 ) {

					bm_calendar();

				}

			echo "<li>";
			
	   			// --------------------
				// display recent posts
	   			// --------------------
				if( bm_getProperty( 'posts' ) == 1 ) { ?>
			<h2><?php _e('Recent Posts','regulus'); ?></h2>
			<ul>
			<?php wp_get_archives('type=postbypost&limit=10'); ?>
			</ul>
			<?php

			    }

				// ---------------
				// recent comments
	   			// ---------------
				if (function_exists('get_recent_comments')) { ?>
	   		<h2><?php _e('Recent Comments:','regulus'); ?></h2>
	        <ul>
	        <?php get_recent_comments(); ?>
	        </ul>

			<?php } ?>


			<div class="col">

				<h2><?php _e('Categories','regulus'); ?></h2>
				<ul>
				<?php //wp_list_categories(0, '', 'name', 'asc', '', 1, 0, 0, 1, 1, 1, 0,'','','','','');

				wp_list_categories( 'hierarchical=1' ); ?>
				</ul>

				<h2><?php _e('Archive','regulus'); ?></h2>
				<ul>
				<?php

				if( bm_getProperty( 'months' ) == 1 ) {
	   				wp_get_archives('type=monthly');
				} else {
					wp_get_archives('type=monthly&limit=15');
		  		}

				?>
				</ul>

			</div>

			<div class="col">

				<?php

				    if ( bm_getProperty( 'linkcat' ) == 1 ) {

						echo "<ul id=\"blogroll\">";
						wp_list_bookmarks();
						echo "</ul>";

					} else {

						echo "<h2>";
						_e('Blog Roll');
						echo "</h2>";

						echo "<ul id=\"blogroll\">";
						get_bookmarks( -1, '<li>', '</li>', '<br />', FALSE, 'rand', FALSE, FALSE, -1, FALSE );
						echo "</ul>";

					}

				?>

			</div>
			
			</li>

			<?php if( bm_getProperty( 'meta' ) == 1 ) { ?>

			<li>
			<h2><?php _e('Meta','regulus'); ?></h2>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<li><a href="http://validator.w3.org/check/referer" title="<?php _e('This page validates as XHTML 1.0 Transitional','regulus'); ?>"><?php _e('Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>','regulus'); ?></a></li>
				<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
				<?php wp_meta(); ?>
			</ul>
			</li>

		<?php
			
				}
			}

			?>
			
  		</ul>

		<ul id="feeds">
		<li><h3><?php _e('Feeds','regulus'); ?></h3></li>
		<li><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Full','regulus'); ?></a></li>
		<li><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments','regulus'); ?></a></li>
		</ul>
		
</div>
