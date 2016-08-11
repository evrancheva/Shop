<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
Logged Person : <?php echo $_COOKIE['UserLoggedPerson']; ?>
<a href="logout.php"> Log out </a>

<form action="buy.php" method="post">
    <?php
    //Cookie Maker
    if (!isset($_COOKIE['UserLoggedPerson'])) {
        header('Location: login.php');
    }


    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'demo-project';

    $mysqli = new mysqli($hostname, $username, $password, $dbname);

    if ($mysqli->connect_errno) {
        die("Error! Failed to connect to MySQL!");
    }
    $query = "SELECT * FROM products";
    $result = $mysqli->query($query);
    if (!$result) {
        die("Failed to process query!");
    }


    if ($result->num_rows > 0) {

      
        echo "<table border=\"1\"><tr>";
        echo "<th>Product Name</th> <th>Category</th> <th>Color</th> <th>Price</th> <th>Quantity</th><th></th>";
        while ($row = $result->fetch_assoc()) {
				echo '<form method="POST" action="buy.php">';
				echo "<tr><td>" . $row['product_name'] . "</td>" .
                "<td> " . $row['category'] . " </td>" .
                "<td> " . $row['color'] . " </td>" .
                "<td> " . $row['price'] . " </td>" .
                "<td><input type='text' name='quantity' value='1' style='width: 40px' ></td>" .
                '<td><button type="submit" class="button" name="AddToCart" value="'.$row['id'].'"/>Add to cart</button></td></form>';

        }
        echo "</table></form><br>";
		echo '<form action="cart.php"> <input class="button" type ="submit" value="Review Your Cart"> </form>';
    } else {
        echo "No products";
    }

    //End of Table


    ?>
    <!-- Second Part -->
    <?php

    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'demo-project';

    $mysqli = new mysqli($hostname, $username, $password, $dbname);

    if ($mysqli->connect_errno) {
        die("Error! Failed to connect to MySQL!");
    }


    if (isset($_POST['quantity'])) {
		 if(!is_numeric($_POST['quantity'])){
			 echo "The quantity is invalid!";
		 }
		 else{
        $quantity = intval($_POST['quantity']);
			
		$addToCartID = intval($_POST['AddToCart']);
			$query = "SELECT * FROM products WHERE id=$addToCartID";
			$result = $mysqli->query($query);
			$row = $result->fetch_assoc();
			$productID = intval($row['id']);
		
        if (!$result) {
            die("Failed to process query!");
        }
		
	$username2 = $_COOKIE['UserLoggedPerson'];
	$sql2 = "SELECT id FROM users Where username = '$username2'";
	$result2 = $mysqli->query($sql2);
	$row2 = $result2->fetch_assoc();
	$idto = $row2['id'];

    $sql = "INSERT INTO current_cart (user_id,product_id,quantity) VALUES('$idto','$productID','$quantity')";

        if ($mysqli->query($sql) === TRUE) {
            echo "Added To Cart";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
		 }
    }
    ?>
    <br>

</body>
</html>
