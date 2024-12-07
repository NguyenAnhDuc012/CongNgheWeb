<!-- services/ProductService.php -->
<?php
require_once 'db/DBConnection.php';
require_once 'models/Product.php';

class ProductService
{
    private $db;

    public function __construct()
    {
        $this->db = new DBConnection();
    }

    public function getAllProducts()
    {
        $query = "SELECT * FROM products";
        $stmt = $this->db->getConnection()->query($query);

        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product($row['id'], $row['image'], $row['name'], $row['description'], $row['quantity'], $row['price'], $row['status'], $row['category_id']);
        }

        return $products;
    }

    public function getProductById($id)
    {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Product($row['id'], $row['image'], $row['name'], $row['description'], $row['quantity'], $row['price'], $row['status'], $row['category_id']);
        }

        return null;
    }

    public function addProduct($product)
    {
        $query = "INSERT INTO products (image, name, description, quantity, price, status, category_id) 
                  VALUES (:image, :name, :description, :quantity, :price, :status, :category_id)";
        $stmt = $this->db->getConnection()->prepare($query);

        $stmt->bindParam(':image', $product->getImage());
        $stmt->bindParam(':name', $product->getName());
        $stmt->bindParam(':description', $product->getDescription());
        $stmt->bindParam(':quantity', $product->getQuantity());
        $stmt->bindParam(':price', $product->getPrice());
        $stmt->bindParam(':status', $product->getStatus());
        $stmt->bindParam(':category_id', $product->getCategoryId());

        return $stmt->execute();
    }

    public function updateProduct($product)
    {
        $query = "UPDATE products SET image = :image, name = :name, description = :description, quantity = :quantity, 
                  price = :price, status = :status, category_id = :category_id WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($query);

        $stmt->bindParam(':image', $product->getImage());
        $stmt->bindParam(':name', $product->getName());
        $stmt->bindParam(':description', $product->getDescription());
        $stmt->bindParam(':quantity', $product->getQuantity());
        $stmt->bindParam(':price', $product->getPrice());
        $stmt->bindParam(':status', $product->getStatus());
        $stmt->bindParam(':category_id', $product->getCategoryId());
        $stmt->bindParam(':id', $product->getId());

        return $stmt->execute();
    }

    public function deleteProduct($id)
    {
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>