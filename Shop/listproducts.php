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
<form action="listproducts.php" method="post">
    <?php

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
        echo "<th>Product Name</th> <th>Category</th> <th>Color</th> <th>Price</th> <th> </th><th> </th>";
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
			echo "<tr><td>" . $row['product_name'] . "</td>" .
                "<td> " . $row['category'] . " </td>" .
                "<td> " . $row['color'] . " </td>" .
                "<td> " . $row['price'] . " </td>" .
                '<td><button type="submit" class="button" name="deleteItem" value="'.$row['id'].'"/>Delete</button></td>' .
				"<td><a class='link' href='edit.php?edit=$row[id]'>Edit</a></td>";
        }
        echo "</table>";

    }
    else {
        echo "No products";
    }
   if (!isset($_COOKIE['LoggedPerson'])) {

        header('Location: login.php');


    }
?>

<?php

if(isset($_POST['deleteItem']))
{
	$delete = $_POST['deleteItem']; //17
	$sql = "DELETE FROM products WHERE id = $delete";
	
	if ($mysqli->query($sql) === TRUE) {
            header("Refresh:0");
        } else {
            echo "Error";
        }
}
?>

</form>
<br>
<form action="addproduct.php">
    <input class='button' type="submit" value="Add New Product">
</form>
<br>
<form action="bought-products.php">
	<input class="button" type ="submit" value="Bought Products">
</form>
</body>
</html>