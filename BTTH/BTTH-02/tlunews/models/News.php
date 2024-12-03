<?php
//models/News.php
require_once 'Database.php';

class News
{
    private $db;
    private $id;
    private $title;
    private $content;
    private $image;
    private $created_at;
    private $category_id;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Getter và Setter
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getImage()
    {
        return $this->image;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    public function getAllNews()
    {
        $sql = "SELECT news.*, categories.name as category_name FROM news JOIN categories ON news.category_id = categories.id";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    // models/News.php

    public function getNewsById($id)
    {
        $sql = "SELECT news.*, categories.name as category_name FROM news JOIN categories ON news.category_id = categories.id WHERE news.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function searchNews($keyword)
    {
        $sql = "SELECT news.*, categories.name as category_name FROM news JOIN categories ON news.category_id = categories.id WHERE news.title LIKE ? OR news.content LIKE ?";
        $stmt = $this->db->prepare($sql);
        $searchTerm = "%" . $keyword . "%";
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function addNews()
    {
        $sql = "INSERT INTO news (title, content, image, created_at, category_id) VALUES (?, ?, ?, NOW(), ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssi", $this->title, $this->content, $this->image, $this->category_id);
        return $stmt->execute();
    }

    public function deleteNews()
    {
        $sql = "DELETE FROM news WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}
