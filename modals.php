<!-- Modal Sign In-->
<div class="modal fade" id="signIn" tabindex="-1" role="dialog" aria-labelledby="signInLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="signInLabel">Login Form</h4>
      </div>
      <div class="modal-body">
		<div class="container">
		<form role="form">
		<p id="signinerror" class="text-danger"></p>
		<p id="signinsuccess" class="text-success"></p>
		<div class="row">
		  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
			<label for="code">Username</label>
			  <input id="signinuser" type="text" class="form-control" placeholder="Enter Username..." />
		  </div>
		</div>

			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Password</label>
				  <input id="signinpass" type="password" class="form-control input-normal" placeholder="Enter Password"/>
			  </div>
			</div>


		  <div class="checkbox">
			<label>
				<input id="remember" type="checkbox"> Remember Me
		  </label>
		</div>
		<div class="row">
		  <div class="form-group col-xs-3 col-lg-1">
		  <button id="signinsubmit" type="button" class="btn btn-default">Submit</button>
		  </div>
		</div>
	</form>
    </div>
      </div>
      <div class="modal-footer">
        <p class="pull-left" style="float:left;">Not registered yet? <a id="signup" href="#">Click here</a></p><br><br>
      </div>
    </div>
  </div>
</div>
				

<!-- Modal Register-->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="registerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="registerLabel">Registration Form</h4>
      </div>
      <div class="modal-body">
		<div class="container">
		<form role="form">
		<div id="errors">
		<p id="registererror" class="text-danger"></p>
		<p id="registersuccess" class="text-success"></p>
		</div>
		<div class="row">
		  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
			<label for="code">First Name</label>
			  <input id="registerfn" type="text" class="form-control" placeholder="Enter First Name..." />
		  </div>
		</div>

			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Last Name</label>
				  <input id="registerln" type="text" class="form-control input-normal" placeholder="Enter Last Name..."/>
			  </div>
			</div>

			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Username</label>
				  <input id="registerusername" onkeyup="checkusername()" type="text" class="form-control input-normal" placeholder="Enter Username..."/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Password</label>
				  <input id="registerpw" type="password" class="form-control input-normal" placeholder="Enter Your Password..."/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Email</label>
				  <input id="registeremail" type="text" class="form-control input-normal" placeholder="example: johndoe@yahoo.gov"/>
			  </div>
			</div>
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Phone Number [optional]</label>
				  <input id="registerphone" type="tel" class="form-control input-normal" placeholder="(_ _ _) _ _ _ - _ _ _ _"/>
			  </div>
			</div>

		  <div class="checkbox">
			<label>
				<input type="checkbox"> Remember Me
		  </label>
		</div>
		<div class="row">
		  <div class="form-group col-xs-3 col-lg-1">
		  <button id="registersubmit" type="button" class="btn btn-default">Submit</button>
		  </div>
		</div>
	</form>
    </div>
      </div>
      <div class="modal-footer">
		<p class="pull-left">Already have an account? <a id="preregister" href="#">Click here</a></p>
      </div>
    </div>
  </div>
</div>		
<script>
	function checkusername()
		{
			var username = $('#registerusername').val();
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
					}
						
				});
			}
			
		
		}
</script>		
