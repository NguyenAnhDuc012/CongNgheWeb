<!-- file create.php -->
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

function handleImageUpload($image)
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
    return ['error' => 'Please upload a valid image.'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $description = $_POST['description'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $price = $_POST['price'] ?? '';
    $status = $_POST['statusRbtn'] ?? '';
    $image = $_FILES['image'] ?? null;

    $data = compact('name', 'category', 'description', 'quantity', 'price', 'status');

    if (validateProduct($data, $errors)) {
        $imageResult = handleImageUpload($image);
        if (isset($imageResult['error'])) {
            $errors['image'] = $imageResult['error'];
        } else {
            if (!empty($products)) {
                $maxId = max(array_column($products, 'id'));
            } else {
                $maxId = 0;
            }

            $newProduct = [
                'id' => $maxId + 1,
                'name' => $name,
                'category' => $category,
                'description' => $description,
                'quantity' => (int)$quantity,
                'price' => (float)$price,
                'status' => $status,
                'image' => $imageResult['path'],
            ];

            $products[] = $newProduct;
            file_put_contents($productsFile, json_encode($products, JSON_PRETTY_PRINT));

            $_SESSION['success_message'] = 'Product added successfully!';
            header('Location: index.php');
            exit;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BT Buổi 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h1 class="mb-3 mt-5 text-center">Add new product</h1>
                <a href="index.php" class="btn btn-success mb-3">Back</a>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">Please fix the errors below and try again.</div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($data['name'] ?? '') ?>">
                        <?= displayError($errors, 'name') ?>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category" name="category">
                            <option value="Cate 1" <?= isset($data['category']) && $data['category'] === 'Cate 1' ? 'selected' : '' ?>>Cate 1</option>
                            <option value="Cate 2" <?= isset($data['category']) && $data['category'] === 'Cate 2' ? 'selected' : '' ?>>Cate 2</option>
                        </select>

                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
                        <?= displayError($errors, 'description') ?>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="<?= htmlspecialchars($data['quantity'] ?? '') ?>">
                            <?= displayError($errors, 'quantity') ?>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= htmlspecialchars($data['price'] ?? '') ?>">
                            <?= displayError($errors, 'price') ?>
                        </div>


                        <div class="mb-3">
                            <label for="abcxyz" class="form-label">Status</label>
                            <div>
                                <div class="form-check form-check-inline mb-3">
                                    <input class="form-check-input" type="radio" name="statusRbtn" id="inStock" value="In Stock" <?= isset($data['status']) && $data['status'] === 'In Stock' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="inStock">In Stock</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="statusRbtn" id="outStock" value="Out of Stock" <?= isset($data['status']) && $data['status'] === 'Out of Stock' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="outStock">Out of Stock</label>
                                </div>
                                <?= displayError($errors, 'status') ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <?= displayError($errors, 'image') ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Product</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>