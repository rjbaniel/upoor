<?php if (!is_search()) {$search_text = "search here";} else {$search_text = "$s";} ?><form method="get" id="searchform" action="<?php bloginfo('url'); ?>"><p><input type="text" value="<?php echo esc_html($search_text, 1); ?>" name="s" id="s" onfocus="if (this.value == 'search here') {this.value = '';}" onblur="if (this.value == '') {this.value = 'search here';}" /><input type="submit" id="searchsubmit" value="<?php _e("Go",TEMPLATE_DOMAIN); ?>" /></p></form>



