<?php 	/* Widgetized sidebar, if you have the plugin installed. */

		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

        

    	<div class="module">

        	<div class="top"></div>

            <span class="title"><?php _e('Recent Comments', 'cellar-heat'); ?></span>

        	<ul>

            <?php dp_recent_comments(6); ?>

            </ul>

        </div>

        <div class="module-mid">

        	<div class="top"></div>

            <span class="title"><?php _e('Categories', 'cellar-heat'); ?></span>

        	<ul>

            <?php wp_list_categories('sort_column=name&hierarchical=0&title_li='); ?>

            </ul>

        </div>

        <div class="module-end">

        	<div class="top"></div>

            <span class="title"><?php _e('Blogroll', 'cellar-heat'); ?></span>

        	<ul>

           <?php wp_list_bookmarks('title_li=&categorize=0&show_images=0&show_description=0&orderby=id'); ?>


            </ul>

        </div>

        <?php endif; ?>

		<br clear="all" />
