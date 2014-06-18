<?php

class Product {
	private $id;
	private $title;
	private $price;
    private $description;
    private $thumbnailurl;
    private $url;
    private $offers;
    private $offeridbolcom;
	
	public function __construct($product=NULL) {
		if(!empty($product)) {
			$this->id = (string)$product->id;
			$this->title = (string)$product->title;
			$this->price = (string)$product->offerData->offers[0]->price;
			$this->description = (string)$product->shortDescription;
			$this->thumbnailurl = (string)$product->images[1]->url;
			$this->url = (string)$product->urls[0]->value;
            $this->offers = (array)$product->offerData->offers;
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function getFirstAvailablePrice() {
		return $this->price;
	}
	
	public function getDescription() {
        return $this->description;
    }

    public function getThumbnailurl() {
        if ($this->thumbnailurl == "" ){
            // Use a default bol.com image
            $sThumbnailurl = 'http://www.bol.com/nl/static/images/main/noimage_124x100default.gif';
        } else $sThumbnailurl = $this->thumbnailurl;
        return $sThumbnailurl;
    }
	
	public function getExternalurl() {
        return $this->externalurl;
    }
    
    public function getOffers() {
        return $this->offers;
    }
}

?>