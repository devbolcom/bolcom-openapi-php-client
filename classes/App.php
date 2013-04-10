<?php

class App {

	public static function run() {
		$accessKeyId = 'place your access key id here';
		$secretAccessKey = 'place your secret access key here';
	
		$testClient = new TestClient($accessKeyId, $secretAccessKey);

        //Get product
        self::printValue('----');
        self::printValue('Performing product request');
        self::printValue('----');
		$product = $testClient->getProduct('1002004010708531');
		self::printProduct($product);
		self::printValue(" ");

		//List products
        self::printValue('----');
        self::printValue('Performing listresults request');
        self::printValue('----');
		$list = $testClient->getListResults('toplist_default', '6142 7288 6268', 0, 10, 'price', false, true, false, false);

		foreach($list as $item) {
			if($item instanceof Product) {
				self::printProduct($item);
			}
			if($item instanceof Category) {
				self::printCategory($item);
			}
		}
		self::printValue(" ");

		//Search products
		self::printValue('----');
		self::printValue('Performing searchresults request');
		self::printValue('----');
		$list = $testClient->getSearchResults('Harry Potter', '1430 8293 4855', 0, 5, 'sales_ranking', false, true, true, true);
		foreach($list as $item) {
			if($item instanceof Product) {
				self::printProduct($item);
			}
			if($item instanceof Category) {
				self::printCategory($item);
			}
		}
		self::printValue(" ");
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
		echo '<pre>';
    }

    private static function printCategory($category) {
		echo '<pre>';
		echo "Category:\n";
		echo 'id: ' . $category->getId() . "\n";
		echo 'name: ' . $category->getName() . "\n";
		echo '<pre>';
    }
}

?>