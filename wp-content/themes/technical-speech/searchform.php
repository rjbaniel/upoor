						<div class="s_wrap" id="searchform_onpage">
							<form method="get" action="<?php bloginfo('url')?>" >
								<input name="s" type="text" value="<?php echo isset($s)?esc_html($s, 1):''; ?>"/>
								<a href="#"><?php _e('Search', 'technical-speech'); ?></a>
								<div class="clear"></div>
							</form>
						</div>
