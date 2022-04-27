<?php

require_once('config.php');

session_start();

$data = mysqli_connect($host, $db_user, $db_pass, $db_name);
if ($data == false) {
    die("connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signin'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username='" . $username . "' AND  password='" . $password . "'";
    $result = mysqli_query($data, $sql) or die(mysqli_error($data));
    $row = mysqli_fetch_array($result);


    if ($row["usertype"] == "user") {
        $_SESSION["username"] = $username;
        header("location:feed.php");
    } elseif ($row["usertype"] == "admin") {
        $_SESSION["username"] = $username;

        header("location:admin_feed.php");
    } else {
        echo "Incorrect credentials";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = $_POST["username_reg"];
    $password = $_POST["password_reg"];
    $email = $_POST["email_reg"];

    $sql1 = " INSERT INTO users (username, email, password )  VALUES('$username','$email','$password')";
    mysqli_query($conn, $sql1);
    echo '<script> alert("Account sucessfully created")</script>';
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Story Space</title>
    <link rel="stylesheet" href="styles.css">
</head>


<body style="background-image: url('giphy.gif'); background-repeat: no-repeat;background-size: cover;">

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="#" method="POST">
                <h1>Create an account</h1>
                <br>
                <input type="text" name="username_reg" placeholder="Username" required />
                <input type="email" name="email_reg" placeholder="Email" required />
                <input type="password" name="password_reg" placeholder="Password" required />
                <br>
                <button type="submit" name="signup">Sign Up</button>
            </form>

        </div>



        <div class="form-container sign-in-container">
            <form action="#" method="POST">
                <h1>Sign in</h1>
                <br>
                <input type="text" name="username" placeholder="username" required />
                <input type="password" name="password" placeholder="Password" required />
                <a href="#">Forgot your password?</a>
                <button type="submit" name="signin">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, dear visitor!</h1>
                    <p>Enter your personal details and start journey with us as an admin</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>
</body>

</html>