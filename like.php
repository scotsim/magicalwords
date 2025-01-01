<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $user_ip = $_SERVER['REMOTE_ADDR'];

    // Insert like into the database
    $sql = "INSERT INTO likes (post_id, user_ip) VALUES (:post_id, :user_ip)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['post_id' => $post_id, 'user_ip' => $user_ip]);

    header("Location: blog.php"); // Redirect back to the blog page
}
?>
