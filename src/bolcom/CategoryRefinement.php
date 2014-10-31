<?php

class CategoryRefinement {
  private $id;
  private $name;

  public function __construct($categoryRefinementXml = NULL) {
    if (!empty($categoryRefinementXml)) {
      $this -> id = (string)$categoryRefinementXml -> Id;
      $this -> name = (string)$categoryRefinementXml -> Name;
    }
  }

  public function getId() {
    return $this -> id;
  }

  public function getName() {
    return $this -> name;
  }

}
?>