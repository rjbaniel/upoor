$(document).ready(function() {
	var $window = $(window);
	var $children = $("#home-content").children("section");
	$window.resize(function() {
		for (var i = 0; i < $children.size(); i++) {
			var $uchild = $children.eq(i);
			$uchild.show();
			$uchild.find("div").children().show();
		}
		for (var i = 0; i < $children.size(); i++) {
			var $child = $children.eq(i);
			if ($child.innerHeight() < $child[0].scrollHeight || $child.innerWidth() < $child[0].scrollWidth) {
				$child.find("div").children().eq(2).hide();
			}
			if ($child.innerHeight() < $child[0].scrollHeight || $child.innerWidth() < $child[0].scrollWidth) {
				$child.find("div").children().eq(1).hide();
			}
		}
	});
});

