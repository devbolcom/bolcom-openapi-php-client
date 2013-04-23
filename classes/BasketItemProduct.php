<?php

class BasketItemProduct {
    private $id;
    private $title;
    private $type;
    private $price;
    private $publisher;
    private $description;
    private $thumbnailurl;
    private $url;
    private $offerid;
    private $offerprice;
            
    public function __construct($basketXml=NULL) {
        if(!empty($basketXml)) {
            $this->id = (string)$basketXml->Id;  
            $this->title = (string)$basketXml->Title;
            $this->type = (string)$basketXml->Type;
            $this->price = (string)$basketXml->Price;
            $this->publisher = (string)$basketXml->Publisher;
            $this->description = (string)$basketXml->ShortDescription;
            $this->thumbnailurl = (string)$basketXml->Images->Large;
            $this->url = (string)$basketXml->Urls->Main;
            $this->offerid = (string)$basketXml->Offers->Offer->Id;
            $this->offerprice = (string)$basketXml->Offers->Offer->Price;
        }
    }
    
    public function getBasketItemId() {
        return $this->id;
    }
    
    public function getBasketItemTitle() {
        return $this->title;
    }
    
    public function getBasketItemType() {
        return $this->type;
    }

    public function getBasketItemPrice() {
        return $this->price;
    }

    public function getBasketItemPublisher() {
        return $this->publisher;
    }
        
    public function getBasketItemDescription() {
        return $this->description;
    }

    public function getBasketItemThumbnailurl() {
        if ($this->thumbnailurl == "" ){
            // Use a default bol.com image
            $sThumbnailurl = DEFAULT_PRODUCT_IMAGE;
        } else $sThumbnailurl = $this->thumbnailurl;
        return $sThumbnailurl;
    }
    
    public function getBasketItemUrl() {
        return $this->url;
    }

    public function getBasketItemOfferId() {
        return $this->offerid;
    }
    
    public function getBasketItemOfferPrice() {
        return $this->offerprice;
    }
}

?>