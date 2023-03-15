<?php
if (isset($_POST['sku']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['productType'])) {

    //require autoload (will load classes and connection configs)
    require_once("../Module/autoload.php");
    //main product fields
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $product_type = $_POST['productType'];

    //attributes
    $size = ($_POST['size']) ? $_POST['size'] : null;
    $weight = ($_POST['weight']) ? $_POST['weight'] : null;
    $height = ($_POST['height']) ? $_POST['height'] : null;
    $width = ($_POST['width']) ? $_POST['width'] : null;
    $length = ($_POST['length']) ? $_POST['length'] : null;


    // OOP APPROACH

    $attributes =
        [
            'size' => $size,
            'weight' => $weight,
            'height' => $height,
            'width' => $width,
            'length' => $length
        ];

    try {
        $product = ProductFactory::GenerateProduct($sku, $name, $price, $product_type, $attributes);
        $product->Save();
        
        header("Location: index.php");
        exit;

    } catch (\Throwable $th) {
        print_r($th);
    }



    // ARRAY APPROACH 

    /* $products = [
    'DVD' => ['class' => 'DVD', 'params' => [$size]],
    'Book' => ['class' => 'Book', 'params' => [$weight]],
    'Furniture' => ['class' => 'Furniture', 'params' => [$height, $width, $length]],
    ];
    try {
    $object_params = array_merge
    (
    [$sku, $name, $price, $product_type],
    array_map(function ($param) {
    return $param; }, $products[$product_type]['params'])
    );
    $product = new $products[$product_type]['class'](...$object_params);
    $product->Save();
    header("Location: index.php");
    exit;
    
    } catch (\Throwable $th) {
    echo $th->getMessage();
    }
    */
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/add.css">
    <script src="src/scripts/dynamic_form.js"></script>
    <title>Add product</title>
</head>

<body>

    <form action="add-product.php" method="post" id="product-form">
        <header>
            <h1>Product List</h1>
            <div class="button-group">
                <button type="submit">Save</button>
                <a href="index.php"><button type="button">Cancel</button></a>
            </div>
        </header>

        <div class="row">
            <div class="col">
                <label for="SKU">SKU </label>
                <label for="Name">Name</label>
                <label for="Price">Price ($)</label>
            </div>
            <div class="col inputs">
                <input type="text" name="sku" id="sku" required>
                <input type="text" name="name" id="name" required>
                <input type="number" name="price" step="any" id="price" required>
            </div>
        </div>



        <label for="ProductType">Type Switcher
            <select name="productType" id="productType" onChange="selectProductType(this.value);" required>
                <option value="">Type Switcher</option>
                <option value="DVD" id="DVD">DVD</option>
                <option value="Book" id="Book">Book</option>
                <option value="Furniture" id="Furniture">Furniture</option>
            </select></label>



        <div class="fieldbox" id="dvd_attributes">
            <p>Specify the size of the DVD.</p>
            <label>Size(MB)<input type="number" name="size" id="size"></label>
        </div>

        <div class="fieldbox" id="book_attributes">
            <p>Please insert the weight of your book.</p>
            <label>Weight(KG) <input type="text" name="weight" id="weight"></label>
        </div>

        <div class="fieldbox" id="furniture_attributes">
            <p>Please provide the dimensions of the furniture.</p>
            
            <label>Height(CM) <input type="text" name="height" id="height"></label>
            
            <label>Width(CM)  <input type="text" name="width" id="width"></label>
           
            <label>Length(CM) <input type="text" name="length" id="length"></label>
            
        </div>
    </form>
    
    <footer>
        Scandiweb Test Assignment
    </footer>
</body>


</html>
