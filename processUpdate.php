<?php   
    //Grab and ensure id is valid
    $r_id = $_GET['id'];
    if (empty($r_id) || $r_id <= 0) {
        echo "<p>Invalid ID. Please go back and try again.</p><p>You will be redirected to the homepage in 3 seconds.</p>
        <p>If you are not redirected, click <a href='admin.php'>here</a>.</p>";
        header("refresh:3;url=admin.php");
        exit;
    }

    //connect to database
    require "connect.php";
    //update the review using a prepared statement
    $sql = "UPDATE reviews SET title = :xtitle, author = :xauthor, rating = :rating, review_text = :xreview WHERE id = :xid";
    $stmt = $pdo->prepare($sql);

    //sanitize
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
    $author = trim(filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS));
    $review = trim(filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_SPECIAL_CHARS));
    $rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);

    //validate
    if ($_POST['rating'] < 0 || $_POST['rating'] > 5) {
        echo "<p>Rating must be between 1-5.</p>
        <p>You will be redirected to the homepage in 3 seconds.</p>
        <p>If you are not redirected, click <a href='admin.php'>here</a>.</p>";
        header("refresh:3;url=admin.php");
        exit;
    }
    //make sure review is not empty
    if (empty($review) || $review == '' || $review == null) {
        echo "<p>Review cannot be empty.</p><p>You will be redirected to the homepage in 3 seconds.</p>
        <p>If you are not redirected, click <a href='index.php'>here</a>.</p>";
        header("refresh:3;url=admin.php");
        exit;
    }
    //make sure author is not empty
    if (empty($author) || $author == '' || $author == null) {
        echo "<p>Author cannot be empty.</p><p>You will be redirected to the homepage in 3 seconds.</p>
        <p>If you are not redirected, click <a href='index.php'>here</a>.</p>";
        header("refresh:3;url=admin.php");
        exit;
    }
    //make sure title is not empty
    if (empty($title) || $title == '' || $title == null) {
        echo "<p>Title cannot be empty.</p><p>You will be redirected to the homepage in 3 seconds.</p>
        <p>If you are not redirected, click <a href='index.php'>here</a>.</p>";
        header("refresh:3;url=admin.php");
        exit;
    }

    $stmt->bindParam(':xtitle', $title);
    $stmt->bindParam(':xauthor', $author);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':xreview', $review);
    $stmt->bindParam(':xid', $r_id);
    $stmt->execute();
    $pdo = null;

    //confirmation message
    echo "<h1>Updated!</h1>
    <p>The review has been updated in the database.</p>";
    echo "<p>You will be redirected to the homepage in 3 seconds.</p>
    <p>If you are not redirected, click <a href='admin.php'>here</a>.</p>";
    //redirect to index after 3 seconds
    header("refresh:3;url=admin.php");
    ?>