<?php

if (isset($_POST['skus'])) {
    include_once('../Module/Connection.class.php');
    $selected_SKUs = $_POST['skus'];

    try {
        $conn = Connection::getConnection();
        $stmt = $conn->prepare('DELETE from products where SKU in (' . implode(',', array_fill(0, count($selected_SKUs), '?')) . ')');
        $stmt->execute($selected_SKUs);
        $stmt = $conn->prepare('DELETE from products_attributes where SKU in (' . implode(',', array_fill(0, count($selected_SKUs), '?')) . ')');
        $stmt->execute($selected_SKUs);
        
    } catch (\Throwable $th) {
        print_r($th);
    }


}
else {
    echo 'not set';
}
?>