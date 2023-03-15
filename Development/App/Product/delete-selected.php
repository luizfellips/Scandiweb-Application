<?php

if (isset($_POST['skus'])) {
    require_once('../../Module/Connection.php');
    $selected_SKUs = $_POST['skus'];
    try {
        $conn = Connection::getConnection();
        $stmt = $conn->prepare('DELETE from Products where SKU in (' . implode(',', array_fill(0, count($selected_SKUs), '?')) . ')');
        $stmt->execute($selected_SKUs);
        $stmt = $conn->prepare('DELETE from Products_Attributes where SKU in (' . implode(',', array_fill(0, count($selected_SKUs), '?')) . ')');
        $stmt->execute($selected_SKUs);
    } catch (\Throwable $th) {
        print_r($th);
    }


}
else {
    echo 'not set';
}
?>