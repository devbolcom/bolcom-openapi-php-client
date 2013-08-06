<?php

class App {
    private $rooturl;
    public static $testClient = null;
	public static function run() {
	    self::$testClient = new TestClient(BOL_API_PUBLIC_KEY, BOL_API_PRIVATE_KEY);
        $servername = str_replace("www.", "", $_SERVER['SERVER_NAME']);
        $rooturl = 'http://'.$servername.$_SERVER['SCRIPT_NAME'];
        print('<h4>PHP example code</h4>');
        print('<ul>');
        print('<li><a href="'.$rooturl.'?action=getproduct">GET /openapi/services/rest/catalog/v3/products/</a> (<a href="'.$rooturl.'?action=getproductraw">* raw xml</a>)</li>');
        print('<li><a href="'.$rooturl.'?action=getrecommendations">GET /openapi/services/rest/catalog/v3/recommendations/</a> (<a href="'.$rooturl.'?action=getrecommendationsraw">* raw xml</a>)</li>');
		print('<li><a href="'.$rooturl.'?action=getlistresults">GET /openapi/services/rest/catalog/v3/listresults/</a> (<a href="'.$rooturl.'?action=getlistresultsraw">* raw xml</a>)</li>');
		print('<li><a href="'.$rooturl.'?action=searchresults">GET /openapi/services/rest/catalog/v3/searchresults/</a> (<a href="'.$rooturl.'?action=searchresultsraw">* raw xml</a>)</li>');
        print('<li><a href="'.$rooturl.'?action=addbasket">POST /openapi/services/rest/checkout/v3/baskets/</a></li>');
        print('<ul>');
        print('<li><a href="'.$rooturl.'?action=getbasket">GET /openapi/services/rest/checkout/v3/baskets/</a>  (<a href="'.$rooturl.'?action=getbasketraw">* raw xml</a>) (Add item to anonymous basket)</li>');
        print('<li><a href="'.$rooturl.'?action=updatequantitybasket&quantity=3">PUT /openapi/services/rest/checkout/v3/baskets/{basketItemId}/{quantity}</a> (update quantity on item)</li>');
        print('<li><a href="'.$rooturl.'?action=addanotheritemtobasket">POST /openapi/services/rest/checkout/v3/baskets/</a> (add another item to the basket)</li>');
        print('<li><a href="'.$rooturl.'?action=removefrombasket">DELETE /openapi/services/rest/checkout/v3/baskets/{basketItemId}</a> (remove item from basket)</li>');
        print('<li><a href="http://partner.bol.com/click/click?p=1&t=url&s=123456&f=API&url=https%3A%2F%2Fcheckout.bol.com%2Fbasket.html%3Furl%3Dhttp%3A%2F%2Fdevelopers.bol.com%2Fexamples%2Fphpexamplecodelibrary%2F%26name%3DMy+shop%26siteId%3D123456%26sessionId%3D'.$_SESSION['bolbasketsessionid'].'" target="_BLANK">The checkout based on session id anonymous basket</a></li>');
        print('</ul>');
		print('</ul>');
        print('Download dit voorbeeld op <a href="https://github.com/devbolcom/phpexamplecodelibrary">https://github.com/devbolcom/phpexamplecodelibrary</a>.<br>');
		print('----');
        //convert html characters in $_REQUEST params for Cross-site scripting (XSS)
		foreach ($_REQUEST as $key => $value) {
			$params[$key] = htmlspecialchars($value);
		}
        //get action param for which data to get or post
	    $action = isset($params['action']) ? $params['action'] : "default";
	    switch($action) {
	        case 'default':
                self::ping();
	            break;
	        case 'getproduct':
	            self::getProduct(false,$params);
	            break;
            case 'getproductraw':
                self::getProduct(true,$params);
                break;
            case 'getrecommendations':
                self::getRecommendations(false,$params);
                break;
            case 'getrecommendationsraw':
                self::getRecommendations(true,$params);
                break;
            case 'getlistresults':
                self::getListresults(false,$params);
                break;
            case 'getlistresultsraw':
                self::getListresults(true,$params);
                break;
            case 'searchresults':
                self::searchResults(false,$params);
                break;
            case 'searchresultsraw':
                self::searchResults(true,$params);
                break;
            case 'addbasket':
                self::addBasket();
                break;
            case 'getbasket':
                self::getBasket();
                break;
            case 'getbasketraw':
                self::getBasket(true);
                break;
            case 'updatequantitybasket':
                self::updateQuantityBasket(false,$params);
                break;
            case 'removefrombasket':
                self::removefromBasket(false,$params);
                break;
            case 'addanotheritemtobasket':
                self::addAnotherItemToBasket(false,$params);
                break;
	    }
		
	}
    
    private static function ping() {
        //ping request, /openapi/services/rest/utils/v3/ping
        self::printValue('Performing ping request');
        self::printValue('----');
        $ping = self::$testClient->getPingResponse();
        self::printValue($ping);
        self::printValue(" ");
    }

	private static function getProduct($bRaw=0,$params='') {
	    //product request /openapi/services/rest/catalog/v3/products/{id} + queryParams
	    if(!isset($params['productid'])) $productid = '1002004010708531'; else $productid = urldecode($params['productid']);
        self::printValue('Performing products request with productid 1002004010708531 and includeAttributes = true');
        self::printValue('----');
        $xmlResponse = self::$testClient->getProduct($productid,'?includeAttributes=true');
        if($bRaw) {
            self::printValue("Raw XML response");
            self::printValue('----');
            self::printValue($xmlResponse);
        } else {
            $product = new Product($xmlResponse->Product);
            self::printProduct($product);
        }
        self::printValue(" ");
	}

    private static function getRecommendations($bRaw=0,$params='') {
        //get recommendations /openapi/services/rest/catalog/v3/recommendations/{id} + queryParams
        if(!isset($params['productid'])) $productid = '1002004010708531'; else $productid = urldecode($params['productid']);
        self::printValue('Performing recommendations request with productid 1002004010708531');
        self::printValue('----');
        $xmlResponse = self::$testClient->getRecommendations($productid,'?includeAttributes=false');
        if($bRaw!=0) {
            self::printValue("Raw XML response");
            self::printValue('----');
            self::printValue($xmlResponse);
        } else {
            $list = array();
            foreach($xmlResponse->children() as $child) {
                if($child->getName() == 'Product') {
                    $list[] = new Product($child);
                }
            }

            foreach($list as $item) {
                if($item instanceof Product) {
                    self::printProduct($item);
                }
            }
            self::printValue(" ");
        }
    }

    private static function getListresults($bRaw=0,$params='') {
        //list products /openapi/services/rest/catalog/v3/listresults/{type}/{categoryIdAndRefinements} + queryParams
        if(!isset($params['categoryids'])) {
            $categoryids = '6142 7288 6268';
            $sorting = 'publishing_date';
            self::printValue('Performing listresults request with type = "toplist_default", sorting = "publishing_date" and includeRefinements = "Actie & Avontuur (6142)", "Te reserveren (7288)" and "Vanaf 12 jaar (6268)"'); 
        } else {
            $categoryids = urldecode($params['categoryids']);
            $sorting = (!isset($params['sorting']) ? 'publishing_date' : $params['sorting']);
            self::printValue('Performing listresults request with type = "toplist_default", sorting = "'.$params['sorting'].'" and categoryIds = "'.$params['categoryids'].'"'); 
        }        
        self::printValue('----');
        $xmlResponse = self::$testClient->getListResults('toplist_default', $categoryids, 0, 100, $sorting, false, true, false, false);
        if($bRaw!=0) {
            self::printValue("Raw XML response");
            self::printValue('----');
            self::printValue($xmlResponse);
        } else {
            $list = array();
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
            
            foreach($list as $item) {
                if($item instanceof Product) {
                    self::printProduct($item);
                }
                if($item instanceof Category) {
                    self::printCategory($item);
                }
            }
        }
        self::printValue(" ");
    }
    
    private static function searchResults($bRaw=0,$params='') {
        //search products /openapi/services/rest/catalog/v3/searchresults/ + queryParams
        if(!isset($params['term'])) {
            $term = 'Harry Potter';
            $categoryids = '1430 8293 4855';
            self::printValue('Performing searchresults request based on term = "'.$term.'", includeRefinements = "Nederlandse boeken (1430)", "Nederlandse boeken (8293)" and "Tot &euro; 30 (4855)", 5 items and sorted on "sales_ranking"'); 
        } else {
            $term = urldecode($params['term']);
            $categoryids = (!isset($params['categoryids']) ? null : $params['categoryids']);
            self::printValue('Performing searchresults request based on term = "'.$term.'", categoryIds = "'.$categoryids.'" and sorted on "sales_ranking"'); 
        }
        self::printValue('----');
        $xmlResponse = self::$testClient->getSearchResults($term, $categoryids, 0, 5, 'sales_ranking', false, true, true, true);
        if($bRaw!=0) {
            self::printValue("Raw XML response");
            self::printValue('----');
            self::printValue($xmlResponse);
        } else {
            $list = array();
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
            
            foreach($list as $item) {
                if($item instanceof Product) {
                    self::printProduct($item);
                }
                if($item instanceof Category) {
                    self::printCategory($item);
                }
            }
        }
        self::printValue(" ");
    }
    
    private static function addBasket($bRaw=0) {
        //add product to basket  /openapi/services/rest/checkout/v3/baskets/{id}/{quantity}/{ipAddress}
        //remove maybe previous set basket item id first
        unset($_SESSION['bolbasketitemid']);
        self::printValue('Adding item 1002004010708531 to your anonymous basket');
        self::printValue('----');
        $xmlResponseProduct = self::$testClient->getProduct('1002004010708531');
        self::printValue("Product call response");
        self::printValue('SessionId: '.$xmlResponseProduct->SessionId);
        $product = new Product($xmlResponseProduct->Product);
        $offers = $product->getOffers();
        self::printValue('First offer id that we are going to put in the basket: '.$offers->Offer[0]->Id);
        self::printValue('----');
        $_SESSION['bolbasketsessionid'] = (string)$xmlResponseProduct->SessionId;
        
        //set basket sessionid so that it's used in the call we are going to make
        self::$testClient->setSessionId($_SESSION['bolbasketsessionid']);
        
        self::printValue('Add unique sessionid '.$_SESSION['bolbasketsessionid'].' of basket to php session &#40;session valid for 20 minutes&#41;');
        self::printValue('----');
        //Add offerid, quantity and Clients IP to create and add a product to a basket
        $xmlResponse = self::$testClient->addToBasket($offers->Offer[0]->Id,1,$_SERVER['REMOTE_ADDR']);

        self::printValue("No XML returned, returning http header");
        self::printValue($xmlResponse);
        self::printValue('----');

        self::printValue(" ");
    }

    private static function getBasket($bRaw=0) {
        //get basket with contents /checkout/v3/baskets + sessionid
        if(!isset($_SESSION['bolbasketsessionid'])) {
            self::printValue("Create a basket first, no basket active");
            self::printValue('----');
        } else {
            self::$testClient->setSessionId($_SESSION['bolbasketsessionid']);
            self::printValue('Get your anonymous basket based on sessionid: '.self::$testClient->getSessionId());
            self::printValue('----');
            $xmlResponse = self::$testClient->getBasket();
            if($bRaw) {
                self::printValue("Raw XML response");
                self::printValue('----');
                self::printValue($xmlResponse);
            } else {
                $basket = new Basket($xmlResponse->Basket);
                self::printBasketAmount($basket);
                
                $listitem = array();
                $listproduct = array();
	            foreach($xmlResponse->Basket->BasketItem as $item) {
                    $listitem[] = new BasketItem($item);
                    $listproduct[] = new BasketItemProduct($item->Product);
	            }
                foreach($listitem as $item) {
	               self::printBasketItems($item);
                }
                foreach($listproduct as $item) {
                   self::printBasketProduct($item);
                }
                if(isset($listitem[0])) $_SESSION['bolbasketitemid'] = $listitem[0]->getId();
            }
            self::printValue(" ");
        }
    }

    private static function updateQuantityBasket($bRaw=0,$params='') {
        //update the quantity of the basket for a certain product /openapi/services/rest/checkout/v3/baskets/{basketItemId}/{quantity} + sessionid
        self::$testClient->setSessionId($_SESSION['bolbasketsessionid']);

        if(!isset($_SESSION['bolbasketsessionid'])) {
            self::printValue("No Basket, do a POST first");
            self::printValue('----');
        } else if(!isset($_SESSION["bolbasketitemid"])) {
            self::printValue("No Basketitem, do a GET first to get this");
            self::printValue('----');
        } else if(!isset($params['quantity'])) {
            self::printValue("No Quantity given");
            self::printValue('----');
        } else {
            self::printValue('Update the quantity of product 1002004010708531 in your anonymous basket');
            self::printValue('----');
            $xmlResponse = self::$testClient->updateQuantityBasket($_SESSION["bolbasketitemid"],$params['quantity']);

            self::printValue($xmlResponse);

            self::printValue(" ");
        }
    }
    

    private static function removeFromBasket($bRaw=0,$params='') {
        //remove first product from the basket /openapi/services/rest/checkout/v3/baskets/{basketItemId} + sessionid
        //set basket sessionid
        self::$testClient->setSessionId($_SESSION['bolbasketsessionid']);
        //check if sessionid for basket is available
        if(!isset($_SESSION['bolbasketsessionid'])) {
            self::printValue("No Basket, do a POST first");
        //check if a basketitem is available
        } else if(!isset($_SESSION["bolbasketitemid"])) {
            self::printValue("No Basketitem, do a GET first to get this");
        } else {
            self::printValue('Remove first product in your anonymous basket with basket item id: '.$_SESSION["bolbasketitemid"]);
            self::printValue('----');
            $xmlResponse = self::$testClient->removeFromBasket($_SESSION["bolbasketitemid"]);
            unset($_SESSION['bolbasketitemid']);
            self::printValue($xmlResponse);
        }

        self::printValue(" ");
    }

    private static function addAnotherItemToBasket($bRaw=0) {
        //Add another product to the already existing basket /openapi/services/rest/checkout/v3/baskets/{id}/{quantity}/{ipAddress} + sessionid
        
        //check if sessionid for basket is available
        if(isset($_SESSION['bolbasketsessionid'])) {
            self::$testClient->setSessionId($_SESSION['bolbasketsessionid']);
            self::printValue('Adding item 1002004013540233 to existing anonymous basket');
            self::printValue('----');
            $xmlResponseProduct = self::$testClient->getProduct('1002004013540233');
            self::printValue("Product call response");
            $product = new Product($xmlResponseProduct->Product);
            $offers = $product->getOffers();
            self::printValue('bol.com offer id: '.$offers->Offer[0]->Id);
            self::printValue('----');
            //Add offerid, quantity and Clients IP to create and add a product to a basket
            $xmlResponse = self::$testClient->addToBasket($offers->Offer[0]->Id,1,$_SERVER['REMOTE_ADDR']);
    
            self::printValue("No XML returned, returning http header");
            self::printValue($xmlResponse);
            self::printValue('----');
    
            self::printValue(" ");
        } else {
            self::printValue("Create a basket first, no basket active");
            self::printValue('----');
        }
    }

	private static function printValue($value) {
		echo '<pre>' . print_r($value, 1) . '</pre>';
	}

	private static function printProduct($product) {
		echo '<pre>';
		echo "Product:\n";
		echo 'id: ' . $product->getId() . "\n";
		echo 'title: ' . $product->getTitle() . "\n";
		echo 'price: ' . $product->getPrice() . "\n";
		echo '</pre>';
    }

    private static function printCategory($category) {
		echo '<pre>';
		echo "Category:\n";
		echo 'id: ' . $category->getId() . "\n";
		echo 'name: ' . $category->getCategoryName() . "\n";
		echo '</pre>';
    }

    private static function printBasketAmount($basket) {
        echo '<pre>';
        echo "Basket total:\n";
        echo 'Total article costs: ' . $basket->getTotalAmountArticles() . "\n";
        echo 'Shipping costs: ' . $basket->getShippingFee() . " (more than 20 euro's on products from bol.com is free shipping)\n";
        echo 'Total price: ' . $basket->getTotal() . "\n";
        echo '</pre>';
    }

    private static function printBasketItems($basketitem) {
        echo '<pre>';
        echo "Basket item:\n";
        echo 'id: ' . $basketitem->getId() . "\n";
        echo 'Price: ' . $basketitem->getPrice() . "\n";
        echo 'Quantity: ' . $basketitem->getQuantity() . "\n";
        echo '</pre>';
    }
    private static function printBasketProduct($basketproduct) {
        echo '<pre>';
        echo "Basket item product:\n";
        echo 'id: ' . $basketproduct->getBasketItemId() . "\n";
        echo 'Title: ' . $basketproduct->getBasketItemTitle() . "\n";
        echo 'Type: ' . $basketproduct->getBasketItemType() . "\n";
        echo '</pre>';
    }

}

?>