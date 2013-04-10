<?php

class Product {
	private $id;
	private $title;
	private $price;
    private $description;
    private $thumbnailurl;
    private $externalurl;
    private $totalresultsize;
	
	public function __construct($productXml=NULL) {
		if(!empty($productXml)) {
			$this->id = (string)$productXml->Id;
			$this->title = (string)$productXml->Title;
			$this->price = (string)$productXml->Offers->Offer->Price;
			$this->description = (string)$productXml->ShortDescription;
			$this->thumbnailurl = (string)$productXml->Images->Large;
			$this->externalurl = (string)$productXml->Urls->Main;
			$this->totalresultsize = (string)$productXml->TotalResultSize;
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function getPrice() {
		return $this->price;
	}
	
	public function getDescription() {
        return $this->description;
    }

    public function getThumbnailurl() {
        if ($this->thumbnailurl == "" ){
            // Use a default bol.com image
            $sThumbnailurl = "http://www.bol.com/nl/static/images/main/noimage_124x100default.gif";
        } else $sThumbnailurl = $this->thumbnailurl;
        return $sThumbnailurl;
    }
	
	public function getExternalurl() {
        return $this->externalurl;
    }
	
    public function getTotalresultsize() {
        return $this->totalresultsize;
    }
}

?>