<?php
session_start();
include 'products.php';

$errors = [];

function displayError($errors, $field)
{
    return !empty($errors[$field]) ? "<div class='form-text text-danger'>{$errors[$field]}</div>" : '';
}

function validateProduct($data, &$errors)
{
    if (empty($data['name'])) {
        $errors['name'] = 'Product name is required.';
    }
    if (empty($data['category'])) {
        $errors['category'] = 'Category is required.';
    }
    if (empty($data['status'])) {
        $errors['status'] = 'Status is required.';
    }
    if (empty($data['description'])) {
        $errors['description'] = 'Description is required.';
    }
    if (!is_numeric($data['quantity']) || $data['quantity'] <= 0) {
        $errors['quantity'] = 'Quantity must be a positive number.';
    }
    if (!is_numeric($data['price']) || $data['price'] <= 0) {
        $errors['price'] = 'Price must be a positive number.';
    }
    return empty($errors);
}

function handleImageUpload($image, $currentImage = null)
{
    $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
    if ($image && $image['error'] === 0) {
        $imageName = $image['name'];
        $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);

        if (!in_array(strtolower($imageExt), $allowedExts)) {
            return ['error' => 'Invalid image format. Only jpg, jpeg, png, and gif are allowed.'];
        }

        $newImageName = 'product_' . time() . '.' . $imageExt;
        $imageUploadPath = 'uploads/' . $newImageName;

        if (move_uploaded_file($image['tmp_name'], $imageUploadPath)) {
            return ['path' => $imageUploadPath];
        } else {
            return ['error' => 'Failed to upload image.'];
        }
    }
    return $currentImage ? ['path' => $currentImage] : ['error' => 'Please upload a valid image.'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'] ?? null;
    if ($id === null) {
        die('Product ID is required');
    }

    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $description = $_POST['description'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $price = $_POST['price'] ?? '';
    $status = $_POST['statusRbtn'] ?? '';
    $image = $_FILES['image'] ?? null;

    $productToEdit = null;
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            $productToEdit = $product;
            break;
        }
    }

    if (!$productToEdit) {
        die('Product not found');
    }

    $currentImage = $productToEdit['image'] ?? null;

    $data = compact('name', 'category', 'description', 'quantity', 'price', 'status');

    if (validateProduct($data, $errors)) {
        $imageResult = handleImageUpload($image, $currentImage);
        if (isset($imageResult['error'])) {
            $errors['image'] = $imageResult['error'];
        }

        if (empty($errors)) {
            foreach ($products as $key => &$product) {
                if ($product['id'] == $id) {
                    $product['name'] = $name;
                    $product['category'] = $category;
                    $product['description'] = $description;
                    $product['quantity'] = (int)$quantity;
                    $product['price'] = (float)$price;
                    $product['status'] = $status;

                    if (isset($imageResult['path'])) {
                        $product['image'] = $imageResult['path'];
                    }

                    file_put_contents($productsFile, json_encode($products, JSON_PRETTY_PRINT));

                    $_SESSION['success_message'] = 'Product updated successfully!';
                    header('Location: index.php');
                    exit;
                }
            }
            $errors['general'] = 'Product not found.';
        }
    }
} else {
    $id = $_GET['id'] ?? null;
    if ($id === null) {
        die('Product ID is required');
    }

    $productToEdit = null;
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            $productToEdit = $product;
            break;
        }
    }

    if (!$productToEdit) {
        die('Product not found');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Edit Product</h1>
        <a href="index.php" class="btn btn-success mb-3">Back</a>

        <?php if (!empty($errors['general'])): ?>
            <div class="alert alert-danger"><?= $errors['general'] ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($productToEdit['name'] ?? '') ?>">
                <?= displayError($errors, 'name') ?>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-control" id="category" name="category">
                    <option value="Cate 1" <?= isset($productToEdit['category']) && $productToEdit['category'] === 'Cate 1' ? 'selected' : '' ?>>Cate 1</option>
                    <option value="Cate 2" <?= isset($productToEdit['category']) && $productToEdit['category'] === 'Cate 2' ? 'selected' : '' ?>>Cate 2</option>
                </select>
                <?= displayError($errors, 'category') ?>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($productToEdit['description'] ?? '') ?></textarea>
                <?= displayError($errors, 'description') ?>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?= htmlspecialchars($productToEdit['quantity'] ?? '') ?>">
                <?= displayError($errors, 'quantity') ?>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= htmlspecialchars($productToEdit['price'] ?? '') ?>">
                <?= displayError($errors, 'price') ?>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="statusRbtn" id="inStock" value="In Stock" <?= isset($productToEdit['status']) && $productToEdit['status'] === 'In Stock' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="inStock">In Stock</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="statusRbtn" id="outStock" value="Out of Stock" <?= isset($productToEdit['status']) && $productToEdit['status'] === 'Out of Stock' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="outStock">Out of Stock</label>
                </div>
                <?= displayError($errors, 'status') ?>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <?php if (!empty($productToEdit['image'])): ?>
                    <div>
                        <label>Current Image:</label>
                        <img src="<?= $productToEdit['image'] ?>" alt="Current Product Image" style="max-width: 100px; max-height: 100px;">
                    </div>
                <?php endif; ?>
                <?= displayError($errors, 'image') ?>
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</body>

</html>