<?php

namespace BolCom;

class Basket
{
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

    public function __construct($basketXml = NULL)
    {
        if (!empty($basketXml)) {
            $this->totalamountarticles = (string)$basketXml->totalAmountArticles;
            $this->subtotal = (string)$basketXml->subTotal;
            $this->shippingfee = (string)$basketXml->shippingFee;
            $this->total = (string)$basketXml->total;
            $this->servicefee = (string)$basketXml->serviceFee;
            $this->giftwrapfee = (string)$basketXml->giftWrapFee;
            $this->totalquantity = (string)$basketXml->totalQuantity;
            $this->shippableabroad = (string)$basketXml->shippableAbroad;
            $this->combinable = (string)$basketXml->combinable;
            $this->openforuse = (string)$basketXml->openForUse;
            $this->specialrequirement = (string)$basketXml->specialRequirements->requirement;
        }
    }

    public function getTotalAmountArticles()
    {
        return $this->totalamountarticles;
    }

    public function getSubTotal()
    {
        return $this->subtotal;
    }

    public function getShippingFee()
    {
        return $this->shippingfee;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getServiceFee()
    {
        return $this->servicefee;
    }

    public function getGiftWrapFee()
    {
        return $this->giftwrapfee;
    }

    public function getTotalQuantity()
    {
        return $this->totalquantity;
    }

    public function getShippableAbroad()
    {
        return $this->shippableabroad;
    }

    public function getCombinable()
    {
        return $this->combinable;
    }

    public function getOpenForUse()
    {
        return $this->openforuse;
    }

    public function getSpecialRequirement()
    {
        return $this->specialrequirement;
    }

}