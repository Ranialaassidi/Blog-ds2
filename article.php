<?php
require('connexion.php');
session_start();

// Assume user_id comes from the session
$user_id = $_SESSION['user_id'] ?? null;

// Fetch articles with like and comment counts
$stmt = $conn->prepare("SELECT a.*, 
    (SELECT COUNT(*) FROM likes WHERE article_id = a.id) AS like_count,
    EXISTS(SELECT 1 FROM likes WHERE article_id = a.id AND user_id = :userId) AS is_liked,
    image_path
FROM articles a ORDER BY created_at DESC");

$stmt->bindParam(':userId', $user_id);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Articles</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .article {
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .article:last-child {
            border-bottom: none;
        }
        .article h3 {
            color: #333;
            margin-top: 0;
        }
        .article p {
            color: #666;
            line-height: 1.6;
        }
        .article strong {
            color: #333;
        }
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 15px;
            }
        }
        h2 {
            text-align: center;
        }
        /* Styles for buttons */
        .btn-outline-primary {
            margin-right: 10px;
        }
        .likes-count {
            font-size: 0.9rem;
            vertical-align: middle;
        }
        /* Styles for the comment section */
        .comments-list {
            border-top: 1px solid #eaecef;
            padding-top: 15px;
        }
        .comments-list .comment {
            padding: 5px 0;
            list-style-type: none;
        }
        .comment .comment-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .comment .comment-text {
            margin-left: 10px;
            font-size: 0.9rem;
        }
        .comment .comment-author {
            font-weight: bold;
            font-size: 0.9rem;
        }
        .comment .comment-date {
            font-size: 0.8rem;
            color: #777;
        }
        /* Adjustments for mobile */
        @media (max-width: 576px) {
            .comments-list .comment .comment-text {
                margin-left: 5px;
            }
        }
        a {
            text-decoration: none;
            color: white;
        }
        .imgg{
            max-width:600px;
            
        }
       
    </style>
</head>
<body>
<form action="logout.php" method="POST">
        <button type="submit" class="btn btn-danger">Déconnexion</button><br><p></p>
        <button type="submit" class="btn btn-primary"><a href="articles.php">Voir plus</a></button><br><p></p>
        <button type="submit" class="btn btn-primary"><a href="ajoutArticle.php">Créer un article</a></button>
        <button type="submit" class="btn btn-primary"><a href="dis.php">discuter</a></button>
    </form>
    <div class="container mt-5">
    <h2 class="mb-4">List of Articles</h2>
    <?php foreach ($articles as $article): ?>
    <div class="card mb-3">
        <div class="card-body">
            <h3 class="card-title"><?php echo htmlspecialchars($article['title']); ?></h3>
            <?php if (!empty($article['image_path'])): ?>
                <!-- Ensure the image path is correct -->
                <img class="imgg" src="<?php echo htmlspecialchars($article['image_path']); ?>" alt="Article Image">
            <?php endif; ?>
            <p class="card-text"><?php echo htmlspecialchars($article['content']); ?></p>
            <p class="text-muted"><strong>Date: <?php echo htmlspecialchars($article['created_at']); ?></strong></p>
            <!-- Like button and status -->
            <form action="like_article.php" method="POST">
                <input type="hidden" name="article_id" value="<?php echo $article['id']; ?>">
                <button type="submit" class="btn btn-primary"><?php echo $article['is_liked'] ? 'Liked!' : 'Like'; ?></button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</div>

    </div>
</body>
</html>