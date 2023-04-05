#This is will be the search page until partial search bar is created
<html>
<script>
	window.onload = function() {
		recShows(
	}

	function HandleRecResponse(response) {
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

	function recShows(userID) {
		var request = new XMLHttpRequest();
		request.open("POST","recShows.php",true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		request.send("userID="+userID);
		request.onreadystatechange = function() {
			if ((this.readyState == 4)&&(this.status == 200)) {
				HandleSearchResponse(this.responseText);
			}
		}
	}
</script>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<form id ='search'>
	<input type ='text' id ='showTS' placeholder ="Search..">
	<input type ='button' value ='Search' onclick="showSearch(document.getElementById('showTS').value);">
	
	<div id ="searchResponse">
	waiting
	</div>

</body>
</html>
