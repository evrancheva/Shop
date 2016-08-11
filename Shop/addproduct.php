<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add product</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
Logged Person : <?php echo $_COOKIE['LoggedPerson']; ?>
<a href="logout.php"> Log out </a>
<form action="addproduct.php" method="POST">
    <table>
        <tr>
            <th>Product Name</th>
            <th>Category</th>
            <th>Color</th>
            <th>Price</th>
        </tr>
        <tr>
            <td><input type="text" name="product-name" placeholder="Product name"></td>
            <td><input type="text" name="category" placeholder="Category" ></td>
            <td><input type="text" name="color" placeholder="Color"></td>
            <td><input type="text" name="price" placeholder="Price"></td>
        </tr>
    </table>
    <input class="button"type="submit" name="delete" value="Add">
	</form>
	<br>
	<form action="listproducts.php">
	<input class="button" type ="submit" value="Go Back">
	</form>
    <?php
	 if (!isset($_COOKIE['LoggedPerson'])) {
        header('Location: login.php');
    }
    if (isset($_POST['product-name']) && isset($_POST['category']) && isset($_POST['color']) && isset($_POST['price'])) {
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'demo-project';

        $mysqli = new mysqli($hostname, $username, $password, $dbname);

        if ($mysqli->connect_errno) {
            die("Error! Failed to connect to MySQL!");
        }
        $productname = $_POST['product-name'];
        $category = $_POST['category'];
        $color = $_POST['color'];
        $price = $_POST['price'];

        if(!is_numeric($price)){
            echo "The price is invalid";
        }
        else {
            $query = $mysqli->prepare("INSERT INTO products (product_name,category,color,price) VALUES(?,?,?,?)");
            $query->bind_param("sssd", $productname, $category, $color, $price);
            $query->execute();

            if ($query->affected_rows == 1) {
                echo "Product successfully added";
            } else {
                die("Failed to add the product");
            }
        }
    }

    ?>
</body>
</html>