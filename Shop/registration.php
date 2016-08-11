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
    $len = strlen($username);


    if ($len < 5 || $len > 25) {
        echo "<p>Username has to be between 5 and 25 characters</p>";
    } elseif ($password1 != $confirmed) {
        echo  "<p>You have entered different passwords!</p>";
    } elseif (strpos($email, '@') <= -1) {
        echo  "<p>There is no @ in your email => Invalid</p>";
    } elseif (VerifyPass($password1)) {
       header("Location: welcome.php");  
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

function VerifyPass(string $password) : bool
{
    $password1 = $_POST["password"];
    $passLen = strlen($password1);

    if (!preg_match('/[A-Z]/', $password1)) {
        echo "<p>Password has to contain at least 1 upper letter</p>";
        return false;
    } elseif (!preg_match('/[a-z]/', $password1)) {
        echo "<p>Password has to contain at least 1 lower letter</p>";
        return false;
    } elseif (!preg_match('#[0-9]#', $password1)) {
        echo "<p>Password has to contain at least 1 number</p>";
        return false;
    } elseif ($passLen < 3 || $passLen > 15) {
        echo "<p>Password has to be between 3 and 15 characters!</p>";
        return false;
    } else {
        return true;
    }
}
?>

<form method="POST" action="registration.php">

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
