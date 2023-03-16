<?php
abstract class Product{
    
    // properties
    protected $sku;
    protected $name;
    protected $price;
    protected $product_type;
    
    //construct
    public function __construct($sku, $name,$price,$product_type){
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->product_type = $product_type;
    }
    
    // gets
    abstract public function getAttributes();
    public function getSku(){
        return $this->sku;
    }
    public function getName(){
        return $this->name;
    }
    
    public function getPrice(){
        return $this->price;
    }

    public function getProductType(){
        return $this->product_type;
    }

    //sets 

    public function setSku($sku){
        $this->sku = $sku;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setPrice($price){
        $this->price = $price;
    }
    public function setProductType($product_type){
        $this->product_type = $product_type;
    }

}
