// JavaScript Document// JavaScript Document
$(document).ready(function()
{
	$("#login").click(function()
	{
		var email = $("#username").val();
		var password = $("#password").val();
		//checking for blank fields.
		if(email == '' || password == '' )
		{
			$("#warning").text("*Please Enter Username and password.");
			return false;
		}
		/*else
		{
			
			$.get("http://cwebsitedesigning.com/clients/superpandit/admin/login.php", { email1: email, password1: password },
				   function( data )
				   {
					  	if(data=='invaild')
						{
							$("#warning").text("*Invalid input.");
							return false;
						}
						else if(data=='wrong')
						{
							$("#warning").text("*Check your username and password.");
							return false;
						}
						else if(data=='correct')
						{
							//window.location.replace("Profile.php");
							$("#warning").text("*Successfull...");
							window.location.replace("home.php");
							return true;
						}
				   }
			);
			return false;
			
		}
		*/
	});	
	
});