<?php
// controllers/NewsController.php
require_once 'models/News.php';

class NewsController
{
    public function detail($id)
    {
        $newsModel = new News();
        $newsItem = $newsModel->getNewsById($id);

        if ($newsItem) {
            require_once 'views/news/detail.php';
        } else {
            echo "News not found!";
        }
    }

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $keyword = $_POST['keyword'] ?? '';
            $newsModel = new News();
            $news = $newsModel->searchNews($keyword);
            require_once 'views/home/index.php';
        }
    }
}
