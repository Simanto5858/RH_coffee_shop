<?php
// Detect if running on a local development environment
// LOCAL SETTINGS (XAMPP)
    $server_name = "sql211.infinityfree.com";
    $user_name = "if0_40655840";       // XAMPP default user
    $password = "";            // XAMPP default password (empty)
    $db_name  = "if0_40655840_rh_coffee_shop";   // Your local database name (phpMyAdmin)

    // Local URLs (adjust to your folder name in htdocs)
    define("url", "http://rh-coffee-shop.rf.gd/RH-coffee-shop");
    define("ADMINURL", "http://rh-coffee-shop.rf.gd/RH-coffee-shop/admin-panel");

// Create MySQL connection
$conn = mysqli_connect($server_name, $user_name, $password, $db_name);

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
