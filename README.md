# bol.com OpenAPI PHP client #

Client library with example code for using the bol.com Open API Version 4. If you need a client/example for Version 3 of the Open API you can use https://github.com/devbolcom/bolcom-openapi-php-client/tree/bolcom-openapi-php-client-v3

If you want to contribute to this library. You can do a Fork and a Pull request on this repo.

## The library contains the following requests that are also included in the example script: ##
- Ping request
- Product request
- Recommendation request
- RelatedProducts request
- Offer request
- Lists request
- Search request
- Sessions request
- Basket requests
- Wishlist requests
- setReferrer request (You need to ask extended permission from Developer Center team for this request)
- Auth requests (You need to ask extended permission from Developer Center team for this request)

## What are the files included: ##
### Client ###
- Request.php:
 - Setup connection with the server
 - Send session with header
- Client.php:
 - Example code todo a request
- Accessories.php, Basket.php, BasketItem.php, BasketItemProduct.php, Category, CategoryRefinement.php, Offers.php, Product.php, ProductFamilies.php and Product.php
 - Example classes for getting the objects

### Example ###
- Example.php
 - Main class to run the application
- index.php
 - Call to the class "Example" with key, format and debug_mode and a global function to load the classes

## Minimum requirements: ##
- PHP 5.3.2 (or higher)


## Installation and running the example: ##

1. Get the code by forking or downloading the zip or installing Composer
2. Upload all files (keep the directory structure) to a web-server
3. Edit the example file "examples/Example.php" to add the right AccessKeyID (request this key at https://developers.bol.com/inloggen/?action=register), response format (xml/json) and debug mode bool (0/1)
4. Open the browser and call the URL where your index.php file is located

## Developer Documentation ##
http://developers.bol.com/documentatie/handleiding/

## Basic Example ##
See the examples/ directory for examples of the key client features.

```php
    function __autoload($className) {
        $fileName = preg_replace('/^BolCom\\\\(\w+)/', 'src/bolcom/$1.php', $className);
        if (file_exists($fileName)) {
            return require_once $fileName;
        }
    }

	$apiClient = new BolCom\Client("YOUR_APP_KEY","RESPONSE_FORMAT","DEBUG_MODE");
	$response = $apiClient->getProduct('1002004010708531');
	var_dump($response);
```

## Using Composer ##

    composer require "bolcom/bolcom-openapi-php-client" "dev-master"

When using composer, classes are autoloaded automatically.

## Running Tests ##

```bash
APP_KEY=YOUR_APP_KEY phpunit --bootstrap=vendor/autoload.php tests
```


