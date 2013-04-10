<?php

class TestClient {
	private $requestHelper;
	
	public function __construct($accessKeyId=NULL, $secretAccessKey=NULL) {
		$this->requestHelper = new Request($accessKeyId, $secretAccessKey);
	}

	public function getSearchResults($term, $categoryIdAndRefinements, $offset, $nrProducts, $sortingMethod, $sortingAscending, $includeProducts, $includeCategories, $includeRefinements) {
		$result = '';
		$queryParams = '';
		$separator = '?';

		if(!empty($term)) {
			$queryParams .=	$separator . 'term=' . urlencode($term);
			$separator = '&';
		}
		if(!empty($categoryIdAndRefinements)) {
			$queryParams .=	$separator . 'categoryId=' . urlencode($categoryIdAndRefinements);
			$separator = '&';
		}
		if(!empty($offset)) {
			$queryParams .=	$separator . 'offset=' . urlencode($offset);
			$separator = '&';
		}
		if(!empty($nrProducts)) {
			$queryParams .=	$separator . 'nrProducts=' . urlencode($nrProducts);
			$separator = '&';
		}
		if(!empty($sortingMethod) && !empty($sortingAscending)) {
			$queryParams .=	$separator . 'sortingMethod=' . urlencode($sortingMethod);
			$queryParams .=	'&sortingAscending=' . (($sortingAscending) ? 'true' : 'false');
		}
		if(!empty($includeProducts)) {
			$queryParams .=	$separator . 'includeProducts=' . urlencode($includeProducts);
			$separator = '&';
		}
		if(!empty($includeCategories)) {
			$queryParams .=	$separator . 'includeCategories=' . urlencode($includeCategories);
			$separator = '&';
		}
		if(!empty($includeRefinements)) {
			$queryParams .=	$separator . 'includeRefinements=' . urlencode($includeRefinements);
			$separator = '&';
		}
		
		$httpResponse = $this->requestHelper->fetch('GET', '/openapi/services/rest/catalog/v3/searchresults', $queryParams);

		$list = array();
		if($this->requestHelper->getHttpResponseCode() == 200) {




			$xmlResponse = new SimpleXMLElement($httpResponse);
			
			foreach($xmlResponse->children() as $child) {
				if($child->getName() == 'Product') {
					$list[] = new Product($child);
				}
			}
			foreach($xmlResponse->children() as $child) {
				if($child->getName() == 'Category') {
					$list[] = new Category($child);
				}
			}
		}
		return $list;
    }

	public function getListResults($type, $categoryIdAndRefinements, $offset, $nrProducts, $sortingMethod, $sortingAscending, $includeProducts, $includeCategories, $includeRefinements) {
		$result = NULL;
		$queryParams = '';
		$separator = '?';
		
		if(!empty($offset)) {
			$queryParams .=	$separator . 'offset=' . urlencode($offset);
			$separator = '&';
		}
		if(!empty($nrProducts)) {
			$queryParams .=	$separator . 'nrProducts=' . urlencode($nrProducts);
			$separator = '&';
		}
		if(!empty($sortingMethod) && !is_null($sortingAscending)) {
			$queryParams .=	$separator . 'sortingMethod=' . urlencode($sortingMethod);
			$queryParams .=	'&sortingAscending=' . (($sortingAscending) ? 'true' : 'false');
		}
		if(!empty($includeProducts)) {
			$queryParams .=	$separator . 'includeProducts=' . urlencode($includeProducts);
			$separator = '&';
		}
		if(!empty($includeCategories)) {
			$queryParams .=	$separator . 'includeCategories=' . urlencode($includeCategories);
			$separator = '&';
		}
		if(!empty($includeRefinements)) {
			$queryParams .=	$separator . 'includeRefinements=' . urlencode($includeRefinements);
			$separator = '&';
		}

		$httpResponse = $this->requestHelper->fetch('GET', '/openapi/services/rest/catalog/v3/listresults/' . $type . '/' . urlencode($categoryIdAndRefinements), $queryParams);
		
		$list = array();
		if($this->requestHelper->getHttpResponseCode() == 200) {




			$xmlResponse = new SimpleXMLElement($httpResponse);
			
			foreach($xmlResponse->children() as $child) {
				if($child->getName() == 'Product') {
					$list[] = new Product($child);
				}
			}
			foreach($xmlResponse->children() as $child) {
				if($child->getName() == 'Category') {
					$list[] = new Category($child);
				}
			}
		}
		return $list;
    }

    public function getProduct($id) {
		$httpResponse = $this->requestHelper->fetch('GET', '/openapi/services/rest/catalog/v3/products/' . $id);
		
		$product = NULL;
		if($this->requestHelper->getHttpResponseCode() == 200) {
			$xmlResponse = new SimpleXMLElement($httpResponse);
			$product = new Product($xmlResponse->Product);
		}
		return $product;	
    }
}

?>