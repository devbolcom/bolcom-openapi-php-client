<?php

class Example {
  public static $rooturl;
  public static $bRaw;
  public static $apiClient = null;
  public static $bolPartnerSiteId;
  public static function run() {
    $bol_api_key = 'YOUR_API_KEY_HERE';
    $bol_api_format = 'json';
    $bol_api_debug_mode = 0;
    $bol_api_library_version = 'v.2.1.0';
    self::$bolPartnerSiteId = '12345';
    self::$apiClient = new Client($bol_api_key, $bol_api_format, $bol_api_debug_mode);
    $servername = str_replace("www.", "", $_SERVER['SERVER_NAME']);
    self::$rooturl = 'http://' . $servername . $_SERVER['SCRIPT_NAME'];
    print('<html><body style="margin:20px;"><h4>PHP example code</h4>');
    print("In this example you can test the following calls from the bol.com Open API (Version: " . $bol_api_library_version . " API version: 4):");
    print('<ul>');
    print('<li><a href="' . self::$rooturl . '?action=getproduct">GET /catalog/v4/products/</a> (<a href="' . self::$rooturl . '?action=getproduct&type=raw">* full response</a>)</li>');
    print('<li><a href="' . self::$rooturl . '?action=getrecommendations">GET /catalog/v4/recommendations/</a> (<a href="' . self::$rooturl . '?action=getrecommendations&type=raw">* full response</a>)</li>');
    print('<li><a href="' . self::$rooturl . '?action=getrelatedproducts">GET /catalog/v4/relatedproducts/</a> (<a href="' . self::$rooturl . '?action=getrelatedproducts&type=raw">* full response</a>)</li>');
    print('<li><a href="' . self::$rooturl . '?action=getoffer">GET /catalog/v4/offers/</a> (<a href="' . self::$rooturl . '?action=getoffer&type=raw">* full response</a>)</li>');
    print('<li><a href="' . self::$rooturl . '?action=getlists">GET /catalog/v4/lists/</a> (<a href="' . self::$rooturl . '?action=getlists&type=raw">* full response</a>)</li>');
    print('<li><a href="' . self::$rooturl . '?action=search">GET /catalog/v4/search/</a> (<a href="' . self::$rooturl . '?action=search&type=raw">* full response</a>)</li>');
    print('<li><a href="' . self::$rooturl . '?action=setRefferer">PUT /checkout/v4/referrers/</a></li>');
    print('<li><a href="' . self::$rooturl . '?action=setSession">GET /accounts/v4/sessions/</a></li>');
    print('<li>Basket calls example steps:</li>');
    print('<ul>');
    print('<li><strong>Step 1: Get a session (above /accounts/v4/sessions/ call) for an anonymous basket or auth for your personal basket (below /accounts/v4/authtokens call) if you haven\'t already.</strong></li>');
    print('<li><strong>Step 2: Add item to basket</strong> <a href="' . self::$rooturl . '?action=postbasket">POST /checkout/v4/baskets/</a></li>');
    print('<li><strong>Step 3: Get contents of basket</strong> <a href="' . self::$rooturl . '?action=getbasket">GET /checkout/v4/baskets/</a>  (<a href="' . self::$rooturl . '?action=getbasket&type=raw">* full response</a>)</li>');
    print('<li><strong>Step 4: Update quatity with to 3 items</strong> <a href="' . self::$rooturl . '?action=updatequantitybasket&quantity=3">PUT /checkout/v4/baskets/{basketItemId}/{quantity}</a></li>');
    print('<li><strong>Step 5: Add another item to the basket</strong> <a href="' . self::$rooturl . '?action=addanotheritemtobasket">POST /checkout/v4/baskets/</a></li>');
    print('<li><strong>Step 6: Remove item from basket</strong> <a href="' . self::$rooturl . '?action=removefrombasket">DELETE /checkout/v4/baskets/{basketItemId}</a></li>');
    print('<li><strong>Step 7: Deeplink to</strong> <a href="http://partner.bol.com/click/click?p=1&t=url&s=123456&f=API&url=https%3A%2F%2Fafrekenen.bol.com%2Fnl%2Fwinkelwagentje%2Fdirect-toevoegen%3Freturnurl%3Dhttp%3A%2F%2Fdevelopers.bol.com%2Fexamples%2Fphpexamplecodelibrary%2F%26name%3DMy%2Bshop%26logoid%3D51%26siteid%3D123456%26openapisessionid%3D' . $_SESSION['sessionid'] . '" target="_BLANK">the checkout based on session id</a></li>');
    print('</ul>');
    print('<li>Wishlist calls example steps:</li>');
    print('<ul>');
    print('<li><strong>Step 1: Get a session (above /accounts/v4/sessions/ call) for an anonymous wishlist or auth for your personal wishlist (below /accounts/v4/authtokens call) if you haven\'t already.</strong></li>');
    print('<li><strong>Step 3: Add item to wishlist</strong> <a href="' . self::$rooturl . '?action=postwishlist">POST /accounts/v4/wishlists/</a></li>');
    print('<li><strong>Step 2: Get contents of wishlist</strong> <a href="' . self::$rooturl . '?action=getwishlist">GET /accounts/v4/wishlists/</a> (<a href="' . self::$rooturl . '?action=getwishlist&type=raw">* full response</a>)</li>');
    print('<li><strong>Step 4: Remove item from wishlist</strong> <a href="' . self::$rooturl . '?action=deletewishlist">DELETE /accounts/v4/wishlists/</a></li>');
    print('</ul>');
    print('<li>Auth for Basket and Wishlist calls steps:</li>');
    print('<ul>');
    print('<li><strong>Step 1: get private auth token and auth url</strong> <a href="' . self::$rooturl . '?action=authtoken">POST /accounts/v4/authtokens/</a> (<a href="' . self::$rooturl . '?action=authtoken&type=raw">* full response</a>)</li>');
    print('<li><strong>Step 2: Authorise on bol.com with url from Step 1</strong></li>');
    print('<li><strong>Step 3: Get authorized session from via API</strong> <a href="' . self::$rooturl . '?action=login&privatetoken=' . $_SESSION['privatetoken'] . '">POST /auth/v4/login/</a></li>');
    print('<li><strong>Optional step 4: Remove all current active browser sessions</strong> <a href="' . self::$rooturl . '?action=destroySession">Call session_destroy() in php</a></li>');
    print('</ul>');
    print('</ul>');
    print("See the V4 documentation <a href='https://developers.bol.com/documentatie/open-api/handleiding/' target='_blank'>here</a>. Download this example on <a href='https://github.com/devbolcom/bolcom-openapi-php-client'>https://github.com/devbolcom/bolcom-openapi-php-client</a>.<br>");
    print('----');

    // convert html characters in $_REQUEST params for Cross-site scripting (XSS)
    foreach ($_REQUEST as $key => $value) {
      $params[$key] = htmlspecialchars($value);
    }
    
    // set type of result in raw or otherwise filtered
    self::$bRaw = isset($params['type']) ? 1 : "0";
    
    // get action param for which data to get or post
    $action = isset($params['action']) ? $params['action'] : "default";
    switch($action) {
      case 'default' :
        self::ping();
        break;
      case 'getproduct' :
        self::getProduct($params);
        break;
      case 'getrecommendations' :
        self::getRecommendations($params);
        break;
      case 'getrelatedproducts' :
        self::getRelatedProducts($params);
        break;
      case 'getoffer' :
        self::getOffer($params);
        break;
      case 'getlists' :
        self::getLists($params);
        break;
      case 'search' :
        self::search($params);
        break;
      case 'sellerlists' :
        self::getSellerlists($params);
        break;
      case 'postbasket' :
        self::postBasket();
        break;
      case 'getbasket' :
        self::getBasket();
        break;
      case 'updatequantitybasket' :
        self::updateQuantityBasket($params);
        break;
      case 'removefrombasket' :
        self::removefromBasket();
        break;
      case 'addanotheritemtobasket' :
        self::addAnotherItemToBasket($params);
        break;
      case 'authtoken' :
        self::getAuthTokens();
        break;
      case 'authtokenSuccess' :
        self::getAuthtokensSuccess();
        break;
      case 'authtokenError' :
        self::getAuthtokensError();
        break;
      case 'login' :
        self::getLogin($params);
        break;
      case 'getwishlist' :
        self::getWishlist();
        break;
      case 'postwishlist' :
        self::postWishlist();
        break;
      case 'deletewishlist' :
        self::deleteWishlist();
        break;
      case 'setRefferer' :
        self::setRefferer();
        break;
      case 'setSession' :
        self::setSession();
        break;
      case 'destroySession' :
        self::destroySession();
        break;
    }

  }

  private static function ping() {
    // ping request, /rest/utils/v4/ping
    self::printValue('Performing ping request');
    self::printValue('----');
    $ping = self::$apiClient -> getPingResponse();
    self::printValue('----');
    self::printValue("Full response");
    self::printValue('----');
    self::printValue($ping);
    self::printValue(" ");
  }

  private static function getProduct($params = '') {
    // product request /catalog/v4/products/{id} + queryParams
    if (!isset($params['productid']))
      $productid = '1002004010708531';
    else
      $productid = urldecode($params['productid']);
    self::printValue('Performing products request with productid ' . $productid . ', includeattributes = true  and offers = all');
    self::printValue('----');
    $response = self::$apiClient -> getProduct($productid, '?includeattributes=true&offers=all');
    if (self::$bRaw != 0) {
      self::printValue("Full response");
      self::printValue('----');
      self::printValue($response);
    } else {
      $product = new Product($response->products[0]);
      self::printProduct($product);
    }
    self::printValue(" ");
  }

  private static function getOffer($params = '') {
    // product request /catalog/v4/offers/{id} + queryParams
    if (!isset($params['productid']))
      $productid = '1002004010708531';
    else
      $productid = urldecode($params['productid']);
    self::printValue('Performing offer request with productid ' . $productid . ', includeattributes = true  and offers = cheapest');
    self::printValue('----');
    $response = self::$apiClient -> getOffer($productid, '?includeattributes=true&offers=cheapest');
    if (self::$bRaw != 0) {
      self::printValue("Full response");
      self::printValue('----');
      self::printValue($response);
    } else {
      foreach ($response->offerData->offers as $child) {
        $offers = new Offers($child);
        self::printOffers($offers);
      }
    }
    self::printValue(" ");
  }

  private static function getRecommendations($params = '') {
    // get recommendations /catalog/v4/recommendations/{id} + queryParams
    if (!isset($params['productid']))
      $productid = '1002004010708531';
    else
      $productid = urldecode($params['productid']);
    self::printValue('Performing recommendations request with productid ' . $productid . ', includeattributes = false, limit = 2, offset = 0  and offers = cheapest');
    self::printValue('----');
    $response = self::$apiClient -> getRecommendations($productid, '?includeattributes=false&limit=2&offset=0&offers=cheapest');
    if (self::$bRaw != 0) {
      self::printValue("Full response");
      self::printValue('----');
      self::printValue($response);
    } else {
      $list = array();
      foreach ($response->products as $child) {
        $list[] = new Product($child);
      }

      foreach ($list as $item) {
        if ($item instanceof Product) {
          self::printProduct($item);
        }
      }
      self::printValue(" ");
    }
  }

  private static function getRelatedProducts($params = '') {
    // get related products /catalog/v4/relatedproducts/{id} + queryParams
    if(!isset($params['productid'])) $productid = '9200000009187246'; else $productid = urldecode($params['productid']);
    self::printValue('Performing relatedproducts request with productid '.$productid.', dataset = productfamily,accessories');
    self::printValue('----');
    $response = self::$apiClient->getRelatedProducts($productid,'?dataset=productfamily,accessories');
    if(self::$bRaw !=0) {
        self::printValue("Full response");
        self::printValue('----');
        self::printValue($response);
    } else {
        if(isset($response->productFamilies)) {
            $list = array();
            foreach($response->productFamilies as $child) {
                $list[] = new ProductFamilies($child);
            }
            foreach($list as $item) {
                if($item instanceof ProductFamilies) {
                    self::printProductFamilie($item);
                    foreach($item->getProductFamilyMembers() as $itemFamilie) {
                        self::printProductFamilies($itemFamilie);
                    }
                }
            }
            $productids = '';
            foreach($response->accessories as $child) {
                $productids .= $child->productId.',';
            }
            $response = self::$apiClient->getProduct(rtrim($productids, ","),'');
            $list = array();
            foreach($response->products as $child) {
                $list[] = new Product($child);
            }
    
            foreach($list as $item) {
                if($item instanceof Product) {
                    self::printProduct($item,'Accessoires');
                }
            }
        } else {
            self::printValue("No products available");
        }
        self::printValue(" ");
    }
  }

  private static function getLists($params = '') {
    // list products /catalog/v4/lists/ + queryParams
    if (!isset($params['ids'])) {
      //$ids = '6142,7288,6268';
      $sorting = 'publishing_date';
      self::printValue('Performing listresults request with type = "toplist_default", sort = "publishing_date" and ids = "Actie & Avontuur (6142)", "Te reserveren (7288)" and "Vanaf 12 jaar (6268)" met een limit van 5');
    } else {
      $ids = urldecode($params['ids']);
      $sorting = (!isset($params['sorting']) ? 'publishing_date' : $params['sorting']);
      self::printValue('Performing listresults request with type = "toplist_default", sort = "' . $params['sorting'] . '" and ids = "' . $params['ids'] . '"');
    }
    self::printValue('----');
    $response = self::$apiClient -> getLists('toplist_default', $ids, 0, 10, $sorting, false, true, false, false);
    if (self::$bRaw != 0) {
      self::printValue("Full response");
      self::printValue('----');
      self::printValue($response);
    } else {
      $list = array();
      foreach ($response->products as $child) {
        $list[] = new Product($child);
      }
      $i = 1;
      foreach ($list as $item) {
        echo $i++;
        self::printProduct($item);
      }
    }
    self::printValue(" ");
  }

  private static function search($params = '') {
    // search products /catalog/v4/search/ + queryParams
    if (!isset($params['q'])) {
      $q = 'Harry Potter';
      $ids = '1430,8293,4855';
      self::printValue('Performing searchresults request based on q = "' . $q . '", ids = "Nederlandse boeken (1430)", "Nederlandse boeken (8293)" and "Tot &euro; 30 (4855)", 5 items and sort on "sales_ranking"');
    } else {
      $q = urldecode($params['q']);
      $ids = (!isset($params['ids']) ? null : $params['ids']);
      $pids = (!isset($params['pids']) ? null : $params['pids']);
      $searchfield = (!isset($params['searchfield']) ? null : $params['searchfield']);
      self::printValue('Performing searchresults request based on q = "' . $q . '", ids = "' . $ids . '" and sort on "sales_ranking"');
    }
    self::printValue('----');
    $response = self::$apiClient -> getSearch($q, $ids, $pids, 0, 10, 'sales_ranking', false, true, true, true, '', $searchfield);
    if (self::$bRaw != 0) {
      self::printValue("Full response");
      self::printValue('----');
      self::printValue($response);
    } else {
      $list = array();
      foreach ($response->products as $child) {
        $list[] = new Product($child);
      }

      foreach ($list as $item) {
        self::printProduct($item);
      }
    }
    self::printValue(" ");
  }

  private static function setSession($sessionfromlogin = 0) {
    // set session function
    if (!$sessionfromlogin) {
      if (!isset($_SESSION['created'])) {
        $_SESSION['created'] = time();
        $_SESSION['sessionid'] = self::$apiClient -> getSessionId() -> sessionId;
        self::printValue('setSession for anonymous basket');
        self::printValue('----');
      } else if (time() - $_SESSION['created'] > 1200) {
        // session started more than 30 minutes ago
        session_regenerate_id(true);
        // change session ID for the current session an invalidate old session ID
        $_SESSION['created'] = time();
        // update creation time
        $_SESSION['sessionid'] = self::$apiClient -> getSessionId() -> SessionId;
        self::printValue('setSession for anonymous basket renewed');
        self::printValue('----');
      } else {
        self::printValue('Session still active');
        self::printValue('----');
      }
      self::printValue('session id ' . $_SESSION['sessionid'] . ' created on ' . date('H:i:s', $_SESSION['created']) . ' and valid to ' . date('H:i:s', ($_SESSION['created'] + 1200)));
    } else {
      $_SESSION['created'] = time();
      $_SESSION['sessionid'] = $sessionfromlogin;
      self::printValue('session id ' . $_SESSION['sessionid'] . ' renewed on ' . date('H:i:s', $_SESSION['created']) . ' and valid to ' . date('H:i:s', ($_SESSION['created'] + 1200)));
    }
  }

  private static function checkSession() {
    // check if session is set
    if (!isset($_SESSION['created'])) {
      self::printValue('No session, do a setSession first');
      $state = 0;
    } else if (time() - $_SESSION['created'] > 1200) {
      self::printValue('No valid active session, do a setSession again');
      $state = 0;
    } else {
      self::printValue('Session still active');
      $state = 1;
    }
    self::printValue(" ");
    return $state;
  }

  private static function destroySession() {
    // destroy session
    self::printValue("Session destroyed");
    self::printValue(" ");
    session_destroy();
  }

  private static function postBasket() {
    // add product to basket  /checkout/v4/baskets/{id}/{quantity}/{ipAddress}
    if (self::checkSession()) {
      //set basket sessionid so that it's used in the call we are going to make
      self::$apiClient -> setSessionId($_SESSION['sessionid']);

      self::printValue('Adding item 1002004010708531 to the basket with sessionid: ' . $_SESSION['sessionid']);
      self::printValue('----');
      self::printValue("Calling GET /catalog/v4/products/ first to get the offerid from a productid.");
      self::printValue('----');
      $responseProduct = self::$apiClient -> getProduct('1002004010708531');
      $product = new Product($responseProduct -> products[0]);
      $offers = $product -> getOffers();
      self::printValue('Then calling /checkout/v4/baskets/ and adding offer id ' . $offers[0] -> id . 'to the basket');
      self::printValue('----');

      //Add offerid, quantity and clients IP to create and add a product to a basket
      $response = self::$apiClient -> addToBasket($offers[0] -> id, 1, $_SERVER['REMOTE_ADDR']);

      self::printValue("No JSON returned, returning http header");
      self::printValue($response);
      self::printValue(" ");
    }
  }

  private static function getBasket() {
      // get basket with contents /checkout/v4/baskets + sessionid
      if(self::checkSession()) {
          self::$apiClient->setSessionId($_SESSION['sessionid']);
          self::printValue('Get your anonymous basket based on sessionid: '.$_SESSION['sessionid']);
          self::printValue('----');
          $response = self::$apiClient->getBasket();
          if(self::$bRaw != 0) {
              self::printValue("Full response");
              self::printValue('----');
              self::printValue($response);
          } else {
              $basket = new Basket($response);
              self::printBasketAmount($basket);
              
              if(isset($response->basketItems)) {
                  $listitem = array();
                  $listproduct = array();
                foreach($response->basketItems as $item) {
                      $listitem[] = new BasketItem($item);
                      $listproduct[] = new BasketItemProduct($item->product);
                }
                  foreach($listitem as $item) {
                   self::printBasketItems($item);
                  }
                  foreach($listproduct as $item) {
                     self::printBasketProduct($item);
                  }
                  if(isset($listitem[0])) $_SESSION['basketitemid'] = $listitem[0]->getId();
              }
              self::printValue(" ");
              //update the session lifetime with making this call
              self::setSession($_SESSION['sessionid']);
          }
      }
  }

  private static function updateQuantityBasket($params = '') {
    // update the quantity of the basket for a certain product /rest/checkout/v4/baskets/{basketItemId}/{quantity} + sessionid
    if (self::checkSession()) {
      self::$apiClient -> setSessionId($_SESSION['sessionid']);
      if (!isset($_SESSION['sessionid'])) {
        self::printValue("No Basket, do a POST first");
        self::printValue(" ");
      } else if (!isset($_SESSION["basketitemid"])) {
        self::printValue("No Basketitem, do a GET first to get this");
        self::printValue(" ");
      } else if (!isset($params['quantity'])) {
        self::printValue("No Quantity given");
        self::printValue(" ");
      } else {
        self::printValue('Update the quantity of product 1002004010708531 in your anonymous basket');
        self::printValue('----');
        $response = self::$apiClient -> updateQuantityBasket($_SESSION["basketitemid"], $params['quantity']);
        self::printValue($response);
        self::printValue(" ");
        //update the session lifetime with making this call
        self::setSession($_SESSION['sessionid']);
      }
    }
  }

  private static function addAnotherItemToBasket() {
    // Add another product to the already existing basket /rest/checkout/v4/baskets/{id}/{quantity}/{ipAddress} + sessionid

    // check if sessionid for basket is available
    if (self::checkSession()) {
      self::$apiClient -> setSessionId($_SESSION['sessionid']);
      self::printValue('Adding product Pulp Fiction (1002004013540233) to the existing basket');
      self::printValue('----');

      $responseProduct = self::$apiClient -> getProduct('1002004013540233');
      $product = new Product($responseProduct -> products[0]);
      $offers = $product -> getOffers();
      self::printValue('Add the bol.com offer id ' . $offer[0] -> id . ' to the basket (first offer)');
      self::printValue('----');
      //Add offerid, quantity and clients IP to create and add a product to a basket
      $response = self::$apiClient -> addToBasket($offers[0] -> id, 1, $_SERVER['REMOTE_ADDR']);
      self::printValue("No JSON returned, returning http header");
      self::printValue($response);
      self::printValue(" ");
      //update the session lifetime with making this call
      self::setSession($_SESSION['sessionid']);
    } else {
      self::printValue("Create a basket first, no basket active");
      self::printValue(" ");
    }
  }

  private static function removeFromBasket() {
    // remove first product from the basket /checkout/v4/baskets/{basketItemId} + sessionid
    // set basket sessionid
    if (self::checkSession()) {
      self::$apiClient -> setSessionId($_SESSION['sessionid']);
      //check if sessionid for basket is available
      if (!isset($_SESSION['sessionid'])) {
        self::printValue("No Basket, do a POST first");
        //check if a basketitem is available
      } else if (!isset($_SESSION["basketitemid"])) {
        self::printValue("No Basketitem, do a GET first to get this");
      } else {
        self::printValue('Remove first product in your anonymous basket with basket item id: ' . $_SESSION["basketitemid"]);
        self::printValue('----');
        $response = self::$apiClient -> removeFromBasket($_SESSION["basketitemid"]);
        unset($_SESSION['basketitemid']);
        self::printValue($response);
        self::printValue(" ");
        //update the session lifetime with making this call
        self::setSession($_SESSION['sessionid']);
      }
    }
    self::printValue(" ");
  }

  private static function postWishlist() {
    // add an product to the wishlist /accounts/v4/wishlists/{productId} + sessionid
    if (self::checkSession()) {
      self::$apiClient -> setSessionId($_SESSION['sessionid']);
      $response = self::$apiClient -> postWishlist('1002004013540233');
      if (self::$bRaw != 0) {
        self::printValue("Full response");
        self::printValue('----');
        self::printValue($response);
      } else {
        self::printValue('Response');
        self::printValue('----');
        self::printValue($response);
      }
      //update the session lifetime with making this call
      self::setSession($_SESSION['sessionid']);
      self::printValue(" ");
    }
  }

  private static function getWishlist() {
    // get the wishlist from the annonymous or authorised user. /accounts/v4/wishlists + sessionid
    if (self::checkSession()) {
      self::$apiClient -> setSessionId($_SESSION['sessionid']);
      $response = self::$apiClient -> getWishlist();
      if (self::$bRaw != 0) {
        self::printValue("Full response");
        self::printValue('----');
        self::printValue($response);
      } else {
        self::printValue('Response');
        self::printValue('----');
        $i = 1;
        if (isset($_SESSION['sessionusername']))
          self::printValue('Wishlist from ' . $_SESSION['sessionusername']);
        if (isset($response -> wishListItems)) {
          $_SESSION['wishListItemId'] = $response -> wishListItems[0] -> id;
          $list = array();
          foreach ($response->wishListItems as $item) {
            $list[] = $item -> product;
          }
          foreach ($list as $child) {
            $product = new Product($child);
            self::printProduct($product);
          }
        } else {
          self::printValue('No items in wishlist yet. Add one with "POST /accounts/v4/wishlists/"');
        }
        self::printValue(" ");
        //update the session lifetime with making this call
        self::setSession($_SESSION['sessionid']);
      }
    }
  }

  private static function deleteWishlist() {
    // delete an item from the wishlist /accounts/v4/wishlists/{wishListItemId} + sessionid
    if (self::checkSession()) {
      self::$apiClient -> setSessionId($_SESSION['sessionid']);
      //check if wishlistitemid for wishlist is available
      if (!isset($_SESSION["wishListItemId"])) {
        self::printValue("No wishListItemId, do a GET /accounts/v4/wishlists/ first to set this within this example");
      } else {
        self::printValue('Removed first product in your wishlist with wishlist item id: ' . $_SESSION["wishlistitemid"]);
        self::printValue('----');
        $response = self::$apiClient -> deleteWishlist($_SESSION["wishListItemId"]);
        unset($_SESSION['wishListItemId']);
        self::printValue($response);
      }
      //update the session lifetime with making this call
      self::setSession($_SESSION['sessionid']);
      self::printValue(" ");
    }
  }

  private static function getAuthtokens() {
    //get the privatetoken a unique code for the requesturl and an authurl. The url for mobile isn't returned in the response. See example below. /accounts/v4/authtokens + successurl + errorurl
    $successUrl = urlencode(self::$rooturl . '?action=authtokenSuccess');
    $errorUrl = urlencode(self::$rooturl . '?action=authtokenError');
    $response = self::$apiClient -> getAuthToken($successUrl, $errorUrl);
    if (!isset($_SESSION['privatetoken'])) {
      $_SESSION['privatetoken'] = (string)$response -> privateToken;
      if (self::$bRaw != 0) {
        self::printValue("Full response");
        self::printValue('----');
        self::printValue($response);
      } else {
        self::printValue("getAuthtokens call response");
        self::printValue('----');
        $authurl = 'https://m.bol.com/nl/apps/?code=' . $response -> code;
        self::printValue('Auth url: <a href="' . $authurl . '" target="_blank">' . $authurl . '</a>');
        self::printValue('Private token "' . $_SESSION['privatetoken'] . '"<br>added to session var');
      }
    } else {
      self::printValue('Auth token already given. Destroy the session <a href="' . self::$rooturl . '?action=destroySession">here</a> and call POST /accounts/v4/authtokens/ again.');
    }
    self::printValue(" ");
  }

  private static function getAuthtokensSuccess() {
    // Message to show when auth is successfully given
    $url = self::$rooturl . "?action=login&privatetoken=" . $_SESSION['privatetoken'];
    self::printValue("Token successfully authorised! Go to <a href='" . $url . "'>POST /auth/v4/login</a>");
    self::printValue(" ");
  }

  private static function getAuthtokensError() {
    //Messeage to show when auth is refused
    self::printValue("Token not authorised!");
    self::printValue(" ");
  }

  private static function getLogin($params = '') {
    // get a session that can be used to retrieve data for the authorised user. /accounts/v4/login
    if ($params['privatetoken']) {
      $_SESSION['privatetoken'] = $params['privatetoken'];
      unset($_SESSION['loggedin']);
      unset($_SESSION['sessionusername']);
    }
    if (!isset($_SESSION['loggedin'])) {
      if (isset($_SESSION['privatetoken'])) {
        self::printValue("You can also add an existing session to this call and have this one merged with the previous one with wishlist items or basket items. Then the response with have a mergedBasket set to true.");
        self::printValue('----');
        if (isset($_SESSION['created']))
          self::$apiClient -> setSessionId($_SESSION['sessionid']);
        $response = self::$apiClient -> getLogin($_SESSION['privatetoken']);
        $_SESSION['sessionusername'] = (string)$response -> name;
        $_SESSION['loggedin'] = 1;
        self::setSession((string)$response -> sessionId);
        self::$apiClient -> setSessionId($_SESSION['sessionid']);
        self::printValue("Full response");
        self::printValue('----');
        self::printValue($response);
        self::printValue('----');
        self::printValue('By saving the private token you can get the data (if authorised) of the user at any time (until revoked by the user). To test you can copy this <a href="?action=login&privatetoken=' . $_SESSION['privatetoken'] . '">link</a> in a new browser session.');
      } else {
        self::printValue("No session or privatetoken from loggedin user auth active");
      }
    } else {
      self::printValue("Already a loggedin session active.");
    }
    self::printValue(" ");
  }

  private static function setRefferer() {
    // get a refferer code and call /checkout/v4/referrers/{referrerCode} + sessionid
    if (self::checkSession()) {
      self::$apiClient -> setSessionId($_SESSION['sessionid']);
      $refferrerfromurl = self::getReferrerFromPartnerUrl();
      $response = self::$apiClient -> setRefferer($refferrerfromurl);
      self::printValue("No JSON returned, returning http header");
      self::printValue('----');
      self::printValue($response);
    }
    self::printValue(" ");
  }

  private static function getReferrerFromPartnerUrl() {
    // getting a refferer code by making a http call to http://partner.bol.com/click/click and reading the header
    $url = 'http://partner.bol.com/click/click?p=1&t=url&s=' . self::$bolPartnerSiteId . '&f=API&url=http%3A%2F%2Fwww.bol.com%2Fnl%2F';
    $headerresponse = get_headers($url);
    $location = explode(" ", $headerresponse[3]);
    $referrer = $location[1];
    return $referrer;
  }

  private static function printValue($value) {
    echo '<pre>' . print_r($value, 1) . '</pre>';
  }

  private static function printProduct($product, $title = null) {
    echo '<pre>';
    if ($title)
      echo $title . ":\n";
    else
      echo "Product:\n";
    echo 'id: ' . $product -> getId() . "\n";
    echo 'title: ' . $product -> getTitle() . "\n";
    echo 'price: ' . $product -> getFirstAvailablePrice() . "\n";
    echo '</pre>';
  }

  private static function printCategory($category) {
    echo '<pre>';
    echo "Category:\n";
    echo 'id: ' . $category -> getId() . "\n";
    echo 'name: ' . $category -> getCategoryName() . "\n";
    echo '</pre>';
  }

  private static function printOffers($offers) {
    echo '<pre>';
    echo " Offer:\n";
    echo ' id: ' . $offers -> getId() . "\n";
    echo ' price: ' . $offers -> getPrice() . "\n";
    echo ' seller: ' . $offers -> getSellerDisplayName() . "\n";
    echo '</pre>';
  }

  private static function printProductFamilie($productfamilies) {
    echo '<pre>';
    echo "Productfamilie:\n";
    echo 'key: ' . $productfamilies -> getKey() . "\n";
    echo 'label: ' . $productfamilies -> getLabel() . "\n";
    echo '</pre>';
  }

  private static function printProductFamilies($productfamilies) {
    echo '<pre>';
    echo " Productfamilies:\n";
    echo ' key: ' . $productfamilies -> label . "\n";
    echo ' productid: ' . $productfamilies -> productId . "\n";
    echo '</pre>';
  }

  private static function printBasketAmount($basket) {
    echo '<pre>';
    echo "Basket total:\n";
    echo 'Total article costs: ' . $basket -> getTotalAmountArticles() . "\n";
    echo 'Shipping costs: ' . $basket -> getShippingFee() . " (more than 20 euro's on products from bol.com is free shipping)\n";
    echo 'Total price: ' . $basket -> getTotal() . "\n";
    echo '</pre>';
  }

  private static function printBasketItems($basketitem) {
    echo '<pre>';
    echo "Basket item:\n";
    echo 'id: ' . $basketitem -> getId() . "\n";
    echo 'Price: ' . $basketitem -> getPrice() . "\n";
    echo 'Quantity: ' . $basketitem -> getQuantity() . "\n";
    echo '</pre>';
  }

  private static function printBasketProduct($basketproduct) {
    echo '<pre>';
    echo "Basket item product:\n";
    echo 'id: ' . $basketproduct -> getBasketItemId() . "\n";
    echo 'Title: ' . $basketproduct -> getBasketItemTitle() . "\n";
    echo '</pre>';
  }

}
?>