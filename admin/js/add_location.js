// JavaScript Document
$(document).ready(function()
{
	$("#add").click(function()
	{
		var city = $("#city").val();
		//checking for blank fields.
		if(city == '')
		{
			$("#warning").text("*Please Enter City Name.");
			$("#city").focus();
			return false;
		}
		/*else
		{
			
			$.post("../functions/add_location.php", { city1: city},
				   function( data )
				   {
					  	if(data=='exists')
						{
							$("#warning").text("*City already Added to database.");
							return false;
						}
						else if(data=='wrong')
						{
							$("#warning").text("*Please try again.");
							return false;
						}
						else if(data=='success')
						{
							$("#city").val("");
							//window.location.replace("Profile.php");
							$("#warning").text("*Location Successfull added.");
							//window.location.replace("Profile.php");
							return true;
						}
				   }
			);
			return false;
			
		}*/
		
	});	
	
});