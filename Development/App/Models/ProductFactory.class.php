<?php
class ProductFactory
{
    public static function GenerateProduct($sku, $name, $price, $product_type, $attributes)
    {
        // more scalable
        switch ($product_type) {
            case 'DVD':
                return new DVD($sku, $name, $price, $product_type, $attributes['size']);
            case 'Book':
                return new Book($sku, $name, $price, $product_type, $attributes['weight']);
            case 'Furniture':
                return new Furniture($sku, $name, $price, $product_type, $attributes['height'], $attributes['width'], $attributes['length']);
            default:
                throw new Exception('Invalid product type');
        }
    }
}