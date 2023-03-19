#This is will be the search page until partial search bar is created
<html>
<script>
	function HandleSearchResponse(response) {
		var result = (response);
	
		document.getElementById("searchResponse").innerHTML = result;
	}

	function showSearch(formSname) {
		var request = new XMLHttpRequest();
		request.open("POST","search.php",true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		request.send("type=search&sname="+formSname);
		request.onreadystatechange = function() {
			if ((this.readyState == 4)&&(this.status == 200)) {
				HandleSearchResponse(this.responseText);
			}
		}
	}
</script>
<body>
	<form id ='search'>
	<input type ='text' id ='showTS' placeholder ="Search..">
	<input type ='button' value ='Search' onclick="showSearch(document.getElementById('showTS').value);">
	
	<div id ="searchResponse">
	waiting
	</div>

</body>
</html>
