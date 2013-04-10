<?php

class App {
    
	public static function run() {	
        print_r('<h4>PHP example code</h4>');    
        print_r('<ul>');
        print_r('<ul><li><a href="http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].'?action=getproduct">getProduct</a></li>');
		print_r('<li><a href="http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].'?action=getproducts">getProducts</a></li>');
		print_r('<li><a href="http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].'?action=searchproducts">searchProducts</a></li>');
		print_r('</ul>');
		
	    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "default";
	    switch($action) {
	        case 'default':
	            break;
	        case 'getproduct':
	            self::getProduct();
	            break;
            case 'getproducts':
                self::getProducts();
                break;
            case 'searchproducts':
                self::searchProducts();
                break;
	    }
		
	}

	private static function getProduct() {
	    //Get product
        $testClient = new TestClient(BOL_API_PUBLIC_KEY, BOL_API_PRIVATE_KEY);
        self::printValue('----');
        self::printValue('Performing product request');
        self::printValue('----');
        $product = $testClient->getProduct('1002004010708531','?includeProducts=false&includeCategories=true&includeRefinements=false');
        self::printProduct($product);
        self::printValue(" ");
	}

    private static function getProducts() {
        //List products
        $testClient = new TestClient(BOL_API_PUBLIC_KEY, BOL_API_PRIVATE_KEY);
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
    }
    
    private static function searchProducts() {
        //Search products
        $testClient = new TestClient(BOL_API_PUBLIC_KEY, BOL_API_PRIVATE_KEY);
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
		echo '</pre>';
        echo "Complete result:\n";
		echo '<pre>';
        print_r($product);
        echo '</pre>';
    }

    private static function printCategory($category) {
		echo '<pre>';
		echo "Category:\n";
		echo 'id: ' . $category->getId() . "\n";
		echo 'name: ' . $category->getCategoryName() . "\n";
		echo '</pre>';
        echo "Complete result:\n";
        echo '<pre>';
        print_r($category);
        echo '</pre>';
    }
}

?>