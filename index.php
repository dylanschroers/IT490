<?php
require("functions.php")
?>

<html>
<script>

function HandleLoginResponse(response) {
	var text = (response);
	
	document.getElementById("textResponse").innerHTML = "response: "+text+"<p>";
}

function SendLoginRequest(formUname,formPword) {
	var request = new XMLHttpRequest();
	request.open("POST","login.php", true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	
	
	//request.send("type=login&uname='test'&pword='test'");
	request.send("type=login&uname="+formUname+"&pword="+formPword);
	request.onreadystatechange= function () {
		if ((this.readyState == 4)&&(this.status == 200)) {
			HandleLoginResponse(this.responseText);
		}
	}
	//request.send("type=login&uname="+username+"&pword="+password);
}
</script>
<style>
	* {
		background-color: lightblue;
		padding: 2%;
	}
	#cent {
		text-align: center;
		padding: 1%;
	}
	#login {
		padding: 1%;
	}
	.txtres {
		text-align: center;
	}
	.lgnbtn {
		margin: auto;
	}
	#register {
		float: right;
	}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<head>
	<link rel="shortcut icon" href="#">
	<!-- Header -->
	<h1 id="cent">Login</h1>
	<!-- Register Button -->
	<button type="button" id="Register" class="btn btn-primary btn-block mb-4" value="Register">Register</button>
</head>
<body>
	<div id="login">
		<form id='loginForm'>
			<div class="txtres" id="textResponse">awaiting response2</div>
			<!-- Username -->
			<div class="form-outline mb-4">
				<input type="username" id="form2Example1 username" class="form-control" placeholder="Username" />
			</div>

			<!-- Password -->
			<div class="form-outline mb-4">
				<input type="password" id="form2Example2 password" class="form-control" placeholder="Password" />
			</div>

			<!-- Login Button -->
			<button type="button" class="btn btn-primary btn-block mb-4 lgnbtn" value="Login" onclick="SendLoginRequest(document.getElementById('username').value, document.getElementById('password').value);">Login</button>
		</form>
	</div>
</body>
</html>
