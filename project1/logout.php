
<?php 
    // session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();

    setcookie('dewi', '', time() - 3600 );
    setcookie('marsita', '', time() - 3600 );

    header("Location: login.php");
    exit;

?>