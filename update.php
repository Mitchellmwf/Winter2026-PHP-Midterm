
<?php 
    //Grab and ensure id is valid
    $reviewID = $_GET['id'];
    if (empty($reviewID) || $reviewID < 0) {
        echo "<p>Invalid Review ID. Please go back and try again.</p><p>You will be redirected to the homepage in 3 seconds.</p>
        <p>If you are not redirected, click <a href='admin.php'>here</a>.</p>";
        header("refresh:3;url=admin.php");
        exit;
    }

    //connect to database
    require "connect.php";

    //get the review info using a prepared statement
    $sql = "SELECT * FROM reviews WHERE id = :id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $reviewID);
    $stmt->execute();
    $reviews = $stmt->fetch();
    $pdo = null;

  ?>
  <!-- Display the update form, pre-filled with current review data -->
  <h1>Update Review #<?= htmlspecialchars($reviews['id']); ?></h1>
<form action='processUpdate.php?id=<?= urlencode($reviews['id']); ?>' method='post'>
    <fieldset>
        <label for="title">Book Title:</label>
        <input type="text" id="title" name="title" value='<?= htmlspecialchars($reviews['title']); ?>'>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" value='<?= htmlspecialchars($reviews['author']); ?>'>

        <label for="rating">Rating (1 to 5):</label>
        <input type="number" id="rating" name="rating" min="1" max="5" value='<?= htmlspecialchars($reviews['rating']); ?>'>

        <label for="review_text">Review:</label>
        <textarea id="review_text" name="review_text" rows="6"  cols="40"><?= htmlspecialchars($reviews['review_text']); ?></textarea>
    </fieldset>
    <button type='submit'>Update Info</button>
    <a href="admin.php">Back to homepage</button>
    <a href="delete.php?id=<?= urlencode($reviews['id']); ?>" onclick="return confirm('Are you sure you want to delete this Review?');">Delete Review</button>
</form>
</body>
</html>
