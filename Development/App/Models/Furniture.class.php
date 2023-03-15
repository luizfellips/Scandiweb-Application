<?php


class Furniture extends Product
{
    protected $height;
    protected $width;
    protected $length;

    function __construct($sku, $name, $price, $product_type, $height, $width, $length)
    {
        parent::__construct($sku, $name, $price, $product_type);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }
    //gets 
    public function getHeight()
    {
        return $this->height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getLength()
    {
        return $this->length;
    }

    // sets 
    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }


    public function Save(){
        $pdo = Connection::getConnection();
        $sql = 'Insert into products(sku,name,price,product_type) values (:sku,:name,:price,:product_type); 
                Insert into products_attributes(sku,height,width,length) values (:sku,:height,:width,:length)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':sku',$this->getSku());
        $stmt->bindValue(':name',$this->getName());
        $stmt->bindValue(':price',$this->getPrice());
        $stmt->bindValue(':height',$this->getHeight());
        $stmt->bindValue(':width',$this->getWidth());
        $stmt->bindValue(':length',$this->getLength());
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

