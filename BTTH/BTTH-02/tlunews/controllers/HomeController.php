<?php
//controllers/HomeController.php
require_once 'models/News.php';

class HomeController
{
    public function index()
    {
        $newsModel = new News();
        $news = $newsModel->getAllNews();

        require_once 'views/home/index.php';
    }
}
