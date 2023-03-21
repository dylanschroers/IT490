<?php
require('functions.php');
require('navbar.php');
?>

<html>
<p style="text-align:center">This will be the page placeholder for searching up TV shows until this feature is implemented as a function.</p>

<script>
	function HandleSearchResponse(response) {
		try {
		var result = JSON.parse(response);
		result.forEach(smth);
		function smth(show) {
			if (typeof(showList) == "undefined") {
				showList = "";
			}
			showList += ("<a class='post' href='newpage.php?name="+ show[2] +
			"&id="+show[0]+"'>"+show[2]+"</a><br>");
		}
		document.getElementById("searchResponse").innerHTML = showList;
		showList = "";
		} catch(error) {
			document.getElementById("searchResponse").innerHTML = error;
		}
	}

	function showSearch(formSname) {
		var request = new XMLHttpRequest();
		request.open("POST","search.php",true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		request.send("type=search&sval="+formSname);
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
	</form>
	<div class="input-group">
		<input type="search" class="form-control rounded" placeholder="Search" aria-label="Search.." aria-describedby="search-addon" />
		<button type="button" class="btn btn-outline-primary">Search</button>
	</div>
</body>
</html>
