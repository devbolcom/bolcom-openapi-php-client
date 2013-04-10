<?php

class Product {
	private $id;
	private $title;
	private $price;
	
	public function __construct($productXml=NULL) {
		if(!empty($productXml)) {
			$this->id = (string)$productXml->Id;
			$this->title = (string)$productXml->Title;
			$this->price = (string)$productXml->Offers->Offer->Price;
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
}

?>