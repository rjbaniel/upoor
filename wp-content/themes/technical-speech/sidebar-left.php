				<div id="leftsidebar">
					<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('left') ) : ?>
					<div class="widgetbox">
						<div class="boxheading"><span><?php _e('Categories', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>
						<div class="widgetwrap">
							<ul>
								<?php wp_list_categories('title_li='); ?>
							</ul>
						</div>
					</div>
					<div class="widgetbox">
						<div class="boxheading"><span><?php _e('Archives', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>
						<div class="widgetwrap">
							<ul>
								<?php wp_get_archives('type=monthly'); ?>
							</ul>
						</div>
					</div>
					<?php endif; ?>
				</div>
