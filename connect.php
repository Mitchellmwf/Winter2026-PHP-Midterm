<?php
$host = 'localhost'; //host name
$db   = "book_manager"; //database name
$user = 'root'; //username
$password = ""; //password

//Points to the database
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

//Try to cnnect to the database, catch any errors
try {
    $pdo = new PDO ($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo "<p>Connection to the database failed: " . $e->getMessage() . "</p>";
}