<?php
// models/Category.php
require_once 'Database.php';
class Category
{
    private $db;
    private $id;
    private $name;

    // Constructor
    public function __construct($id = null, $name = null)
    {
        $this->id = $id;
        $this->name = $name;
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Getter and Setter for id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter and Setter for name
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // Lấy danh sách tất cả danh mục
    public function getAllCategories()
    {
        $query = "SELECT * FROM categories";
        $result = $this->db->query($query);
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = new Category($row['id'], $row['name']);
        }
        return $categories;
    }
}
