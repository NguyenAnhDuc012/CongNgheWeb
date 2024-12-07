<!-- views/index.php -->
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
        <a href="index.php?controller=product&action=add" class="btn btn-success mb-3">New product</a>

        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<div id="success-message" class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        ?>

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
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product->getId(); ?></td>
                        <td><img src="<?php echo $product->getImage(); ?>" alt="Product Image" style="width: 100px;"></td>
                        <td><?php echo $product->getName(); ?></td>
                        <td><?php echo $product->getDescription(); ?></td>
                        <td><?php echo $product->getQuantity(); ?></td>
                        <td><?php echo number_format($product->getPrice(), 2); ?> USD</td>
                        <td>
                            <?php
                            $category = null;
                            foreach ($categories as $cat) {
                                if ($cat->getId() == $product->getCategoryId()) {
                                    $category = $cat;
                                    break;
                                }
                            }
                            echo $category ? $category->getName() : 'N/A';
                            ?>
                        </td>
                        <td><?php echo $product->getStatus(); ?></td>
                        <td><a href="index.php?controller=product&action=edit&id=<?php echo $product->getId(); ?>" class="btn btn-warning">Edit</a></td>
                        <td><a href="index.php?controller=product&action=delete&id=<?php echo $product->getId(); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        window.onload = function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 2000);
            }
        };
    </script>

</body>

</html>