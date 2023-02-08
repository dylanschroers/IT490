<html>
<script>

function HandleLoginResponse(response) {
	var text = (response);
	document.getElementById("textResponse").innerHTML = "response: "+text+"<p>";
}

function SendLoginRequest(username, password) {
	var request = new XMLHttpRequest();
	request.open("POST","login.php", true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	
	request.send("type=login&uname="+username+"&pword="+password);
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
<script>
SendLoginRequest("test","test");
</script>
</body>
</html>
