// JavaScript Document

$(document).ready(function()
{

	$( 'form' ).submit(function ( e ) {
		var name = $("#name").val();
		var pooja_img = document.getElementById("pooja_img");
		var pooja_content = $("#pooja_content").val();
		var formdata = false;
	
		if(name == '')
		{
			$("#warning").text("*Please enter pooja name.");
			$("#name").focus();
			return false;
		}
		else if( pooja_img.value == '')
		{
			$("#warning").text("*Please enter pooja image.");
			$("#pooja_img").focus();
			return false;
		}
		else if(pooja_content == '')
		{
			$("#warning").text("*Please enter pooja content.");
			$("#pooja_content").focus();
			return false;
		}
		/*else
		{
						
			
				var data;
				
				data = new FormData();
				data.append( 'pooja_img', $( '#pooja_img' )[0].files[0] );
				data.append("name",name);
				data.append("pooja_content",$( '#pooja_content' )[0].files[0] );
				
				$.ajax({
					url: 'functions/add_pooja.php',
					data: data,
					processData: false,
					type: 'GET',
			
					// This will override the content type header, 
					// regardless of whether content is actually sent.
					// Defaults to 'application/x-www-form-urlencoded'
					contentType: 'multipart/form-data', 
			
					//Before 1.5.1 you had to do this:
					beforeSend: function(xhr) { 
						xhr.setRequestHeader('Content-Type', 'multipart/form-data');
					},
					// Now you should be able to do this:
					mimeType: 'multipart/form-data',    //Property added in 1.5.1
			
					success: function (data) {
						alert(data);
					}
				});
				
				e.preventDefault();
			
		}*/
	});
			
});