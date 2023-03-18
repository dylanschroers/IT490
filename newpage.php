<html>
<script>
	window.onload = function() {
		var url = decodeURI(document.location.href),
			params = url.split('?')[1].split('&'),
			data = {}, tmp;
		for (var i = 0, l = params.length; i < l; i++) {
			tmp = params[i].split('=');
			data[tmp[0]] = tmp[1];
		}
		showLookup(data.id);
	}
	
	function HandleLookupResponse(response) {
		var result = JSON.parse(response);
		
		document.getElementById("Title").innerHTML = result['name'];

		document.getElementById("Genres").innerHTML = "<br>Genres: "+result['genres'];
		document.getElementById("Rating").innerHTML = "<br>Rating: "+result['rating']['average'];
		document.getElementById("Picture").innerHTML = "<br><img src="+result['image']['medium']+">";
		document.getElementById("Summary").innerHTML = "<br>Summary: <p>"+result['summary']+"</p><br>";
	}

	function showLookup(sid) {
		var request = new XMLHttpRequest();
		request.open("POST", "search.php", true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		request.send("type=lookup&sid="+sid);
		request.onreadystatechange = function() {
			if ((this.readyState == 4)&&(this.status == 200)) {
				HandleLookupResponse(this.responseText);
			}
		}	
	}
</script>
<head>
	<div id = "Title">
	Title
	</div>
</head>
<body>
	<div id = "Picture">
	Picture
	</div>

	<div id = "Genres">
	Genres
	</div>

	<div id = "Rating">
	Rating
	</div>

	<div id = "Summary">
	Summary
	</div>

	<div id = "EpList">
	Episode List
	</div>


</body>
</html>
