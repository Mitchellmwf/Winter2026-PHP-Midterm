<?php
    //Grab and ensure id is valid
    $r_id = $_GET['id'];
    if (empty($r_id) || $r_id <= 0) {
        echo "<p>Invalid Review ID.</p><p>You will be redirected to the homepage in 3 seconds.</p>
        <p>If you are not redirected, click <a href='admin.php'>here</a>.</p>";
        header("refresh:3;url=admin.php");
        exit;
    }

    //connect to database
    require "connect.php";

    //delete the Review using a prepared statement
    $sql = "DELETE FROM reviews WHERE id = :xid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':xid', $r_id);
    $stmt->execute();
    //close connection
    $pdo = null;
    
    //confirmation message
    echo "<h1>Deleted!</h1>
    <p>The Review has been deleted from the database.</p>";
    echo "<p>You will be redirected to the homepage in 3 seconds.</p>
    <p>If you are not redirected, click <a href='admin.php'>here</a>.</p>";
    //redirect to index after 3 seconds
    header("refresh:3;url=admin.php");
