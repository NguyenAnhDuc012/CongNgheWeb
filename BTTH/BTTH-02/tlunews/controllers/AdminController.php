<?php
// controllers/AdminController.php
require_once 'models/User.php';
require_once 'models/News.php';
require_once 'models/Category.php';

class AdminController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->login($username, $password);

            if ($user) {
                $_SESSION['user'] = [
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'role' => $user->getRole(),
                ];
                header("Location: index.php?controller=admin&action=dashboard");
                exit();
            } else {
                $error_message = "Invalid username or password!";
            }
        }

        require_once 'views/admin/login.php';
    }


    public function dashboard()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=admin&action=login");
            exit();
        }

        require_once 'views/admin/dashboard.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: index.php?controller=admin&action=login");
        exit();
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=admin&action=login");
            exit();
        }

        $newsModel = new News();
        $newsList = $newsModel->getAllNews();
        require_once 'views/admin/news/index.php';
    }

    public function addNews()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=admin&action=login");
            exit();
        }

        $Category = new Category();
        $Categories = $Category->getAllCategories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $category_id = $_POST['category_id'] ?? '';
            $image = $_FILES['image']['name'] ?? '';
            $image = uniqid('', true) . '.' . $image;
            $target = 'uploads/' . $image;

            // Kiểm tra và lưu ảnh
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $newsModel = new News();
                $newsModel->setTitle($title);
                $newsModel->setContent($content);
                $newsModel->setCategoryId($category_id);
                $newsModel->setImage($image);

                // Lưu bài viết
                $newsModel->addNews();

                header("Location: index.php?controller=admin&action=index");
                exit();
            } else {
                $error_message = "Failed to upload image.";
            }
        }

        require_once 'views/admin/news/add.php';
    }

    public function deleteNews($id)
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=admin&action=login");
            exit();
        }

        $newsModel = new News();
        $newsModel->setId($id);
        $newsModel->deleteNews();

        header("Location: index.php?controller=admin&action=index");
        exit();
    }
}
