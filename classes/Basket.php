<?php

class Basket {
    private $totalamountarticles;
    private $subtotal;
    private $shippingfee;
    private $total;
    private $servicefee;
    private $giftwrapfee;
    private $totalquantity;
    private $shippableabroad;
    private $combinable;
    private $openforuse;
    private $specialrequirement;
        
    public function __construct($basketXml=NULL) {
        if(!empty($basketXml)) {
            $this->totalamountarticles = (string)$basketXml->TotalAmountArticles;
            $this->subtotal = (string)$basketXml->SubTotal;
            $this->shippingfee = (string)$basketXml->ShippingFee;
            $this->total = (string)$basketXml->Total;
            $this->servicefee = (string)$basketXml->ServiceFee;
            $this->giftwrapfee = (string)$basketXml->GiftWrapFee;
            $this->totalquantity = (string)$basketXml->TotalQuantity;
            $this->shippableabroad = (string)$basketXml->ShippableAbroad;
            $this->combinable = (string)$basketXml->Combinable;
            $this->openforuse = (string)$basketXml->OpenForUse;
            $this->specialrequirement = (string)$basketXml->SpecialRequirements->Requirement;
        }
    }
    
    public function getTotalAmountArticles() {
        return $this->totalamountarticles;
    }
    
    public function getSubTotal() {
        return $this->subtotal;
    }
    
    public function getShippingFee() {
        return $this->shippingfee;
    }

    public function getTotal() {
        return $this->total;
    }
    
    public function getServiceFee() {
        return $this->servicefee;
    }
    
    public function getGiftWrapFee() {
        return $this->giftwrapfee;
    }

    public function getTotalQuantity() {
        return $this->totalquantity;
    }
    
    public function getShippableAbroad() {
        return $this->shippableabroad;
    }

    public function getCombinable() {
        return $this->combinable;
    }

    public function getOpenForUse() {
        return $this->openforuse;
    }

    public function getSpecialRequirement() {
        return $this->specialrequirement;
    }


}

?>