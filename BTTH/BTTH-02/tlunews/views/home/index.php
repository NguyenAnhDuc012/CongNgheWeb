<!-- views/home/index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1>Welcome to News</h1>
        
        <a href="index.php?controller=admin&action=login" class="btn btn-success mb-4">Login</a>

        <form action="index.php?controller=news&action=search" method="POST" class="mb-4">
            <input type="text" name="keyword" class="form-control" placeholder="Search news...">
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </form>

        <?php if (!empty($news)): ?>
            <ul class="list-group">
                <?php foreach ($news as $item): ?>
                    <li class="list-group-item mb-3">
                        <h5><a href="index.php?controller=news&action=detail&id=<?= $item['id'] ?>"><?= htmlspecialchars($item['title']) ?></a></h5>
                        <p><strong>Category:</strong> <?= htmlspecialchars($item['category_name'] ?? 'Unknown') ?></p>
                        <p><strong>Content:</strong> <?= htmlspecialchars($item['content']) ?></p>
                        <p><strong>Image:</strong> <?= htmlspecialchars($item['image']) ?></p>
                        <p><strong>Created At:</strong> <?= htmlspecialchars($item['created_at']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No news available.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>