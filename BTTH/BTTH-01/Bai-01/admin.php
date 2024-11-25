<!-- file admin.php -->
<?php
session_start();
include 'flowers.php';

$successMessage = $_SESSION['success_message'] ?? null;
unset($_SESSION['success_message']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="container mt-5">
        <a href="create.php" class="btn btn-success mb-3">Thêm hoa</a>

        <?php if ($successMessage): ?>
            <div class="alert alert-success">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Ảnh 1</th>
                    <th>Ảnh 2</th>
                    <th>Tên ảnh</th>
                    <th>mô tả</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php if (!empty($flowers)): ?>
                    <?php foreach ($flowers as $flower): ?>
                        <tr>
                            <td><?php echo $flower['id']; ?></td>
                            <td><img src="<?php echo $flower['images'][0]; ?>" alt="Image 1" style="max-width: 100px; height: auto;"></td>
                            <td><img src="<?php echo $flower['images'][1]; ?>" alt="Image 2" style="max-width: 100px; height: auto;"></td>
                            <td><?php echo $flower['name']; ?></td>
                            <td><?php echo $flower['description']; ?></td>
                            <td>
                                <a href="update.php?id=<?php echo $flower['id']; ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                            </td>

                            <td>
                                <a href="delete.php?id=<?php echo $flower['id']; ?>" onclick="return confirm('Bạn muốn xóa hoa này không?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>