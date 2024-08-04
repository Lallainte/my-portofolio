
<?php 
require 'functions.php';
session_start();

// ada cookie engga?
if(isset($_COOKIE['dewi']) && isset($_COOKIE['marsita']) ) {
    $dewi = $_COOKIE['dewi'];
    $marsita = $_COOKIE['marsita'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $dewi");
    $row = mysqli_fetch_assoc($result);

    // cek cokiee dan username
    if($marsita === hash('ripemd160', $row['username'])) {
        $_SESSION['login'] = true;
    }
  
}

if(isset($_SESSION["login"])) {
    header( "Location: index.php");
    exit;
}


     if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

     $result =   mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //  cek username
    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // cek session
            $_SESSION["login"] = true;
            // cek remember me
            if(isset($_POST['remember'])) {
                // buat cookie
                setcookie('dewi', $row['id'], time() + 86400);
                setcookie('marsita', hash('ripemd160', $row['username']), time() + 86400);
            }


            header("Location: index.php");
            exit;
        };
     }

     $error = true;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>
<body class="body-login">
    <?php if(isset($error)) : ?>
        <p style="color: red; font-style: italic;"  >Username / Password salah</p>
    <?php endif; ?>
    
<!-- login start -->
<div class="login-box">
    <h2>Login</h2>
    <form action="" method="post" >
      <div class="user-box">
          <input type="text" name="username" id="username">
            <label for="username">Username</label>
      </div>
      <div class="user-box">
          <input type="password" name="password" id="password">
            <label for="password">Password</label>
      </div>
      <div class="user-box">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>
      </div>
      <!-- <div class="user-box">
      <a href="registrasi.php">Sign Up!</a>
      </div> -->
      <button type="submit" name="login" >
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Login
        </button>
    </form>
  </div>
<!-- login end -->

</body>
</html>