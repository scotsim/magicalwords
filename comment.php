<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $author = "Anonymous"; // Can be modified based on logged-in user

    // Insert comment into the database
    $sql = "INSERT INTO comments (post_id, author, content) VALUES (:post_id, :author, :content)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['post_id' => $post_id, 'author' => $author, 'content' => $comment]);

    header("Location: blog.php"); // Redirect back to the blog page
}
?>
