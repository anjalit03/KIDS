<!DOCTYPE  html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
        <link rel="stylesheet" href="../css/login2.css">
        <link rel="icon" href="../image/logo.png">
        <title>Login/Registration</title>
    </head>
<body>
    <?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            echo "<div class='form'>
                  <h3>You are logged in successfully.</h3><br/>
                  <p class='link'>Click here to go to <a href='home.html'>Home</a></p>
                  <p class='link'>Click here to go to <a href='games.html'>Games Page</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <div class="hero">
        <header>
            <img src="image/logo.png" alt="" width=80px>
            <h1>KIDS</h1>
                <ul>
                    <li>
                        <a href="index.html" target="_blank">Home</a>
                      </li>
                    <li>
                      <a href="login.php" target="_blank">LogIn</a>
                    </li>
                    <li>
                      <a href="about_us.html" target="_blank">About Us</a>
                    </li>
                    <li>
                      <a href="" target="_blank">Quiz</a>
                    </li>
                    <li>
                        <a href="games.html" target="_blank">Games</a>
                    </li>
                </ul>
        </header>
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Login</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <div class="social">
                <a href=""><i class="fab fa-google"></i></a>
                <a href=""><i class="fab fa-twitter"></i></a>
                <a href=""><i class="fab fa-facebook-f"></i></a>
            </div>
            <form id="login" method="post" class="input-group">
                <input type="text" class="input-field" name="username" placeholder="User ID" required>
                <input type="password" class="input-field" name="password" placeholder="Password" required>
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <button type="submit" class="submit-btn">LOGIN</button>
            </form>
            <form id="register" method="request" class="input-group">
                <input type="text" class="input-field" name="username" placeholder="User ID" required>
                <input type="email" class="input-field" name="email" placeholder="Email ID" required>
                <input type="password" class="input-field" name="password" placeholder="Password" required>
                <input type="checkbox" class="check-box"><span>I agree to the terms and conditions</span>
                <button type="submit" name="submit" value="Register" class="submit-btn">REGISTER</button>
            </form>
        </div>
        <footer>
            <div class="footer-content">
                <h3>KIDS</h3>
                <p>Games for kids developed by kids</p>
                <ul class="socials">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
            <div class="footer-bottom">
                <p>copyright &copy;2023 KIDS. designed by <span>the team</span></p>
            </div>
        </footer>
    </div>
    <script>
        var x=document.getElementById("login");
        var y=document.getElementById("register");
        var z=document.getElementById("btn");

        function register(){
            x.style.left="-400px";
            y.style.left="50px";
            z.style.left="110px";
        }
        function login(){
            x.style.left="50px";
            y.style.left="450px";
            z.style.left="0";
        }
    </script>
    <?php
}
?>
</body>
</html>