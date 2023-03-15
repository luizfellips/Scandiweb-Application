<?php
class Book extends Product
{
    protected $weight;

    function __construct($sku, $name, $price, $product_type, $weight)
    {
        parent::__construct($sku, $name, $price, $product_type);
        $this->weight = $weight;
    }
    //gets 
    public function getWeight()
    {
        return $this->weight;
    }

    // sets 
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function Save(){
        $pdo = Connection::getConnection();
        $sql = 'Insert into products(sku,name,price,product_type) values (:sku,:name,:price,:product_type); Insert into products_attributes(sku,weight) values (:sku,:weight)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':sku',$this->getSku());
        $stmt->bindValue(':name',$this->getName());
        $stmt->bindValue(':price',$this->getPrice());
        $stmt->bindValue(':weight',$this->getWeight());
        $stmt->bindValue(':product_type',$this->getProductType());
        $stmt->execute();

        
    }

}
