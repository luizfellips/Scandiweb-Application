<?php


class Furniture extends Product
{
    protected $height;
    protected $width;
    protected $length;

    function __construct($sku, $name, $price, $height, $width, $length)
    {
        parent::__construct($sku, $name, $price, 'Furniture');
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


   public function getAttributes(){
    return [
        'height' => $this->height,
        'width' => $this-> width,
        'length' => $this-> length
    ];
   }
}

?>