<?php 
    //connect to database
    require "connect.php";

    // Get all orders (newest first)
    $sql = "SELECT * FROM reviews ORDER BY  created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $reviews = $stmt->fetchAll();

    //close connection
    $pdo = null;
?>

<h2>Books (Admin)</h2>

<?php if (empty($reviews)){
    echo "<p>No Reviews yet.</p>";} ?>

<div>
    <table>
        <thead>
            <tr>
            <th>Review </th>
            <th>Book title</th>
            <th>Book author</th>
            <th>Rating</th>
            <th>Review</th>
            <th>Time</th>
            </tr>
        </thead>

        <tbody>
            <!-- Loop through orders and show in table -->
            <?php foreach ($reviews as $review): ?>
                <tr>
                <td><?= htmlspecialchars($review['id']); ?></td>
                <td><?= htmlspecialchars($review['title']); ?></td>
                <td><?= htmlspecialchars($review['author']); ?></td>
                <td><?= htmlspecialchars($review['rating']); ?></td>
                <td><?= htmlspecialchars($review['review_text']); ?></td>
                <td><?= htmlspecialchars($review['created_at']); ?></td>
                <td>        
                    <a
                    href="update.php?id=<?= urlencode($review['id']); ?>">
                    Update
                    </a>
            </br>
                    <a
                    href="delete.php?id=<?= urlencode($review['id']); ?>"
                    onclick="return confirm('Are you sure you want to delete this review?');">
                    Delete
                    </a>
                </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>