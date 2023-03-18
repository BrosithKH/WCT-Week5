<?php

class Post {
    public function __construct(
        public int $id,
        public string $title,
        public string $content,
        public string $imageUrl
    ) {}
}

session_start();
// Create some default posts if none exist
if (!isset($_SESSION['posts'])) {
    $_SESSION['posts'] = [
        new Post(1, 'Post 1', 'Content 1', '../assets/upload/123-300x200.jpg'),
        new Post(2, 'Post 2', 'Content 2', '../assets/upload/123-300x200.jpg'),
        new Post(3, 'Post 3', 'Content 3', '../assets/upload/123-300x200.jpg')
    ];
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the values from the form
    $id = count($_SESSION['posts'], COUNT_NORMAL) + 1;
    $title = $_POST['title'];
    $content = $_POST['content'];
    $imageUrl= $_POST['image'];

    // Upload the image file to the server
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['image']['tmp_name'];
        $name = basename($_FILES['image']['name']);
        $imagePath = "../assets/upload/$name"; // store the uploaded image file path
        move_uploaded_file($tmpName, $imagePath);
    }
    
    // Create a new post object with the submitted values
    $newPost = new Post($id, $title, $content, $imagePath);
    

    // Add the new post to the array of posts
    $_SESSION['posts'][] = $newPost;

    // Redirect the user to the same page to prevent form resubmission
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
}


?>