<!-- file products.php -->

<?php
$productsFile = 'products.json';

if (!file_exists($productsFile)) {
    file_put_contents($productsFile, json_encode([]));
}

$products = json_decode(file_get_contents($productsFile), true);
