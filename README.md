phpexamplecode
==============

Example code for using the bol.com Open API.

If you want to contribute to this code sample. You can do a Fork and a Pull request on this repo.

This application does the following requests:
------------------------------------------
- Ping request
- Product request
- Recommandation request
- Listresults request
- Searchresults request
- Basket requests

What are the files included:
------------------------------
- Request.php:
 - Setup connection with the server
 - Combining the String to sign digital
 - Hash based on HMAC-SHA256 (with Base64)
- TestClient.php:
 - Example code todo a request (place the right URL and call the methods in Request.php)
- App.php
 - Main class to run the application
- Category.php, CategoryRefinement.php, Basket.php, BasketItem.php, BasketProduct.php and Product.php
 - Example classes for getting the Category, CategoryRefinement, Basket and Product object
- Config.php
 - File to set the Key and Secret and other stuff
- index.php
 - Call to the class "App" and a global function to load the classes


Minimum requirements:
----------
1. PHP 5.0 (or higher)


Installation and running the application:
------------------------------------
1. Get the code by forking or downloading the zip
2. Upload all files (keep the directory structure) to a web-server
3. Edit the file "config.php" to add the right AccessKeyID and SecretAccessKey (request this key and secret at https://developers.bol.com/inloggen/?action=register)
4. Open the browser and call the URL where your index.php file is located
