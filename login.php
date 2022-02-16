<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>
        <h2>Login page</h2>
        <input type="text" name="input_username" placeholder="Username">
        <input type="password" name="input_password" placeholder="Password">
        <button type="submit" name="login_button">Login</button>
    </form>
    <?php
    if(isset($_GET['login_button'])){
        
    }
    ?>

    <?php
    if(isset($_GET['login_button'])){
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

        $username = $_GET['input_username'];
        $password = $_GET['input_password'];
        $sql = "SELECT id, username, password FROM tbluser where username='".$username."'";
        
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            if($row["password"]==$password){
                $redirect_link = 'http://localhost/sample_project/home_file.php';
                header('Location: '.$redirect_link);
            }
            else{
                $message = 'Password incorrect';
                $redirect_link = 'http://localhost/sample_project/login.php'.'?message='.$message;
                header('Location: '.$redirect_link);
            }
        }
        } else {
            $message = "No user exists";
            $redirect_link = 'http://localhost/sample_project/login.php'.'?message='.$message;
            header('Location: '.$redirect_link);
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
        Create user click <a href="register.php">here</a>
    </div>
</body>
</html>