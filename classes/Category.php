<?php

class Category {
	private $id;
	private $name;
	
	public function __construct($categoryXml=NULL) {
		if(!empty($categoryXml)) {
			$this->id = (string)$categoryXml->Id;
			$this->name = (string)$categoryXml->Name;
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getName() {
		return $this->name;
	}
}

?>