	$(document).ready(function()
	{
			
			//focuses first input
			$('#signIn').on('shown.bs.modal', function()	{
				$('#signinuser').focus();
			});
			//focuses first input
			$('#register').on('shown.bs.modal', function()	{
				$('#registerfn').focus();
			});
			//modal transitions
			$('#preregister').click(function() {
				$('#register').modal('hide');
				$('#signIn').modal('show');
			});
			//modal transition
			$('#signup').click(function()	{
				$('#signIn').modal('hide');
				$('#register').modal('show');
		});

		
		
		//validation for register
		$('#registersubmit').click(function()	{
			var firstname = $('#registerfn').val();
			var lastname = $('#registerln').val();
			var username = $('#registerusername').val();
			var password = $('#registerpw').val();
			var email = $('#registeremail').val();
			var phone = $('#registerphone').val();
			
			
			if(firstname.length<1)
			{
				$('#registererror').hide().html("<p>Please enter in a valid first name.</p>").fadeIn('slow');
				return false;
			}
			if(lastname.length<1)
			{
				$('#registererror').hide().html("<p>Please enter in a valid last name.</p>").fadeIn('slow');
				return false;
			}
			if(username.length<1)
			{
				$('#registererror').hide().html("<p>Please enter in a valid username.</p>").fadeIn('slow');
				return false;
	
			}
			if(password.length<5)
			{
				$('#registererror').hide().html("<p>Password must be at least 5 characters long.</p>").fadeIn('slow');
				return false;
			}
			if(email.length<1)
			{
				$('#registererror').hide().html("<p>Please enter in a valid email address.</p>").fadeIn('slow');
				return false;
			}
			if(username!='')
			{
				
				$.post('php/checkusername.php', {username: username}, 
				function(data){ 
					console.log(data);
					if((data.trim()).localeCompare("exists")==0)
					{
						$('#registererror').hide().html("<p>Username already exists.</p>").fadeIn('slow');
						$('#registersubmit').fadeOut('slow');
					}
					else
					{
						$('#registersubmit').fadeIn();
						$('#registererror').hide().html("").fadeIn('slow');
						//post data
						$.post("php/register.php", {phpfirstname: firstname, phplastname: lastname, phpusername: username, 
								  phppassword: password, phpemail: email, phpphone:phone},
								  function(data)
								  {
									if(data=="false")
									{
										$('#registersuccess').hide();
										$('#registererror').hide().html("<p>Username already exists. Please try another.</p>").fadeIn('slow');
										return false;
									}
									else
									{
										$('#registererror').hide();
										$('#registersuccess').hide().html("<p>Congratulations, "+ firstname + "! You have successfully registered for Tour Tracker!</p>").fadeIn('slow');
											$('#registerfn').val("");
											$('#registerln').val("");
											$('#registerusername').val("");
											$('#registerpw').val("");
											$('#registeremail').val("");
											$('#registerphone').val("");
										
										return false;
									}
								  });

					}
						
				});
			}
			
	});
	
	
	//validation for sign in
	$('#signinsubmit').click(function()	{
		var username = $('#signinuser').val();
		var password = $('#signinpass').val();
		var isChecked;
		if(username.length<1)
		{
			$('#signinerror').hide().html("<p>Please enter your username.</p>").fadeIn('slow');
			return false;
	
		}
		if(password.length<1)
		{
			$('#signinerror').hide().html("<p>Please enter your password</p>").fadeIn('slow');
			return false;
		}
		if (document.getElementById('remember').checked) {
            isChecked = "true";
        } else {
           isChecked = "false";
        }
		
		$.post("php/signin.php", {username: username, password: password, isChecked: isChecked},
				 function(data)
				{
					console.log(data);
					if(data=="true")
					{
						$('#signinerror').hide();
						$('#signinsuccess').hide().html("<p>You are now signed in!</p>").fadeIn('slow', function()
						{
							$('#signIn').modal('toggle');
							location.reload();
						});
					} 
					else
					{
						$('#signinsuccess').hide();
						$('#signinerror').hide().html("<p>Your username/password combination is incorrect.</p>").fadeIn('slow');
						 return false;
					}
				});

		});
		
		$('#bandsubmit').click(function()	{
			var bandName = $('#bandName2').val();
			var year = $('#yearFormed').val();
			var members = $('#members').val();
			var wiki = $('#wiki').val();
			var genre = $('#genre').val();
			var onTour = $('input[name=tour]:checked', '#bands').val();
			$.post('php/addband.php', {bandName: bandName, year: year, members: members, wiki: wiki, 
				genre: genre, onTour: onTour}, 
			function(data){
				alert(data);
			location.reload();
			});
		});
		
		
						
});

	
	
	
