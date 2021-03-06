<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="register.php">
    <h2>Register page</h2>
        <input type="text" name="input_username" placeholder="Username">
        <input type="password" name="input_password" placeholder="Password">
        <button type="submit" name="submit">Register</button>
    </form>
    <!-- Here we create sql connection and input the values we enter -->
    <?php
    if(isset($_GET['submit'])){
        $username = $_GET['input_username'];
        $password = $_GET['input_password'];
        
        $mysql_servername = "localhost";
        $mysql_username = "root";
        $mysql_password = "";
        $mysql_dbname = "php_sample";

        // Create connection
        $conn = mysqli_connect($mysql_servername, $mysql_username, $mysql_password, $mysql_dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO tbluser (username, password)
        VALUES ('".$username."', '".$password."')";

        if (mysqli_query($conn, $sql)) {
            // If data insert is success then we will make a message and redirect the page.
            $message = "New record created successfully - $username";
            $redirect_link = 'http://localhost/sample_project/register.php'.'?message='.$message;
            header('Location: '.$redirect_link);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    ?>
    <!-- Here we check we already inputed any file -->
    <?php
    if(isset($_GET['message'])){
        echo $_GET['message'];
    }
    ?>
    
    <div>
        Already have account? click <a href="login.php">Login</a>
    </div>
</body>
</html>