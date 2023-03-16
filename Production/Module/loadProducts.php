<?php
include_once "../Module/Connection.class.php";

try {
    
    $conn = Connection::getConnection();
    $query = "select t1.ID, t1.sku, t1.name,t1.price,t2.size,t2.weight, concat(t2.length,'x',t2.width,'x',t2.height) as dimensions
    from products as t1
    inner join products_attributes t2 on t1.sku = t2.sku order by ID;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $products = array_map(function ($item) {
            return array_filter(
                $item,
                function ($value) {
                    return !is_null($value);
                }
            );
        }, $products);

        $attributes = [
            'size' => ['label' => 'Size', 'suffix' => 'MB'],
            'weight' => ['label' => 'Weight', 'suffix' => 'KG'],
            'dimensions' => ['label' => 'Dimension', 'suffix' => ''],
        ];

    }

} catch (\Throwable $th) {
}

