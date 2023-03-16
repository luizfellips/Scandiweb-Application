<?php
class Book extends Product
{
    protected $weight;

    function __construct($sku, $name, $price, $weight)
    {
        parent::__construct($sku, $name, $price, 'Book');
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

    public function getAttributes(){
        return [
            'weight' => $this->getWeight()
        ];
       }

}
