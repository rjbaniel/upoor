<?php
/*
Template Name: Tag Search
*/
?>
<?php get_header(); ?>

<div id="content" class="narrowcolumn">
<div id="center">


	<!-- If you enter text in the page,  and include this block; it will display at the top of the page.  This is optional, but useful! -->
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
			<div class="dateline"></div><h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>

			<div class="entry">
				<?php the_content(__('Read the rest of this entry &raquo;',TEMPLATE_DOMAIN)); ?>
			</div>

			<?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), '',''); ?><?php comments_popup_link(__('No Comments &#187;',TEMPLATE_DOMAIN), __('1 Comment &#187;',TEMPLATE_DOMAIN), __('% Comments &#187;',TEMPLATE_DOMAIN)); ?><br />
	<?php endwhile; ?>
	<?php endif; ?>
	<!-- This is the end of the page text block -->

<!-- Style stuff as you see fit! -->
<style type="text/css">
#matches {padding-left:50px;}
</style>

<!-- You need this block of javascript -->
<script language="javascript">
var ajaxUrl = "../wp-content/plugins/UltimateTagWarrior/ultimate-tag-warrior-ajax.php";

function createRequestObject() {
    var ro;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
        ro = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        ro = new XMLHttpRequest();
    }
    return ro;
}

var searchTags = new Array();

function searchFor(item,tagid,related) {
	http = createRequestObject();

	if (tagid != '' && indexOf(searchTags, item) != -1) {
		searchTags.splice(indexOf(searchTags, item), 1);
		document.getElementById('tag_' + tagid).style.fontWeight="normal";
		document.getElementById('tag_' + tagid).style.border="none";

		related += ',' + tagid;

		relatedids = related.split(',');
		for (i = 0; i < relatedids.length; i++) {
			if (relatedids[i] != "") {
				currentsize = document.getElementById('tag_' + relatedids[i]).style.fontSize;

				if (currentsize == "") {
					document.getElementById('tag_' + relatedids[i]).style.fontSize = "12px";
				} else {
					currentint = currentsize.substring(0, currentsize.length - 2) * 1;
					currentint-= 8;
					document.getElementById('tag_' + relatedids[i]).style.fontSize = currentint + "px";
				}
			}
		}

	} else if (tagid != '') {
		searchTags[searchTags.length] = item;
		document.getElementById('tag_' + tagid).style.fontWeight="bolder";
		document.getElementById('tag_' + tagid).style.border="1px solid #ccc";

		related += ',' + tagid;
		relatedids = related.split(',');
		for (i = 0; i < relatedids.length; i++) {
			if (relatedids[i] != "") {
				currentsize = document.getElementById('tag_' + relatedids[i]).style.fontSize;

				if (currentsize == "") {
					document.getElementById('tag_' + relatedids[i]).style.fontSize = "18px";
				} else {
					currentint = currentsize.substring(0, currentsize.length - 2) * 1;
					currentint+= 8;
					document.getElementById('tag_' + relatedids[i]).style.fontSize = currentint + "px";
				}
			}
		}
	}

	searchtype = "any";
	for(i = 0; i < document.forms['searchselector'].elements['searchtype'].length; i++) {

		if (document.forms['searchselector'].elements['searchtype'][i].checked) {
			searchtype = document.forms['searchselector'].elements['searchtype'][i].value;
		}
	}

    http.open('get', ajaxUrl+'?action=tagSearch&tag='+serialiseTags()+'&type='+searchtype);
    http.onreadystatechange = handleSearchResponse;
    http.send(null);
}

function handleSearchResponse() {
    if(http.readyState == 4){
        var response = http.responseText;
        var update = new Array();

        document.getElementById("matches").innerHTML = response;
    }
}

function serialiseTags() {
	var tags = "";
	for (i = 0; i < searchTags.length; i++) {
		tags += searchTags[i] + "|";
	}
	return tags;
}

function indexOf(array, item) {
	for (i = 0; i < array.length; i++) {
		if (array[i] == item) {
			return i;
		}
	}

	return -1;
}

</script>
</div>
<div class="halfpostleft">
<h2 class="posttitle">Select Tags</h2><br />
<!-- You need to include this form.  It has the any/all radio buttons -->
<form name="searchselector">
<input type="radio" name="searchtype" value="all" id="all" onchange="searchFor('','','')"/> <label for="all"><?php _e("All of the Selected Tags",TEMPLATE_DOMAIN); ?></label>
<input type="radio" name="searchtype" value="any" id="any"  onchange="searchFor('','','')" checked/> <label for="any"><?php _e("Any of the Selected Tags",TEMPLATE_DOMAIN); ?></label><br />
</form>
<!-- This is the end of the form -->
<!-- This is the list of tags -->
<?php UTW_ShowWeightedTagSetAlphabetical("", array('default'=>'<a id="tag_%tagid%" href="javascript:searchFor(\'%tag%\', \'%tagid%\', \'%relatedtagids%\')" style=\'font-size:12px; border:none\'>%tagdisplay%</a> | '), 0) ?>
<!-- End of the list of tags.. -->
</div>
<div class="halfpostright">
<h2 class="posttitle"><?php _e("Matching Posts",TEMPLATE_DOMAIN); ?></h2><br />
<!-- You need to include this div.  It's where the matching posts will display -->
<div id="matches"></div>
<!-- End of the matching posts -->
</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
