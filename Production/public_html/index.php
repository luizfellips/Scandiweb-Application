<?php
include_once "../Module/loadProducts.php";
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
            <a href="add-product.php"><button>Add</button></a>
            <button id="delete-product-btn">Mass delete</button>
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