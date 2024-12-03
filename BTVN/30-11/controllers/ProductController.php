<!-- controllers/ProductController.php -->
<?php
require_once 'services/ProductService.php';
require_once 'services/CategoryService.php';


class ProductController
{
    private $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index()
    {
        $productService = new ProductService();
        $products = $productService->getAllProducts();

        $categoryService = new CategoryService();
        $categories = $categoryService->getAllCategories();

        include 'views/index.php';
    }

    public function add()
    {
        $errorMessages = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $status = $_POST['status'];
            $category_id = $_POST['category_id'];

            if (empty($name) || empty($description) || empty($quantity) || empty($price) || empty($category_id)) {
                $errorMessages[] = "All fields are required!";
            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageUploadResult = $this->uploadImage($_FILES['image']);
                if (strpos($imageUploadResult, 'Error') === false && strpos($imageUploadResult, 'Invalid') === false && strpos($imageUploadResult, 'too large') === false) {
                    $image = $imageUploadResult;
                } else {
                    $errorMessages[] = $imageUploadResult;
                }
            } else {
                $errorMessages[] = "Image is required!";
            }

            if (empty($errorMessages)) {
                $product = new Product(null, $image, $name, $description, $quantity, $price, $status, $category_id);
                if ($this->productService->addProduct($product)) {
                    header("Location: index.php?controller=product&action=index&success=true");
                    exit();
                } else {
                    $errorMessages[] = "Error adding product!";
                }
            }
        }

        $categoryService = new CategoryService();
        $categories = $categoryService->getAllCategories();
        include 'views/add.php';
    }


    private function uploadImage($file)
    {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($file['name']);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 2000000;

        if ($file['size'] > $maxFileSize) {
            return "File is too large. Maximum size is 2MB.";
        }

        $fileExtension = pathinfo($uploadFile, PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            return "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
        }

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            return $uploadFile;
        } else {
            return "Error uploading file.";
        }
    }


    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        $currentImage = $product->getImage();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product->setName($_POST['name']);
            $product->setDescription($_POST['description']);
            $product->setQuantity($_POST['quantity']);
            $product->setPrice($_POST['price']);
            $product->setStatus($_POST['status']);
            $product->setCategoryId($_POST['category_id']);

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageUploadResult = $this->uploadImage($_FILES['image']);
                if (strpos($imageUploadResult, 'Error') === false && strpos($imageUploadResult, 'Invalid') === false && strpos($imageUploadResult, 'too large') === false) {
                    $product->setImage($imageUploadResult);
                } else {
                    $errorMessages[] = $imageUploadResult;
                }
            } else {
                $product->setImage($currentImage);
            }

            if (empty($errorMessages)) {
                if ($this->productService->updateProduct($product)) {
                    header("Location: index.php?controller=product&action=index&success=true");
                    exit();
                } else {
                    $errorMessages[] = "Error updating product!";
                }
            }
        }

        $categoryService = new CategoryService();
        $categories = $categoryService->getAllCategories();
        include 'views/edit.php';
    }


    public function delete($id)
    {
        if ($this->productService->deleteProduct($id)) {
            header("Location: index.php?controller=product&action=index&success=true");
            exit();
        } else {
            echo "Error deleting product!";
        }
    }
}
?>