<?php

namespace ProductData;

abstract class Product
{
    protected $id;
    protected $sku;
    protected $name;
    protected $price;
    protected $type;


    protected function __construct(string $sku, string $name, int $price, string $type)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
    }

    abstract public function save($db);

    // Static function loads products of all types
    public static function load($db)
    {
        $stmt = $db->query("
SELECT 
    p.id, 
    p.sku, 
    p.name, 
    p.price,
    COALESCE(b.author, '') AS author,
    COALESCE(b.weight, '') AS weight,
    COALESCE(d.size, '') AS size,
    COALESCE(f.material, '') AS material,
    COALESCE(f.dimensions, '') AS dimensions
FROM 
    products p
LEFT JOIN 
    books b ON p.id = b.product_id
LEFT JOIN 
    dvds d ON p.id = d.product_id
LEFT JOIN 
    furniture f ON p.id = f.product_id;

        ");

        // fetchAll() uses FETCHASSOC by default because we set the default mode in our Database.php file
        $data = $stmt->fetchAll();


        return $data;
    }


    /* Static function deletes products from products table 
    and by extension the corresponding table because of cascading deletes config in our db*/
    public static function deleteByIds($pdo, $ids)
    {
        try {
            $placeholders = rtrim(str_repeat('?,', count($ids)), ',');
            $stmt = $pdo->prepare("DELETE FROM products WHERE id IN ({$placeholders})");
            $stmt->execute($ids);
            return true; // Successful delete
        } catch (\PDOException $e) {
            throw $e;
        }
    }


    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}
