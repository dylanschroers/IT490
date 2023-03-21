<?php
// require('functions.php');
require('header.php');
?>

<html>
<h1>Search</h1>
<p style="text-align:center">This will be the page placeholder for searching up TV shows until this feature is implemented as a function.<br><br><i>Well....I think.......</i></p>

<style>
	.input-group {
		position: relative;
		padding-left: 200px;
		padding-right: 200px;
	}
</style>

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

		<!-- Search Bar and button -->

		<div class="input-group">
			<input type="search" id="showTS" class="form-control rounded" placeholder="Search.." aria-label="Search" aria-describedby="search-addon" />
			<button type="button" class="btn btn-outline-primary" onclick="showSearch(document.getElementById('showTS').value);">Search</button>
		</div>

		<div style="text-align:center" id ="searchResponse" class="wait">
			waiting
		</div>
	</form>
</body>
</html>
