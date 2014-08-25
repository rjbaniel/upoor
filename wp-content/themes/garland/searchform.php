<script type="text/javascript">
function clickclear(thisfield, defaulttext) {  
	if (thisfield.value == defaulttext) {
    thisfield.value = "";
	}
	}
function clickrecall(thisfield, defaulttext) {
  if (thisfield.value == "") {
  thisfield.value = defaulttext;
  }
  }
  </script>
  <form method="get" id="searchform" action="<?php echo home_url('/'); ?>">
  <div>
  <input type="text" id="s" name="s" size="25" value="Start your search ..." onclick="clickclear(this, 'Start your search ...')" onblur="clickrecall(this,'Start your search ...')" />
  </div>
  </form>
