<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Counter</title>
</head>
<body>


<?php

session_start();


if (!isset($_SESSION['views'])) {
	
		$_SESSION['views'] = 1;
}
else{
	
	if(isset($_POST['sign'])){
		if($_POST['sign'] == "+1"){
			$_SESSION['views']++;
		}
		  if($_POST['sign'] == "-1"){
			$_SESSION['views']--;
	}
}
}

?>

<form method="POST" action="pageview.php">

    <input type="submit" name="sign" value="+1">
    <input type="submit" name="sign" value="-1">
    <p> Counter : <?php echo $_SESSION['views']; ?> </p>

</form>

</body>
</html>