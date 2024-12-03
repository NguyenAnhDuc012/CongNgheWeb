<!-- views/admin/news/index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - News Management</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">News Management</h2>
        <a href="index.php?controller=admin&action=dashboard" class="btn btn-secondary mb-3">Back to dashboard</a>
        <!-- Table for listing news -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Content</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($newsList as $newsItem): ?>
                    <tr>
                        <td><?= htmlspecialchars($newsItem['id']) ?></td>
                        <td>
                            <?php if (!empty($newsItem['image'])): ?>
                                <img src="uploads/<?= htmlspecialchars($newsItem['image']) ?>" alt="News Image" style="width: 100px; height: auto;">
                            <?php else: ?>
                                <span>No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($newsItem['title']) ?></td>
                        <td><?= htmlspecialchars($newsItem['category_name']) ?></td>
                        <td><?= htmlspecialchars($newsItem['content']) ?></td>
                        <td>
                            <a href="index.php?controller=admin&action=editNews&id=<?= $newsItem['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?controller=admin&action=deleteNews&id=<?= $newsItem['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this news item?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Add New News button -->
        <a href="index.php?controller=admin&action=addNews" class="btn btn-primary">Add New News</a>
    </div>

    <!-- Link to Bootstrap JS and Popper.js (for responsive behavior) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>