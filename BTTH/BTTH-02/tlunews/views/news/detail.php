<!-- views/news/detail.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($newsItem['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <a href="index.php" class="btn btn-secondary mb-3">Back to Home</a>

        <h1><?= htmlspecialchars($newsItem['title']) ?></h1>
        <p><strong>Category:</strong> <?= htmlspecialchars($newsItem['category_name'] ?? 'Unknown') ?></p>
        <p><strong>Created At:</strong> <?= htmlspecialchars($newsItem['created_at']) ?></p>
        <p><strong>Content:</strong></p>
        <p><?= nl2br(htmlspecialchars($newsItem['content'])) ?></p>
        <p><strong>Image:</strong></p>
        <img src="<?= htmlspecialchars($newsItem['image']) ?>" alt="Image" class="img-fluid">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>