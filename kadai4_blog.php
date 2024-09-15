<?php
// Database connection setup
$host = 'localhost';
$dbname = 'kadai4_db'; // Update this to the actual database name (kadai4_db)
$username = 'root'; // Default MAMP username is 'root'
$password = 'root'; // Default MAMP password is 'root'

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

// Handle form submission to add a new blog post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $content = $_POST['content'];
    $tags = explode(',', $_POST['tags']); // Split the tags by commas

    // Insert the new post
    $stmt = $pdo->prepare("INSERT INTO posts (name, content, created_at) VALUES (?, ?, NOW())");
    $stmt->execute([$name, $content]);
    $post_id = $pdo->lastInsertId(); // Get the ID of the newly created post

    // Insert tags and link them to the post
    foreach ($tags as $tag_name) {
        $tag_name = trim($tag_name);

        // Check if the tag already exists
        $stmt = $pdo->prepare("SELECT id FROM tags WHERE name = ?");
        $stmt->execute([$tag_name]);
        $tag = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$tag) {
            // Tag doesn't exist, so insert it
            $stmt = $pdo->prepare("INSERT INTO tags (name) VALUES (?)");
            $stmt->execute([$tag_name]);
            $tag_id = $pdo->lastInsertId(); // Get the new tag ID
        } else {
            $tag_id = $tag['id'];
        }

        // Link the tag to the post
        $stmt = $pdo->prepare("INSERT INTO post_tag (post_id, tag_id) VALUES (?, ?)");
        $stmt->execute([$post_id, $tag_id]);
    }
}

// Fetch and display blog posts
$sql = "
    SELECT 
        posts.id, 
        posts.name, 
        posts.content, 
        posts.created_at, 
        GROUP_CONCAT(tags.name SEPARATOR ', ') AS tags
    FROM 
        posts
    LEFT JOIN 
        post_tag ON posts.id = post_tag.post_id
    LEFT JOIN 
        tags ON post_tag.tag_id = tags.id
    GROUP BY 
        posts.id
    ORDER BY 
        posts.created_at DESC
";

$stmt = $pdo->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all posts with associated tags
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blog System</title>
</head>
<body>
    <h1>Blog Posts</h1>
    <?php foreach ($posts as $post): ?>
        <div>
            <h2><?php echo htmlspecialchars($post['name']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
            <p><strong>Tags:</strong> <?php echo htmlspecialchars($post['tags']); ?></p>
            <p><em>Posted on: <?php echo $post['created_at']; ?></em></p>
        </div>
        <hr>
    <?php endforeach; ?>

    <h2>Add a New Post</h2>
    <form action="kadai4_blog.php" method="post">
        <label for="name">Post Title:</label>
        <input type="text" name="name" id="name" required><br><br>
        
        <label for="content">Content:</label><br>
        <textarea name="content" id="content" rows="5" cols="40" required></textarea><br><br>

        <label for="tags">Tags (comma-separated):</label><br>
        <input type="text" name="tags" id="tags" required><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
