<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1>List of Items</h1>
<ul id="items"><li>First</li><li>Second</li></ul>
<input type="submit" id="newItemText" onclick= "addItem()" value="lala" />
<input type="button" onclick="addItem()" value="Add">
<script>
  function addItem() {
    let text = document.getElementById('newItemText').value;
    var li = document.createElement("li");
    li.appendChild(document.createTextNode(text));
    document.getElementById("items").appendChild(li);
  }
</script>



</body>
</html>