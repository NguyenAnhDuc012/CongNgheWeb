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
        $result = $this->db->getConnection()->query($query);

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = new Product($row['id'], $row['image'], $row['name'], $row['description'], $row['quantity'], $row['price'], $row['status'], $row['category_id']);
        }

        return $products;
    }

    public function getProductById($id)
    {
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return new Product($row['id'], $row['image'], $row['name'], $row['description'], $row['quantity'], $row['price'], $row['status'], $row['category_id']);
        }

        return null;
    }

    public function addProduct($product)
    {
        $query = "INSERT INTO products (image, name, description, quantity, price, status, category_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bind_param("sssiisi", $product->getImage(), $product->getName(), $product->getDescription(), $product->getQuantity(), $product->getPrice(), $product->getStatus(), $product->getCategoryId());
        return $stmt->execute();
    }

    public function updateProduct($product)
    {
        $query = "UPDATE products SET image = ?, name = ?, description = ?, quantity = ?, price = ?, status = ?, category_id = ? WHERE id = ?";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bind_param("sssiisii", $product->getImage(), $product->getName(), $product->getDescription(), $product->getQuantity(), $product->getPrice(), $product->getStatus(), $product->getCategoryId(), $product->getId());
        return $stmt->execute();
    }

    public function deleteProduct($id)
    {
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>