<?php
class DVD extends Product
{
    protected $size;

    function __construct($sku, $name, $price, $size)
    {
        parent::__construct($sku, $name, $price, 'DVD');
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


    public function getAttributes(){
        return [
            'size' => $this->getSize()
        ];
       }
}
