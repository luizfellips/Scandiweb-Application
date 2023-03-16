<?php
include ("../../Module/Connection.class.php");
class ProductFactory
{
    protected static $productMap = [
        'DVD' => DVD::class,
        'Book' => Book::class,
        'Furniture' => Furniture::class

    ];

    public static function GenerateProduct($sku, $name, $price, $product_type, $attributes)
    {
        $product = self::$productMap[$product_type];
        return new $product($sku, $name, $price, ...array_values($attributes));
    }

    public static function Save($product){
            
            $connection = Connection::getConnection();
            $query = "INSERT INTO Products(sku,name,price,product_type) values (:sku,:name,:price,:product_type)";
            $stmt = $connection->prepare($query);
            $stmt->bindValue(':sku',$product->getSku());
            $stmt->bindValue(':name',$product->getName());
            $stmt->bindValue(':price',$product->getPrice());
            $stmt->bindValue(':product_type',$product->getProductType());
            $stmt->execute();
            
            //Variable columns and values count
            $attribute_columns = "SKU" . "," . (implode(",", array_keys($product->getAttributes())));
            $values_array = array_merge([$product->getSku()], array_values($product->getAttributes()));
            $placeholders = implode(',', array_fill(0, count($values_array), '?'));

            $second_query = "INSERT INTO Products_Attributes (" . $attribute_columns . ")  values (" . $placeholders . ")";
            $second_stmt = $connection->prepare($second_query);
            $second_stmt->execute($values_array);

    }

    
}