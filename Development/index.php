<?php
include("Module/Connection.php");
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
    echo $th->getMessage();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="src/index.css">
    <script src="src/scripts/index.js"></script>
    <title>Product List</title>
</head>

<body>
    <header>
        <h1>Product List</h1>
        <div class="button-group">
            <a href="add-product.php"><button>ADD</button></a>
            <button id="delete-product-btn">MASS DELETE</button>
        </div>
    </header>

    <main>
        <table>
            <?php
            $counter = 0;
            for ($i = 0; $i < count($products); $i++) {
                if ($counter % 4 == 0) {
                    echo '<tr>';
                }
                ?>

                <td>
                    <div class="product">
                        <input type="checkbox" class="delete-checkbox" value="<?php echo $products[$i]['sku'] ?>">
                        <p>
                            <?php echo $products[$i]['sku'] ?>
                        </p>
                        <p>
                            <?php echo $products[$i]['name'] ?>
                        </p>
                        <p>
                            <?php echo str_replace('.', ',', $products[$i]['price']) ?>
                            $
                        </p>
                        <p>
                            <?php
                            foreach ($attributes as $attribute => $value) {
                                if (!empty($products[$i][$attribute])) {
                                    echo $value['label'] . ': ' . $products[$i][$attribute] . ' ' . $value['suffix'] . PHP_EOL;
                                }
                            }
                            ?>
                        </p>
                </td>

                <?php
                $counter++;
                if ($counter % 4 == 0) {
                    echo '</tr>';
                }
            }
            ?>

        </table>
    </main>

    <footer>
        Scandiweb Test Assignment
    </footer>
</body>

</html>
