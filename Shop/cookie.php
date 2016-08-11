<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pageviews</title>
</head>
<body>

 
<?php

setcookie('LoggedPerson','Eli',time() + (86400 * 30),'','','',TRUE);


?>
 <p> Logged Person : <?php  echo $_COOKIE['LoggedPerson'];?> </p>
 
</body>
</html>