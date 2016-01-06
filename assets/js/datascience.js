var appConstant = {url:""}; 

function showPopupDiv(isVisible) 
 {
		if(isVisible)
			$("#popupBox").show();
		else
			$("#popupBox").hide();
}
 
 function validateSignupForm()
 {
	var hasError = false;
	var errorMsg = "";
	var postData = {};
		
	$("#signup-form input").each(function(i, input) {
		errorMsg = validateField($(input), postData);
		if(errorMsg != "")
			hasError = true;
	});
	
	if(!hasError)
	{
		var pwd = $('#signup-form input[name="password"]').val();
		var cpwd = $('#signup-form input[name="confirm_password"]').val();
		if(pwd != cpwd)
		{
			$("#error_message").empty().append("Confirm password is not match.");
			hasError = true;
		}
		else if(pwd.length < 8)
		{
			$("#error_message").empty().append("Password must be at least 8 characters.");
			hasError = true;
		}
		else
		{
			$('#signup-form input[name="password"]').val($.sha1(pwd));
			$('#signup-form input[name="confirm_password"]').val($.sha1(pwd))
		}
	}
	
	return !hasError;
	
	/*if(hasError)
		return false;
	else
	{
		("#signup-form").submit();
	}*/
 }
 
 function doLoginUser()
 {
	var hasError = false;
	var errorMsg = "";
	var postData = {};
		
	$("#login-form input").each(function(i, input) {
		errorMsg = validateField($(input), postData);
		if(errorMsg != "")
			hasError = true;
	});
	
	if(!hasError)
	{
		postData.password = $.sha1(postData.password);
		
		$.post( appConstant.url + "login/validate", postData, function( data ) {
			if(data != null)
        	{
        		if(data.status)
        		{
        			window.location = appConstant.url + 'dashboard';
        		}
        		else
        		{
        			$("#error_message").show();
        			$("#error_message").empty().append(data.msg);
        		}
        	}
		},'json')
		 .fail(function() {
			 alert("Request on server failed.");
		},'json');
		/*$.ajax({
	        url: appConstant.url + "login/validate",
	        type:'POST',
	        dataType: 'json',
	        data:postData,
	        success:function(data)
	        {
	        	if(data != null)
	        	{
	        		if(data.status)
	        		{
	        			window.location = appConstant.url + 'dashboard';
	        		}
	        		else
	        		{
	        			$("#error_message").show();
	        			$("#error_message").empty().append(data.msg);
	        		}
	        	}
	        },
	        error: function(MLHttpRequest, textStatus, errorThrown){
	        	alert("Add record request on server failed.");
	        }
		});*/
	}
 }
 
 function validateField(infield, postData, isselect)
 {
 	var fieldVal = infield.val();
 	var fieldName = infield.attr("name");
 	var efldName = fieldName.replace("_", " ");
 	var errorMsg = "";
 	
 	infield.removeClass("error_field");
 	$("#"+ fieldName +"_emsg").empty();
 	if(isselect)
 		infield.parent(".select-wrapper").removeClass("error_field");
 	
 	postData[fieldName] = fieldVal;
 	
 	if(infield.hasClass("required"))
 	{
 		if(fieldVal == null || fieldVal == "" || (isselect && fieldVal == 0))
 			errorMsg = capitalizeWord(efldName) + " is required.\n";
 		else if(fieldName == "email" && !isEmail(fieldVal))
 			errorMsg = "Invalid email address.\n";
 		
 		infield.attr("title", errorMsg);
 		if(errorMsg != "")
 		{
 			infield.addClass("error_field");
 			$("#"+ fieldName +"_emsg").append(errorMsg);
 			if(isselect)
 				infield.parent(".select-wrapper").addClass("error_field");
 		}
 	}
 	
 	return errorMsg;
 }
 
 function capitalizeWord(str)
 {
 	str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
 	    return letter.toUpperCase();
 	});
 	
 	return str;
 }

 function isEmail(email)
 {
   var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,6})+$/;
   return regex.test(email);
 }
 
 function do_add_record(container, servicepath, returnpath)
 {
	var hasError = false;
	var errorMsg = "";
	var postData = {};
		
	$("#"+container+" input").each(function(i, input) {
		errorMsg = validateField($(input), postData);
		if(errorMsg != "")
			hasError = true;
	});
	
	$("#"+container+" textarea").each(function(i, input) {
		errorMsg = validateField($(input), postData);
		if(errorMsg != "")
			hasError = true;
	});
	
	$("#"+container+" select").each(function(i, input) {
		errorMsg = validateField($(input), postData, true);
		if(errorMsg != "")
			hasError = true;
	});

	
	if(!hasError)
	{
		$.ajax({
	        url: appConstant.url + servicepath,
	        type:'POST',
	        data:postData,
	        success:function(data)
	        {
	        	if(data != null && data > 0)
	        	{
	        		window.location = appConstant.url + returnpath;
	        	}
	        	//alert(data);
	        },
	        error: function(MLHttpRequest, textStatus, errorThrown){
	        	alert("Add record request on server failed.");
	        }
		});
	}
	else
		return false;
 }
 
 function validateChangePassword()
 {
	var hasError = false;
	var errorMsg = "";
	var postData = {};
		
	$("#changepass-form input").each(function(i, input) {
		errorMsg = validateField($(input), postData);
		if(errorMsg != "")
			hasError = true;
	});
	
	if(!hasError)
	{
		var pwd = $('#changepass-form input[name="password"]').val();
		var cpwd = $('#changepass-form input[name="confirm_password"]').val();
		if(pwd != cpwd)
		{
			$("#error_message").empty().append("Confirm password is not match.");
			hasError = true;
		}
		else if(pwd.length < 8)
		{
			$("#error_message").empty().append("Password must be at least 8 characters.");
			hasError = true;
		}
		else
		{
			$('#changepass-form input[name="password"]').val($.sha1(pwd));
			$('#changepass-form input[name="confirm_password"]').val($.sha1(pwd))
		}
	}
	
	//return !hasError;
	
	if(hasError)
		return false;
	else
	{
		$.post( appConstant.url + "profile/register_new_password", postData, function( data ) {
			if(data != null)
        	{
        		if(data.status)
        		{
        			alert(data.msg);
        			$("#popupBox").hide();
        			//window.location = appConstant.url + '';
        		}
        		else
        		{
        			$("#error_message").show();
        			$("#error_message").empty().append(data.msg);
        		}
        	}
		},'json')
		 .fail(function() {
			 alert("Request on server failed.");
		},'json');
		
		return false;
	}
 }
 
 function doChangePassword()
 {
	var hasError = false;
	var errorMsg = "";
	var postData = {};
		
	$("#changepass-form input").each(function(i, input) {
		errorMsg = validateField($(input), postData);
		if(errorMsg != "")
			hasError = true;
	});
	
	if(!hasError)
	{
		postData.password = $.sha1(postData.password);
		
		$.post( appConstant.url + "profile/validate", postData, function( data ) {
			if(data != null)
        	{
        		if(data.status)
        		{
        			window.location = appConstant.url + 'dashboard';
        		}
        		else
        		{
        			$("#error_message").show();
        			$("#error_message").empty().append(data.msg);
        		}
        	}
		},'json')
		 .fail(function() {
			 alert("Request on server failed.");
		},'json');
		/*$.ajax({
	        url: appConstant.url + "login/validate",
	        type:'POST',
	        dataType: 'json',
	        data:postData,
	        success:function(data)
	        {
	        	if(data != null)
	        	{
	        		if(data.status)
	        		{
	        			window.location = appConstant.url + 'dashboard';
	        		}
	        		else
	        		{
	        			$("#error_message").show();
	        			$("#error_message").empty().append(data.msg);
	        		}
	        	}
	        },
	        error: function(MLHttpRequest, textStatus, errorThrown){
	        	alert("Add record request on server failed.");
	        }
		});*/
	}
 }