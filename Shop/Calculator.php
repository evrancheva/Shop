<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calculator</title>
</head>
<body>
<form method="POST" action="Calculator.php">

    <input type="text" name="firstInt"> <br>
    <input type="radio" name="sign" value="plus" checked> + <br>
    <input type="radio" name="sign" value="minus"> - <br>
    <input type="radio" name="sign" value="divide"> / <br>
    <input type="radio" name="sign" value="multiply"> * <br>
    <input type="text" name="secondInt"> <br>
    <input type ="submit" name="submit" value="Submit!"> <br>


    <?php
    if(isset($_POST['firstInt'])  && isset($_POST['secondInt']) && isset($_POST['sign'])){
        $mathOperation = $_POST['sign'];
        $firstInteger = $_POST['firstInt'];
        $secondInteger =$_POST['secondInt'];
        
        if($mathOperation == "plus"){
            echo "<b>The Answer is: </b>";
			echo $firstInteger+$secondInteger;
        }
        elseif($mathOperation == "minus"){
           echo "<b>The Answer is: </b>";
			echo $firstInteger-$secondInteger;
        }
        elseif($mathOperation == "divide"){
            echo "<b>The Answer is: </b>";
			echo $firstInteger/$secondInteger;
        }
        elseif($mathOperation == "multiply"){
          echo "<b>The Answer is: </b>";
			echo $firstInteger*$secondInteger;
        }

    }

    ?>

</form>
</body>
</html>