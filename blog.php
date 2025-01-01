<?php
include 'db.php';

// Fetch posts from the database
$sql = "SELECT posts.*, 
               COUNT(DISTINCT likes.id) AS like_count, 
               COUNT(DISTINCT comments.id) AS comment_count 
        FROM posts 
        LEFT JOIN likes ON posts.id = likes.post_id 
        LEFT JOIN comments ON posts.id = comments.post_id 
        GROUP BY posts.id 
        ORDER BY posts.created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll();
?>

<!-- Blog Page -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magical Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <script>
        function toggleCommentInput(postId) {
            const inputField = document.getElementById(`comment-input-${postId}`);
            inputField.style.display = inputField.style.display === 'none' || inputField.style.display === '' ? 'block' : 'none';
        }
    </script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
            <a href="index.php" class="text-xl font-bold text-gray-800 flex items-center mb-4 md:mb-0">
                <i class="fas fa-magic text-blue-600 mr-2"></i>Magical Words
            </a>
            <div class="flex items-center">
                <a href="index.html" class="text-gray-800 hover:text-blue-600 mr-4">Home</a>
                <input type="text" placeholder=" Search..." class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-auto">
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-blue-600 text-white py-12">
        <div class="w-full px-4 text-center">
            <h1 class="text-4xl font-bold">Welcome to Our Blog</h1>
            <p class="mt-4">Stay updated with the latest news and articles</p>
        </div>
    </header>

    <!-- Blog Posts -->
    <div class="w-full px-4 py-8">
        <?php foreach ($posts as $post): ?>
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4"><?php echo htmlspecialchars($post['title']); ?></h2>
                <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Detailed description of the post image" class="w-full h-auto rounded-lg mb-4" />
                <p class="text-gray-700 mb-4"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                <p class="text-gray-600 mb-4"><strong>By <?php echo htmlspecialchars($post['author']); ?></strong> on <?php echo $post['created_at']; ?></p>
                
                <!-- Like and Comment Buttons -->
                <div class="flex items-center mb-4">
                    <!-- Like Button -->
                    <form method="POST" action="like.php" class="mr-2">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">
                            <i class="fas fa-heart"></i> Like (<span><?php echo $post['like_count']; ?></span>)
                        </button>
                    </form>

                    <!-- Comment Button -->
                    <span class="text-blue-500 cursor-pointer text-2xl" onclick="toggleCommentInput(<?php echo $post['id']; ?>)">
                        <i class="fas fa-comment" style="font-size:40px;"></i> (<span><?php echo $post['comment_count']; ?></span>)
                    </span>
                </div>

                <!-- Comments Section -->
               <!-- Comments Section -->
<div class="border-t border-gray-200 pt-4">
    <?php
    $sql_comments = "SELECT * FROM comments WHERE post_id = :post_id";
    $stmt_comments = $pdo->prepare($sql_comments);
    $stmt_comments->execute(['post_id' => $post['id']]);
    $comments = $stmt_comments->fetchAll(); // Corrected line
    ?>
    <?php foreach ($comments as $comment): ?>
        <div class="bg-gray-100 rounded-lg p-4 mb-4">
            <p class="text-gray-800 font-bold"><?php echo htmlspecialchars($comment['author']); ?> said:</p>
            <p class="text-gray-700"><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
        </div>
    <?php endforeach; ?>

    <!-- Add Comment Input -->
    <div id="comment-input-<?php echo $post['id']; ?>" class="hidden mt-4">
        <form method="POST" action="comment.php">
            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
            <textarea name="comment" required class="w-full p-2 border border-gray-300 rounded-lg mb-2" placeholder="Add a comment"></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Post Comment</button>
        </form>
    </div>
</div>
            </div>
        <?php endforeach; ?>
    </div>

        <!-- Pagination -->
        <div class="container mx-auto px-4 py-4">
        <div class="flex justify-center">
            <nav>
                <ul class="flex space-x-2">
                    <li><a href="#" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">1</a></li>
                    <li><a href="#" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">2</a></li>
                    <li><a href="#" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">3</a></li>
                </ul>
            </nav>
        </div>
    </div>

       <!-- Footer -->
       <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Magical Words. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>