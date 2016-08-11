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

$mysqli = new mysqli( $hostname, $username, $password, $dbname );

if ($mysqli->connect_errno) {
    die("Error! Failed to connect to MySQL!");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "SELECT * FROM products WHERE id=$id";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $productDB =$row['product_name'];
	$categoryDB = $row['category'];
	$colorDB = $row['color'];
	$priceDB = $row['price'];


}
else{
    $productDB="";
	$categoryDB="";
	$colorDB ="";
	$priceDB = "";
}
if (isset($_POST['submit'])) {

    $product = $_POST['product-name'];
    $category = $_POST['category'];
    $color = $_POST['color'];
    $price = $_POST['price'];

    $sql = "UPDATE products SET  product_name='$product', category='$category', color='$color', price='$price' WHERE id='$id'";

    if ($mysqli->query($sql) === TRUE) {
        header("Location:  listproducts.php");
    } else {
        echo "Error";
    }


}



?>

<form method="post" action="">

    <table>
        <tr>
            <th>Product Name</th>
            <th>Category</th>
            <th>Color</th>
            <th>Price</th>
        </tr>
        <tr>
            <td><input type="text" name="product-name" value="<?php echo $productDB;?>"></td>
            <td><input type="text" name="category" placeholder="Category" value="<?php echo $categoryDB;?>"/></td>
            <td><input type="text" name="color" placeholder="Color" value="<?php echo $colorDB;?>"/></td>
            <td><input type="text" name="price" placeholder="Price" value="<?php echo $priceDB;?>"/></td>
        </tr>
	</table>
	<br>
    <input class="button" type="submit" name="submit" value="Save"/>
</form>
<br>
<form action="listproducts.php">
	<input class="button" type ="submit" value="Go Back">
	</form>


</body>

</html>