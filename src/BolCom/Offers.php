<?php

namespace BolCom;

class Offers
{
	private $id;
	private $condition;
	private $price;
	private $listprice;
	private $availabilitycode;
	private $availabilitydescription;
	private $seller;

	public function __construct($offers = NULL)
	{
		if (!empty($offers)) {
			$this->id = (string)$offers->id;
			$this->condition = (string)$offers->condition;
			$this->price = (string)$offers->price;
			$this->listprice = isset($offers->listPrice) ? (string)$offers->listPrice : '';
			$this->availabilitycode = (string)$offers->availabilityCode;
			$this->availabilitydescription = (string)$offers->availabilityDescription;

			$this->seller = new \stdClass();
			$this->seller->id = (string)$offers->seller->id;
			$this->seller->sellertype = (string)$offers->seller->sellerType;
			$this->seller->displayname = (string)$offers->seller->displayName;
			$this->seller->url = isset($offers->seller->url) ? (string)$offers->seller->url : '';

			$this->seller->rating = $offers->seller->sellerRating;
			$this->seller->recentreviews = $offers->seller->recentReviewCounts;
			$this->seller->allreviews = $offers->seller->allReviewsCounts;
		}
	}

	public function getId()
	{
		return $this->id;
	}

	public function getCondition()
	{
		return $this->condition;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function getListPrice()
	{
		return $this->listprice;
	}

	public function getAvailabilityCode()
	{
		return $this->availabilitycode;
	}

	public function getAvailabilityDescription()
	{
		return $this->availabilitydescription;
	}

	public function getSellerId()
	{
		return $this->seller->id;
	}

	public function getSellerType()
	{
		return $this->seller->sellertype;
	}

	public function getSellerDisplayName()
	{
		return $this->seller->displayname;
	}

	public function getSellerRating()
	{
		return $this->seller->rating;
	}

	public function getSellerRecentReviews()
	{
		return $this->seller->recentreviews;
	}

	public function getSellerReviews()
	{
		return $this->seller->allreviews;
	}

	public function getSellerNumberOfReviews()
	{
		return isset($this->getSellerReviews()->totalReviewCount) ? $this->getSellerReviews()->totalReviewCount : 0;
	}

	public function getSellerOverallRating()
	{
		return isset($this->getSellerRating()->sellerRating) ? $this->getSellerRating()->sellerRating : '0';
	}

	public function getSellerUrl()
	{
		return $this->seller->url;
	}

}