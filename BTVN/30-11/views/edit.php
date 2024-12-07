<!-- views/add.php -->
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
                <a href="index.php" class="btn btn-secondary mt-3">Back to list</a>
                <h2>Add New Product</h2>



                <form action="index.php?controller=product&action=edit&id=<?php echo $product->getId(); ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="<?php echo $product->getName(); ?>">
                        <?php if ($errors['name']): ?>
                            <div class="text-danger"><?php echo $errors['name']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description"><?php echo $product->getDescription(); ?></textarea>
                        <?php if ($errors['description']): ?>
                            <div class="text-danger"><?php echo $errors['description']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" value="<?php echo $product->getQuantity(); ?>">
                        <?php if ($errors['quantity']): ?>
                            <div class="text-danger"><?php echo $errors['quantity']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="price" value="<?php echo $product->getPrice(); ?>">
                        <?php if ($errors['price']): ?>
                            <div class="text-danger"><?php echo $errors['price']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" class="form-control" id="category_id">
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category->getId(); ?>" <?php echo $product->getCategoryId() == $category->getId() ? 'selected' : ''; ?>>
                                    <?php echo $category->getName(); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="d-flex">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="status" value="active" <?php echo $product->getStatus() == 'active' ? 'checked' : ''; ?>>
                                <label class="form-check-label">Active</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="inactive" <?php echo $product->getStatus() == 'inactive' ? 'checked' : ''; ?>>
                                <label class="form-check-label">Inactive</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                        <?php if ($errors['image']): ?>
                            <div class="text-danger"><?php echo $errors['image']; ?></div>
                        <?php endif; ?>
                        <div class="mt-2">
                            <img src="<?php echo $product->getImage(); ?>" alt="Product Image" style="width: 100px;">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>

            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>