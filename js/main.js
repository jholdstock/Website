var setWindow = function(url) {
	$.get(url, function(data) {
		$("#window").html(data);
	});
}

var highlightTab = function(currentAnchor) {
	$("#menu a").each(function(index, anchor)
	{
		$(anchor).removeClass("current");
	});
	$(currentAnchor).addClass("current");
}

$(document).on("click", "#menu a", function(e) {
	e.preventDefault();
    highlightTab(e.currentTarget);
    setWindow(e.currentTarget.href);
});

setWindow("about.php");