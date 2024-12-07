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
        $errors = [
            'name' => '',
            'description' => '',
            'quantity' => '',
            'price' => '',
            'category_id' => '',
            'image' => '',
        ];


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $status = isset($_POST['status']) ? $_POST['status'] : 'active';
            $category_id = $_POST['category_id'];
            $image = null;

            if (empty($name)) {
                $errors['name'] = "Product name is required!";
            }

            if (empty($description)) {
                $errors['description'] = "Description is required!";
            }

            if (empty($quantity)) {
                $errors['quantity'] = "Quantity is required!";
            }

            if (empty($price)) {
                $errors['price'] = "Price is required!";
            }

            if (empty($category_id)) {
                $errors['category_id'] = "Category is required!";
            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageUploadResult = $this->uploadImage($_FILES['image']);
                if (strpos($imageUploadResult, 'Error') === false && strpos($imageUploadResult, 'Invalid') === false && strpos($imageUploadResult, 'too large') === false) {
                    $image = $imageUploadResult;
                } else {
                    $errors['image'] = $imageUploadResult;
                }
            }

            if (empty(array_filter($errors))) {
                $product = new Product(null, $image, $name, $description, $quantity, $price, $status, $category_id);
                if ($this->productService->addProduct($product)) {
                    $_SESSION['success_message'] = "Product added successfully!";
                    header("Location: index.php?controller=product&action=index");
                    exit();
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
        if (!$product) {
            header("Location: index.php?controller=product&action=index&error=Product not found!");
            exit();
        }

        $categoryService = new CategoryService();
        $categories = $categoryService->getAllCategories();

        $errors = [
            'name' => '',
            'description' => '',
            'quantity' => '',
            'price' => '',
            'category_id' => '',
            'image' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $status = isset($_POST['status']) ? $_POST['status'] : 'active';
            $category_id = $_POST['category_id'];
            $image = $product->getImage();

            if (empty($name)) {
                $errors['name'] = "Product name is required!";
            }

            if (empty($description)) {
                $errors['description'] = "Description is required!";
            }

            if (empty($quantity)) {
                $errors['quantity'] = "Quantity is required!";
            }

            if (empty($price)) {
                $errors['price'] = "Price is required!";
            }

            if (empty($category_id)) {
                $errors['category_id'] = "Category is required!";
            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageUploadResult = $this->uploadImage($_FILES['image']);
                if (strpos($imageUploadResult, 'Error') === false && strpos($imageUploadResult, 'Invalid') === false && strpos($imageUploadResult, 'too large') === false) {
                    $image = $imageUploadResult;
                } else {
                    $errors['image'] = $imageUploadResult;
                }
            }

            if (empty(array_filter($errors))) {
                $product->setName($name);
                $product->setDescription($description);
                $product->setQuantity($quantity);
                $product->setPrice($price);
                $product->setStatus($status);
                $product->setCategoryId($category_id);
                $product->setImage($image);

                if ($this->productService->updateProduct($product)) {
                    $_SESSION['success_message'] = "Product updated successfully!";
                    header("Location: index.php?controller=product&action=index");
                    exit();
                }
            }
        }

        include 'views/edit.php';
    }

    public function delete($id)
    {
        if ($this->productService->deleteProduct($id)) {
            $_SESSION['success_message'] = "Product deleted successfully!";
            header("Location: index.php?controller=product&action=index");
            exit();
        } else {
            echo "Error deleting product!";
        }
    }
}
?>