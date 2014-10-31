<?php

class Category {
	private $id;
	private $categoryname;
	private $productcount;
	
	public function __construct($categoryXml=NULL) {
		if(!empty($categoryXml)) {
			$this->id = (string)$categoryXml->Id;
			$this->categoryname = (string)$categoryXml->Name;
			$this->productcount = (string)$categoryXml->ProductCount;
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getCategoryName() {
		return $this->categoryname;
	}
	
    public function getProductCount() {
        return $this->productcount;
    }
}

?>