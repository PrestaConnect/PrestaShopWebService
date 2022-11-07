## ```exists()``` Method
The ```->exists()``` method is the same as the ```HEAD``` request in the Web Service API. The ```->exists()``` method checks for the existence of an identified Entity object. Returns ```true``` if the object exists. Returns ```false``` if the object does not exist.<br />
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Product;

try {
    $id_product = 1;
    var_dump(Product::getInstance($id_product)->exists());
    // bool(true)
    
    /*Long write the same method*/
    $product = new Product($id_product);
    var_dump($product->exists());
    // bool(true)
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```
&larr; [Introduction](01-introduction.md) | [List Method](03-list-method.md) &rarr;
