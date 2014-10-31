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

  public function __construct($basketXml = NULL) {
    if (!empty($basketXml)) {
      $this -> id = (string)$basketXml -> id;
      $this -> title = (string)$basketXml -> title;
      $this -> type = (string)$basketXml -> type;
      $this -> price = (string)$basketXml -> price;
      $this -> publisher = (string)$basketXml -> publisher;
      $this -> description = (string)$basketXml -> shortDescription;
      $this -> thumbnailurl = (string)$basketXml -> images -> large;
      $this -> url = (string)$basketXml -> urls -> main;
      $this -> offerid = (string)$basketXml -> offers -> offer -> id;
      $this -> offerprice = (string)$basketXml -> offers -> offer -> price;
    }
  }

  public function getBasketItemId() {
    return $this -> id;
  }

  public function getBasketItemTitle() {
    return $this -> title;
  }

  public function getBasketItemType() {
    return $this -> type;
  }

  public function getBasketItemPrice() {
    return $this -> price;
  }

  public function getBasketItemPublisher() {
    return $this -> publisher;
  }

  public function getBasketItemDescription() {
    return $this -> description;
  }

  public function getBasketItemThumbnailurl() {
    if ($this -> thumbnailurl == "") {
      // Use a default bol.com image
      $sThumbnailurl = DEFAULT_PRODUCT_IMAGE;
    } else
      $sThumbnailurl = $this -> thumbnailurl;
    return $sThumbnailurl;
  }

  public function getBasketItemUrl() {
    return $this -> url;
  }

  public function getBasketItemOfferId() {
    return $this -> offerid;
  }

  public function getBasketItemOfferPrice() {
    return $this -> offerprice;
  }

}
?>