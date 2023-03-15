<?php
class DVD extends Product
{
    protected $size;

    function __construct($sku, $name, $price, $product_type, $size)
    {
        parent::__construct($sku, $name, $price, $product_type);
        $this->size = $size;
    }
    //gets 
    public function getSize()
    {
        return $this->size;
    }

    // sets 
    public function setSize($size)
    {
        $this->size = $size;
    }


    public function Save(){
        $pdo = Connection::getConnection();
        $sql = 'Insert into products(sku,name,price,product_type) values (:sku,:name,:price,:product_type); Insert into products_attributes(sku,size) values (:sku,:size)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':sku',$this->getSku());
        $stmt->bindValue(':size',$this->getSize());
        $stmt->bindValue(':name',$this->getName());
        $stmt->bindValue(':price',$this->getPrice());
        $stmt->bindValue(':product_type',$this->getProductType());
        $stmt->execute();

        if($stmt->rowCount() > 0){
            echo "succesfully added";

        }
        else{
            echo "Failed operation";
        }
    }
}
