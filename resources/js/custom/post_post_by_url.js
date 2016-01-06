$(document).ready(function() {
    $(".get-share-link-panel").find("input:text").focus(function() { $(this).select(); } );

    $(document).on("click",".share-link", function(e) {
		e.preventDefault();
		if($(this).hasClass("active"))
		{
			$(this).removeClass("active");
			 $(".get-share-link-panel").hide();
		}
		else
		{
			$(this).addClass("active");
			 $(".get-share-link-panel").show();
			 selectAllText($(".get-share-link-panel").find("input:text"))
		}
		 

	})


});


function selectAllText(textbox) {
textbox.focus();
textbox.select(); }