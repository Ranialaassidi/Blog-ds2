<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'utilisateurs';
$username = 'root';
$password = '';

// Establishing a database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    // Check if the file is uploaded successfully
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        
        // Check if the uploads directory exists, if not, create it
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0755, true)) {
                die("Failed to create upload directory.");
            }
        }

        $image = $_FILES['image'];
        $target_file = $target_dir . basename($image['name']);
        
        // Validate and move the uploaded image
        $allowedTypes = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'];
        $fileType = $image['type'];
        $fileExt = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

        if (!array_key_exists($fileExt, $allowedTypes) || !in_array($fileType, $allowedTypes)) {
            die("Error: Please upload a valid image file.");
        }

        if (!move_uploaded_file($image['tmp_name'], $target_file)) {
            die("Error: Failed to move uploaded file.");
        }

        // Prepare SQL statement for insertion
        $stmt = $conn->prepare("INSERT INTO articles (title, content, image_path) VALUES (:title, :content, :imagePath)");
        
        // Bind parameters
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':imagePath', $target_file);
        
        // Execute the statement
        try {
            $stmt->execute();
            header('Location: article.php');
            exit;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Error: " . $_FILES['image']['error'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARTICLE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            background-image: url('bebo.jpg');
            background-size: cover;
        }
        .container {
            width: 800px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            color: white;
            background-color: #007bff;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div>
<button class="btn btn-danger"> <a href="home.php">Déconnexion</a></button><br><p></p>
        
    <div class="container">
   
        <h2>Post An Article</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="8" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image">
            </div>
            <button type="submit">Add Post</button>
        </form>
    </div>
    </div>
</body>
</html>
