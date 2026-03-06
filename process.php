<?php

    //Sanitize taskName input
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
    $author = trim(filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS));
    $review = trim(filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_SPECIAL_CHARS));
    $rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);
    
    //validate rating input
    if ($rating > 5 || $rating < 1) {
        echo "<p>Invalid rating. Please go back and select a valid option.</p><p>You will be redirected to the homepage in 3 seconds.</p>
        <p>If you are not redirected, click <a href='index.php'>here</a>.</p>";
        header("refresh:3;url=index.php");
        exit;
    }

    //make sure review is not empty
    if (empty($review) || $review == '' || $review == null) {
        echo "<p>Review cannot be empty.</p><p>You will be redirected to the homepage in 3 seconds.</p>
        <p>If you are not redirected, click <a href='index.php'>here</a>.</p>";
        header("refresh:3;url=index.php");
        exit;
    }
    //make sure author is not empty
    if (empty($author) || $author == '' || $author == null) {
        echo "<p>Author cannot be empty.</p><p>You will be redirected to the homepage in 3 seconds.</p>
        <p>If you are not redirected, click <a href='index.php'>here</a>.</p>";
        header("refresh:3;url=index.php");
        exit;
    }
    //make sure author is not empty
    if (empty($title) || $title == '' || $title == null) {
        echo "<p>Title cannot be empty.</p><p>You will be redirected to the homepage in 3 seconds.</p>
        <p>If you are not redirected, click <a href='index.php'>here</a>.</p>";
        header("refresh:3;url=index.php");
        exit;
    }


    /* INSERT THE ORDER USING A PREPARED STATEMENT*/
    //connect to database
    require "connect.php";

    //set up the query used named placeholders
    $sql = "INSERT INTO reviews(title, author, rating, review_text) VALUES (:title, :author, :rating, :review_text);";
        //task_id will auto increment

    //prepare the query 
    $stmt = $pdo->prepare($sql); 

    //bind parameters
    $stmt->bindParam(':title', $title); 
    $stmt->bindParam(':author', $author); 
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':review_text', $review);
    
    //execute the query, matching the placeholder with the data entered by user
    $stmt->execute(); 

    //close connection 
    $pdo = null; 

    //confirmation message
    echo "<h1>Confirmed!</h1>
    <p>Your Review has been added to the database.</p>";

    echo "<p>You will be redirected to the homepage in 3 seconds.</p>
    <p>If you are not redirected, click <a href='index.php'>here</a>.</p>";

    //redirect to index after 3 seconds
    header("refresh:3;url=index.php");
    ?>
