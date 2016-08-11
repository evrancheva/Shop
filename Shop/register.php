<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
</head>
<body>

<?php


if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirmPass"]) && isset($_POST["email"]))
{
    $username1 = (string)$_POST["username"];
    $password1 = md5($_POST["password"]);
    $confirmed = md5($_POST["confirmPass"]);
    $email = $_POST["email"];
    $len = strlen($username1);


   if ($password1 != $confirmed) {
        echo  "<p>You have entered different passwords!</p>";
    } 
	
	
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'demo-project';

    $mysqli = new mysqli($hostname, $username, $password, $dbname);

    if ($mysqli->connect_errno) {
        die("Error! Failed to connect to MySQL!");
    }
	 $query = $mysqli->prepare("INSERT INTO users (username,password,email,type) VALUES(?,?,?,?)");
            $query->bind_param("ssss", $username1, $password1,$email,$type);
            $query->execute();

            if ($query->affected_rows == 1) {
                echo "User successfully added";
            } else {
                die("Failed to add the product");
            }
}
else
{
	$username="";
	$email ="";
	
}

?>

<form method="POST" action="register.php">

    Username : <input type="text" name="username" value="<?php echo "$username";?>">
    <br>
    Password : <input type="password" name="password" >
    <br>
    Confirm Password : <input type="password" name="confirmPass">
    <br>
    E-mail: <input type="email" name="email" value="<?php echo "$email";?>">
    <br>
	Type: <input type="text" name ="type">
	<br>
    <input type="submit" name="Submit" value="Submit">



</form>
</body>
</html>
