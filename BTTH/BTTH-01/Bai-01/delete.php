<?php
session_start();
include 'flowers.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    foreach ($flowers as $key => $flower) {
        if ($flower['id'] == $id) {
            unset($flowers[$key]);
            break;
        }
    }

    file_put_contents('flowers.php', '<?php $flowers = ' . var_export($flowers, true) . ';');
    $_SESSION['success_message'] = 'Đã xóa hoa thành công!';
    header('Location: admin.php');
    exit;
} else {
    header('Location: index.php');
    exit;
}
