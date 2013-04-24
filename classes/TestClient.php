<?php

class TestClient {
	private $requestHelper;
    private $fullResponse;
	
	public function __construct($accessKeyId=NULL, $secretAccessKey=NULL) {
		$this->requestHelper = new Request($accessKeyId, $secretAccessKey);
	}

    public function getPingResponse() {
        $httpResponse = $this->requestHelper->fetch('GET', '/openapi/services/rest/utils/v3/ping');

        return $this->requestHelper->getFullHeader();
    }

    public function getProduct($id,$queryParams='') {
        $httpResponse = $this->requestHelper->fetch('GET', '/openapi/services/rest/catalog/v3/products/' . $id, $queryParams);
        
        if(strstr($httpResponse, "<?xml")) {
            if($httpResponse) $response = new SimpleXMLElement($httpResponse); else $response = $this->requestHelper->getFullHeader(); 
        } else {
            $response = $httpResponse;
        }
        return $response;
    }

    public function getRecommendations($id,$queryParams='') {
        $httpResponse = $this->requestHelper->fetch('GET', '/openapi/services/rest/catalog/v3/recommendations/' . $id, $queryParams);
        
        if(strstr($httpResponse, "<?xml")) {
            if($httpResponse) $response = new SimpleXMLElement($httpResponse); else $response = $this->requestHelper->getFullHeader(); 
        } else {
            $response = $httpResponse;
        }
        return $response;
    }

    public function getListResults($type, $categoryIdAndRefinements, $offset, $nrProducts, $sortingMethod, $sortingAscending, $includeProducts, $includeCategories, $includeRefinements) {
        $result = NULL;
        $queryParams = '';
        $separator = '?';
        
        if(!empty($offset)) {
            $queryParams .= $separator . 'offset=' . urlencode($offset);
            $separator = '&';
        }
        if(!empty($nrProducts)) {
            $queryParams .= $separator . 'nrProducts=' . urlencode($nrProducts);
            $separator = '&';
        }
        if(!empty($sortingMethod) && !is_null($sortingAscending)) {
            $queryParams .= $separator . 'sortingMethod=' . urlencode($sortingMethod);
            $queryParams .= '&sortingAscending=' . (($sortingAscending) ? 'true' : 'false');
        }
        if(!empty($includeProducts)) {
            $queryParams .= $separator . 'includeProducts=' . urlencode($includeProducts);
            $separator = '&';
        }
        if(!empty($includeCategories)) {
            $queryParams .= $separator . 'includeCategories=' . urlencode($includeCategories);
            $separator = '&';
        }
        if(!empty($includeRefinements)) {
            $queryParams .= $separator . 'includeRefinements=' . urlencode($includeRefinements);
            $separator = '&';
        }

        $httpResponse = $this->requestHelper->fetch('GET', '/openapi/services/rest/catalog/v3/listresults/' . $type . '/' . urlencode($categoryIdAndRefinements), $queryParams);

        if(strstr($httpResponse, "<?xml")) {
            if($httpResponse) $response = new SimpleXMLElement($httpResponse); else $response = $this->requestHelper->getFullHeader(); 
        } else {
            $response = $httpResponse;
        } 
        
        return $response;
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
		
		$httpResponse = $this->requestHelper->fetch('GET', '/openapi/services/rest/catalog/v3/searchresults/', $queryParams);

        if(strstr($httpResponse, "<?xml")) {
            if($httpResponse) $response = new SimpleXMLElement($httpResponse); else $response = $this->requestHelper->getFullHeader(); 
        } else {
            $response = $httpResponse;
        } 
        
		return $response;
    }


    public function addToBasket($id,$quantity=0,$ipAddress=0) {
        $httpResponse = $this->requestHelper->fetch('POST', '/openapi/services/rest/checkout/v3/baskets/' . $id . '/' . $quantity . '/' . $ipAddress);

        if($httpResponse) $response = new SimpleXMLElement($httpResponse); else $response = $this->requestHelper->getFullHeader(); 
        
        return $response;
    }

    public function getBasket() {
        $httpResponse = $this->requestHelper->fetch('GET', '/openapi/services/rest/checkout/v3/baskets');
        
        if(strstr($httpResponse, "<?xml")) {
            if($httpResponse) $response = new SimpleXMLElement($httpResponse); else $response = $this->requestHelper->getFullHeader(); 
        } else {
            $response = $httpResponse;
        }
        
        return $response;
    }

    public function updateQuantityBasket($basketItemId,$quantity) {
        $httpResponse = $this->requestHelper->fetch('PUT', '/openapi/services/rest/checkout/v3/baskets/'.$basketItemId . '/' . $quantity);
        
        if($httpResponse) $response = new SimpleXMLElement($httpResponse); else $response = $this->requestHelper->getFullHeader(); 

        return $response;
    }

    public function removeFromBasket($basketItemId) {
        $httpResponse = $this->requestHelper->fetch('DELETE', '/openapi/services/rest/checkout/v3/baskets/'.$basketItemId);
        
        if($httpResponse) $response = new SimpleXMLElement($httpResponse); else $response = $this->requestHelper->getFullHeader(); 

        return $response;
    }

    public function setSessionId($sessionid) {
        $this->requestHelper->setSessionId($sessionid);
    }

    public function getSessionId() {
        return $this->requestHelper->getSessionId();
    }

    public function getFullHeader() {
        return $this->requestHelper->getFullHeader();
    }

}

?>