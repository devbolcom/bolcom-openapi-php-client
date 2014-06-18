<?php

class Offers {
    private $id;
    private $condition;
    private $price;
    private $listprice;
    private $availabilitycode;
    private $availabilitydescription;
    private $seller;
    
    public function __construct($offers=NULL) {
        if(!empty($offers)) {
            $this->id = (string)$offers->id;
            $this->condition = (string)$offers->condition;
            $this->price = (string)$offers->price;
            $this->listprice = (string)$offers->listPrice;
            $this->availabilitycode = (string)$offers->availabilityCode;
            $this->availabilitydescription = (string)$offers->availabilityDescription;
            $this->seller->id = (string)$offers->seller->id;
            $this->seller->sellertype = (string)$offers->seller->sellerType;
            $this->seller->displayname = (string)$offers->seller->displayName;
            $this->seller->numberofreviews = (string)$offers->seller->numberOfReviews;
            $this->seller->overallrating = (string)$offers->seller->overallRating;
            $this->seller->url = (string)$offers->seller->url;
        }
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getCondition() {
        return $this->condition;
    }
    
    public function getPrice() {
        return $this->price;
    }

    public function getListPrice() {
        return $this->listprice;
    }
    
    public function getAvailabilityCode() {
        return $this->availabilitycode;
    }
    
    public function getAvailabilityDescription() {
        return $this->availabilitydescription;
    }
    
    public function getSellerId() {
        return $this->seller->id;
    }
    
    public function getSellerType() {
        return $this->seller->sellertype;
    }
    
    public function getSellerDisplayName() {
        return $this->seller->displayname;
    }
    
    public function getSellerNumberOfReviews() {
        return $this->seller->numberofreviews;
    }
    
    public function getSellerOverallRating() {
        return $this->seller->overallrating;
    }
    
    public function getSellerUrl() {
        return $this->seller->url;
    }
}

?>