<!-- services/ProductService.php -->
<?php
require_once 'db/DBConnection.php';
require_once 'models/Category.php';

class CategoryService
{
    private $db;

    public function __construct()
    {
        $this->db = new DBConnection();
    }

    public function getAllCategories()
    {
        $query = "SELECT * FROM category";
        $stmt = $this->db->getConnection()->query($query);

        $categories = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Category($row['id'], $row['name']);
        }

        return $categories;
    }
}
?>