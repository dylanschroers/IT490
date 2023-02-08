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
<head>
	<link rel="shortcut icon" href="#">
</head>
<h1>login page 2</h1>
<body>
<div id="textResponse">
awaiting response2
</div>
 <form id='loginForm'>
  <label for='uname'>Username:</label><br>
  <input type='text' id='uname' name='uname'><br>
  <label for='pword'>Password:</label><br>
  <input type='text' id='pword' name='pword'>
  <input type='button' value='Login' onclick="SendLoginRequest(document.getElementById('uname').value,
	document.getElementById('pword').value);">
</form>
</body>
</html>
