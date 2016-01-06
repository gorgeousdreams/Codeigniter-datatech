$(".post-tags").select2({
	tags: true,
	tokenSeparators: [',', ' ']
});

$(".dashboard-tags").select2({
	tags: true,
	tokenSeparators: [',', ' ']
});

$(".user-dropdown").select2();

$( ".accordion" ).accordion({
      collapsible: true,
      active: false,
});

$(document).ready(function(){
	
	// if($(".category").val() != "")
	// {
	// 	get_topics();
	// }

	// if($(".dashboard-category").val() != "")
	// {
	// 	dashboard_topics();
	// }


	$(".add_topic").on("click",function(){

		var cat = $(".extra_topics").val();
		
		if(cat.trim() == "")
		{
			alert("Topic field can not be empty!");
			return false;
		}
		var new_cat = '<input class="topics" type="checkbox" name="topics[]"  value="'+cat+'" checked><label class="topics_label">'+cat+'</label>';
		// console.log(new_cat);
		if($(".topics_label").length)
		{
			$(".topics_label:last").after(new_cat);
		}
		else
		{
			$(".add-new-topic-div").before(new_cat);
		}
		$(".extra_topics").val("");
	});

});


$(document).on("click",".save-area-of-interest", function(){
	if($('.area-of-interest-topics:checked').length < 10 )
	{
		alert("Please Choose atlest 10 topics.");
		return false;
	}
});

$(".category").on("change",function(){

	$(".topics-parent-div").show();

	if((".topics").length)
	{
		$(".topics").remove();
	}
	var category_id = $(this).val();
	$.ajax({
		url:BASE_URL+"topic/ajax_get_topics_by_category_id",
		type:"post",
		dataType:"json",
		data:{category_id:category_id},
		success:function(data){


			if(data.success)
			{
				var html ="<div class='topics'>";

				$.each(data.data, function(i,v){
					html += "<input type='checkbox' name='topics[]'  value='"+v.topic+"'><label class='topics_label'>"+v.topic+"</label>";
				});
				html += "</div>";

				$(".add-new-topic-div").before(html);
			}
		}
	});
});

$(".category_for_edit").on("change",function(){

	$(".topics-parent-div-edit").hide();
	$(".topics-parent-div").show();

	if((".topics").length)
	{
		$(".topics").remove();
	}
	var category_id = $(this).val();
	$.ajax({
		url:BASE_URL+"topic/ajax_get_topics_by_category_id",
		type:"post",
		dataType:"json",
		data:{category_id:category_id},
		success:function(data){


			if(data.success)
			{
				var html ="<div class='topics'>";

				$.each(data.data, function(i,v){
					html += "<input type='checkbox' name='topics[]'  value='"+v.topic+"'><label class='topics_label'>"+v.topic+"</label>";
				});
				html += "</div>";

				$(".add-new-topic-div").before(html);
			}
		}
	});
});


function get_topics()
{
	$(".topics-parent-div").show();

	if((".topics").length)
	{
		$(".topics").remove();
	}
	var category_id = $(".category").val();
	$.ajax({
		url:BASE_URL+"topic/ajax_get_topics_by_category_id",
		type:"post",
		dataType:"json",
		data:{category_id:category_id},
		success:function(data){


			if(data.success)
			{
				var html ="<div class='topics'>";

				$.each(data.data, function(i,v){
					html += "<input type='checkbox' name='topics[]'  value='"+v.topic+"'><label class='topics_label'>"+v.topic+"</label>";
				});
				html += "</div>";

				$(".add-new-topic-div").before(html);
			}
		}
	});
}
$(".dashboard-category").on("change",function(){

	$(".dashboard-topics").html('<option value="">Select Topics</option>');
	var category_id = $(this).val();
	$.ajax({
		url:BASE_URL+"topic/ajax_get_topics_by_category_id",
		type:"post",
		dataType:"json",
		data:{category_id:category_id},
		success:function(data)
		{
			if(data.success)
			{
				var html = "";

				$.each(data.data, function(i,v){

					html += "<option value='"+v.id+"'>"+v.topic+"</option>";

				});

				$(".dashboard-topics").append(html);
			}
		}
	});
});

function dashboard_topics()
{

	$(".dashboard-topics").html('<option value="">Select Topics</option>');
	var category_id = $(".dashboard-category").val();
	$.ajax({
		url:BASE_URL+"topic/ajax_get_topics_by_category_id",
		type:"post",
		dataType:"json",
		data:{category_id:category_id},
		success:function(data)
		{
			if(data.success)
			{
				var html = "";

				$.each(data.data, function(i,v){

					html += "<option value='"+v.id+"'>"+v.topic+"</option>";

				});

				$(".dashboard-topics").append(html);
			}
		}
	});
}

$(".comment").on("click", function(){
	$(".error-empty-comment-div").hide();
});

$(".post-comment").on("click", function(){

	var _this = $(this);
	var post_id = $(this).siblings(".post-id").val();
	var comment = $(this).siblings(".comment").val().trim();
	var user_id = $(this).siblings(".user-id").val();
	if(comment == "")
	{
		$(".error-empty-comment-div").show();
		return false;
	}
	var does_post_question = $(this).siblings(".post-id").attr('data-is-question');
	var created_by = $(this).siblings(".created-by").attr('data-session-id');
	var session_id = $(this).siblings(".created-by").val();
	
	$.ajax({
		url:BASE_URL+"post/ajax_add_comment",
		type:"post",
		dataType:"json",
		data:{user_id:user_id, comment:comment,post_id:post_id},
		success:function(data)
		{	
			if(created_by == session_id)
			{
				var checkbox_display = (does_post_question == 3) ? " <input type='checkbox' name='is_answer' class='check_comment' data-comment-id="+data.comment_id+">" : " ";
			}
			else
			{
				var checkbox_display = "";
			}
			var comment_append   = "<div class='comment_display_div'>"+checkbox_display+"<span class='commented-by'> "+data.user+" :</span><span class='comment-by-user'> "+data.comment+"</span> <span class='ago'>" +data.created_on+" ago</span></div>";
			
			$(_this).siblings(".comment_display_div:First").before(comment_append)
			$(_this).siblings(".comment").val('');
		}
	});

});


$(".send-message").on("click",function(){

	var message = $(".message-textarea").val();
	if( message.trim() == "")
	{
		$(".error-div").show();
		return false;
	}
});

$(".message-textarea").on("keypress",function(){
	$(".error-div").hide();
});


/* vote/devote */

$(".vote").on("click",function(){

	var post_id = $(this).attr("data-post-id");
	if($(this).attr("data-type") == "vote")
	{
		var status = "vote";
	}
	else if($(this).attr("data-type") == "devote")
	{
		var status = "devote";
	}

	$.ajax({
		
		url:BASE_URL+"post/vote_post_by_id/"+post_id+"?vote="+status,
		type:"post",
		dataType:"json",
		success:function(data)
		{	
			if(data.success)
			{
				$(".voted-count").html(data.data.voted);
				$(".devoted-count").html(data.data.devoted);
			}
		}

	});
});

$(document).ready(function(){

	$(document).on('click',".check_comment", function() {
	  var $box = $(this);
	  if ($box.is(":checked")) {
	    var group = ".check_comment[name='" + $box.attr("name") + "']";
	    $(group).prop("checked", false);
	    $box.prop("checked", true);
	  } else {
	    $box.prop("checked", false);
	  }

	  var post_id = $(".post-id").val();
	  var comment_id = $(".check_comment:checked").attr('data-comment-id');
    		$.ajax({
    			data:"post_id="+post_id+"&comment_id="+comment_id, 
    			url:BASE_URL+"post/update_comment_answer",
    			dataType:"JSON",
    			type: "POST",
    			success: function(response){
    				if(response.success)
    				{
    				}
    			}
    		});

	});

});	