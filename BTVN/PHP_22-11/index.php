<!-- file index.php -->

<?php
session_start();
include 'products.php';

if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];

    foreach ($products as $key => $product) {
        if ($product['id'] == $deleteId) {
            unset($products[$key]);
            break;
        }
    }

    $products = array_values($products);

    file_put_contents($productsFile, json_encode($products, JSON_PRETTY_PRINT));

    $_SESSION['success_message'] = 'Product deleted successfully!';
    header('Location: index.php');
    exit;
}

$successMessage = $_SESSION['success_message'] ?? null;
unset($_SESSION['success_message']);
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
    <?php include 'header.php'; ?>

    <div class="container mt-5 mb-5">
        <a href="create.php" class="btn btn-success mb-3">New product</a>

        <?php if ($successMessage): ?>
            <div class="alert alert-success">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td>
                                <?php if (!empty($product['image'])): ?>
                                    <img src="<?php echo $product['image']; ?>" alt="Product Image" style="width: 100px;">
                                <?php endif; ?>
                            </td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['description']; ?></td>
                            <td><?php echo $product['quantity']; ?></td>
                            <td><?php echo number_format($product['price'], 2); ?> USD</td>
                            <td><?php echo $product['category']; ?></td>
                            <td><?php echo $product['status']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $product['id']; ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a href="index.php?delete=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center text-muted">No data available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>