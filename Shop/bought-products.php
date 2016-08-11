<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
Logged Person : <?php echo $_COOKIE['LoggedPerson']; ?>
<a href="logout.php"> Log out </a>
<?php
 if (!isset($_COOKIE['LoggedPerson'])) {
        header('Location: login.php');
    }
	
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'demo-project';

    $mysqli = new mysqli($hostname, $username, $password, $dbname);
	
	    $query = "SELECT  product_name, Sum(quantity) AS Sold_Quantity,price
				FROM current_cart 
				INNER JOIN products
				ON products.id = current_cart.product_id
				WHERE isBought = '0' 
				Group by product_id";
		$result = $mysqli->query($query);
		if (!$result) {
			die("Failed to process query!");
		}

		if ($result->num_rows > 0) {
			
        echo "<table border=\"1\"><tr>";
        echo "<th>Product Name</th> <th>Quantity Bought</th> <th>Income From Sales</th>";
		$sum = 0;
        while ($row = $result->fetch_assoc()) {
				//сметки 
				$price = floatval($row['price']);
				$quantity = intval($row['Sold_Quantity']);
				$sold = $price*$quantity;
			
				echo '<form method="POST" action="bought-products.php">';
				echo "<tr><td>" . $row['product_name'] . "</td>" .
                "<td> " . $quantity . " </td>" .
				 "<td> " . $sold . " </td>" ;
				$sum +=$sold;
				
		}
		echo "</table></form><br>";
		echo "<p> Total Income: $$sum </p>";
		echo '<form action="listproducts.php"> <input class="button" type ="submit" value="Go Back"> </form>';
    } else {
        echo "No products";
    }
				
				
?>
</body>
</html>