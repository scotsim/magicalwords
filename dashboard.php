<?php
include 'db.php';

// Handle form submission for new post
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $image = $_FILES['image']['name'];
    $content = $_POST['content'];
    $author = "Your Name"; // You can modify this to dynamically get the logged-in user's name

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    // Insert post into the database
    $sql = "INSERT INTO posts (title, image, content, author) VALUES (:title, :image, :content, :author)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'image' => $target_file, 'content' => $content, 'author' => $author]);

    header("Location: success.php"); // Redirect to the blog page after publishing
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-4">
    <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md" data-toggle="modal" data-target="#postModal">
        + Create Post
    </button>
</div>

<!-- Modal -->
<div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50 hidden" id="postModal">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3">
        <div class="flex justify-between items-center p-4 border-b">
            <h5 class="text-xl font-semibold" id="postModalLabel">Create Post</h5>
            <button type="button" class="text-gray-500 hover:text-gray-700" data-bs-dismiss="modal" aria-label="Close" onclick="toggleModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="p-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Post Title:</label>
                <input type="text" name="title" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="title" />
                
                <label for="image" class="block text-sm font-medium text-gray-700 mt-4">Upload Image:</label>
                <input type="file" name="image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="image" />
                
                <label for="content" class="block text-sm font-medium text-gray-700 mt-4">Content:</label>
                <textarea name="content" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="content"></textarea>
            </div>
            <div class="flex justify-end p-4 border-t">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2" data-bs-dismiss="modal" onclick="toggleModal()">Close</button>
                <button type="submit" name="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Publish</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal() {
        const modal = document.getElementById('postModal');
        modal.classList.toggle('hidden');
    }

    document.querySelector('[data-toggle="modal"]').addEventListener('click', toggleModal);
    document.querySelector('[data-bs-dismiss="modal"]').addEventListener('click', toggleModal);
</script>

</body>
</html>