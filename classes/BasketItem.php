<?php

class BasketItem {
    private $id;
    private $price;
    private $quantity;
        
    public function __construct($basketXml=NULL) {
        if(!empty($basketXml)) {
            $this->id = (string)$basketXml->Id;
            $this->price = (string)$basketXml->Price;
            $this->quantity = (string)$basketXml->Quantity;
        }
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function getQuantity() {
        return $this->quantity;
    }
    
}

?>