<?php

class ProductFamilies {
    private $keyid;
    private $label;
    private $productfamilymembers;
    
    public function __construct($productfamilies=NULL) {
        if(!empty($productfamilies)) {
            $this->keyid = (string)$productfamilies->key;
            $this->label = (string)$productfamilies->label;
            $this->productfamilymembers = (array)$productfamilies->productFamilyMembers;
        }
    }
    
    public function getKey() {
        return $this->keyid;
    }
    
    public function getLabel() {
        return $this->label;
    }
    
    public function getProductFamilyMembers() {
        return $this->productfamilymembers;
    }

}

?>