<?php

namespace BolCom;

class Accessories
{
    private $productid;

    public function __construct($accessories = NULL)
    {
        if (!empty($accessories)) {
            $this->productid = (string)$accessories->productId;
        }
    }

    public function getProductId()
    {
        return $this->productid;
    }

}