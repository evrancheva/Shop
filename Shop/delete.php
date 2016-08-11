<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your cart</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<span style='font-size: 15px'> Logged Person : <?php echo $_COOKIE['UserLoggedPerson']; ?> </span>
<a href="logout.php"> Log out </a>
<br>

<form action="buy.php" method="post">
    <?php
    //Cookie Maker
    if (!isset($_COOKIE['UserLoggedPerson'])) {
        header('Location: login.php');
    }

    // Connect to DB

    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'demo-project';
    $mysqli = new mysqli($hostname, $username, $password, $dbname);
    if ($mysqli->connect_errno) {
        die("Error! Failed to connect to MySQL!");
    }



    $query = "SELECT `demo-project`.current_cart.id,`demo-project`.products.product_name,`demo-project`.products.price,`demo-project`.current_cart.quantity
		FROM `demo-project`.products
		INNER JOIN `demo-project`.current_cart
		ON `demo-project`.products.id=`demo-project`.current_cart.product_id";
    $result = $mysqli->query($query);
    if (!$result) {
        die("Failed to process query!");
    }

    if ($result->num_rows > 0) {


        echo "<br><table border=\"1\"><tr>";
        echo "<th>No</th> <th>Product Name</th> <th>Price</th> <th>Quantity</th><th></th>";

        $sum = 0;
        $number = 1;

        while ($row = $result->fetch_assoc()) {

            echo '<form method="POST" action="cart.php">';
            echo "<tr><td>" . $number . "</td>" . //номер
                "<td> " . $row['product_name'] . " </td>" .
                "<td> " . $row['price'] . " </td>".
                "<td> " . $row['quantity'] . " </td></form>" .
                '<td><form method="POST">
				<button type="submit" class="button" name="increase" value="'.$row['id'].'"/>+</button>
				<button type="submit" class="button" name="decrease" value="'.$row['id'].'"/>-</button>
				<button type="submit" class="button" name="remove" value="'.$row['id'].'"/>x</button>
				</td></form>';


            //сметки
            $price1 = floatval($row['price']);
            $quantity1 = intval($row['quantity']);
            $quantityPrice = intval($price1*$quantity1);
            $sum = $sum + $quantityPrice;
            $number++;

        }
        echo "</table><br>";
        echo "<p style='font-size: 25px'>Total : $ $sum </p>";

    } else {
        echo "No products";
    }
    if(isset($_POST['CheckIf'])){
        $usernamec = $_COOKIE['UserLoggedPerson'];
        $query = "SELECT money FROM users WHERE username='$usernamec'";
        $result = $mysqli->query($query);
        if (!$result) {
            die("Failed to process query!");
        }
        $row = $result->fetch_assoc();
        $moneyOfUser = $row['money'];
        if($moneyOfUser < $sum){
            echo "You don't have enough money";
        }
        else{
            echo "You bought it!";
            $query2 = "TRUNCATE TABLE current_cart";
            $result2 = $mysqli->query($query2);
        }



    }
    // Next Task
    ?>
    <?php
    // ++++++++++

    if(isset($_POST['increase'])){
        $increase = $_POST['increase'];

        $sql =  "Select quantity FROM current_cart where id = $increase";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();

        $quantity = intval($row['quantity']);
        $quantity1 = $quantity+1; //8

        $query = "UPDATE current_cart SET quantity = '$quantity1' where id = $increase";
        $result = $mysqli->query($query);

        header("Refresh:0");

    }
    ?>

    <?php
    if(isset($_POST['decrease'])){
        $decrease = $_POST['decrease'];

        $sql =  "Select quantity FROM current_cart where id = $decrease";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();

        $quantity = intval($row['quantity']);
        $quantity1 = $quantity-1; //8

        $query = "UPDATE current_cart SET quantity = '$quantity1' where id = $decrease";
        $result = $mysqli->query($query);
        header("Refresh:0");
    }

    ?>

    <?php

    if(isset($_POST['remove']))
    {
        $delete = $_POST['remove']; //17
        $sql = "DELETE FROM current_cart WHERE id = $delete";

        if ($mysqli->query($sql) === TRUE) {
            header("Refresh:0");
        } else {
            echo "Error";
        }
    }
    ?>
    <form method="POST">
        <input class="button" type ="submit" name="CheckIf" value="Buy">
    </form>
    <br>
    <form method="POST" action="buy.php">
        <input class="button" type ="submit"  value="Go back">
    </form>



</body>
</html>
