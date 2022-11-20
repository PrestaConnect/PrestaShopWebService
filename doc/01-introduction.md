# Using PrestaShopWebService

- [Installation](#installation)
- [Concept](#concept)
- [Usage The PrestaShopWebService Library](#usage-the-prestashopwebservice-library)
- [Basic Usage](#basic-usage)
- [API Permissions](#api-permissions)
- [API Class List](#api-class-list)
- [Image Class](#image-class)
- [Search Class](#search-class)
- [Validate Class](#validate-class)
- [Tools Class](#tools-class)


## Installation

PrestaShopWebService is available on Packagist ([prestaconnect/prestashopwebservice](http://packagist.org/packages/prestaconnect/prestashopwebservice))
and as such installable via [Composer](http://getcomposer.org/).

```bash
composer require prestaconnect/prestashopwebservice
```
> ⚠ This repo needs ```minimum-stability```: ```dev``` on your composer.json

## Concept
PrestaShop's Web Service API is quite complex. Anyone who develops at the core of PrestaShop is more or less familiar with PrestaShop's ObjectModel. Our aim is to prepare an Object Based Web Service library that is far from the complexity of the Web Service API and is as close to the structure of the ObjectModel as possible. Thus, anyone who has more or less knowledge of PrestaShop's ObjectModel will be able to use the Web Service API easily.

## Usage The ```PrestaShopWebService``` library
Before you start using the library, you must define these two variables in your php file; ```WEBSERVICE_URI``` and ```WEBSERVICE_API_KEY```.<br /><br />
```WEBSERVICE_URI``` should be the main url of your PrestaShop installed site.<br />
Like: https://www.your-prestashop.com/ or https://www.your-prestashop.com/shop/ <br /><br />
How to get your ```WEBSERVICE_API_KEY``` ?<br />
1) Login your PrestaShop Backoffice
2) Go to your Backoffice > Advanced Parameters > Webservice > Configuration
3) Click to "Enable PrestaShop's webservice" switch to yes and click to "save" button
4) Go to your Backoffice > Advanced Parameters > Webservice
5) Click "Add new webservice key" and create a Webservice Key

> ⚠ It is preferable to use ```SSL``` (```https:```) for webservice calls, as it avoids the "man in the middle" type security issues.!

## Basic Usage
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Product;

try {
    $id_product = 1;
    $product = new Product($id_product);
    $p->active = 0;
    var_dump($product->update());
    // returns updated Product Object
    
    // Create object with getInstance($id = null) static method 
    $product = Product::getInstance($id_product);
    $p->active = 0;
    var_dump($product->update());
    // returns updated Product Object
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

> ⚠ We recommend that you always perform the operations of this library inside the ```try {...} catch (\PrestaShopWebserviceException $e) {}``` code block.

## Api Permissions
Permissions are returned as key-value pairs and the value is boolean. If the value is true, it means there is permission, if the value is false, it means no permission.

1) The ```GET``` permission allows executing an entity object's ```list``` method and ```__construct``` method.
2) The ```PUT``` permission allows executing an entity object's ```update``` method.
3) The ```POST``` permission allows executing an entity object's ```add``` method.
4) The ```DELETE``` permission allows executing an entity object's ```delete``` method.
5) The ```HEAD``` permission allows executing an entity object's ```exists``` method.

```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Api;

try {
    var_dump(Api::getPermissions());
    // returns array; api resource, resource permissions and entity namespace of resource
    
    /**
    Typical permission response structure
    [
        'addresses' => [
            'entity' => 'PrestaConnect\Entities\Address',
            'permissions' => [
                'GET' => true,
                'PUT' => true,
                'POST' => true,
                'DELETE' => false,
                'HEAD' => true
            ]
        ],
        'attachments' => [
            'entity' => 'PrestaConnect\Entities\Attachment',
            'permissions' => [
                'GET' => true,
                'PUT' => false,
                'POST' => false,
                'DELETE' => true,
                'HEAD' => true
            ]
        ]
        ...
    ]
    **/
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

## Api Class List
> \PrestaConnect\Entities\Api<br />
> \PrestaConnect\Entities\Address<br />
> \PrestaConnect\Entities\Attachment<br />
> \PrestaConnect\Entities\Attribute<br />
> \PrestaConnect\Entities\AttributeGroup<br />
> \PrestaConnect\Entities\CMS<br />
> \PrestaConnect\Entities\Carrier<br />
> \PrestaConnect\Entities\Cart<br />
> \PrestaConnect\Entities\CartRule<br />
> \PrestaConnect\Entities\Category<br />
> \PrestaConnect\Entities\Combination<br />
> \PrestaConnect\Entities\Configuration<br />
> \PrestaConnect\Entities\Contact<br />
> \PrestaConnect\Entities\Country<br />
> \PrestaConnect\Entities\Currency<br />
> \PrestaConnect\Entities\Customer<br />
> \PrestaConnect\Entities\CustomerMessage<br />
> \PrestaConnect\Entities\CustomerThread<br />
> \PrestaConnect\Entities\Customization<br />
> \PrestaConnect\Entities\CustomizationField<br />
> \PrestaConnect\Entities\Delivery<br />
> \PrestaConnect\Entities\Employee<br />
> \PrestaConnect\Entities\Feature<br />
> \PrestaConnect\Entities\FeatureValue<br />
> \PrestaConnect\Entities\Group<br />
> \PrestaConnect\Entities\Guest<br />
> \PrestaConnect\Entities\ImageType<br />
> \PrestaConnect\Entities\Language<br />
> \PrestaConnect\Entities\Manufacturer<br />
> \PrestaConnect\Entities\Message<br />
> \PrestaConnect\Entities\Order<br />
> \PrestaConnect\Entities\OrderCarrier<br />
> \PrestaConnect\Entities\OrderCartRule<br />
> \PrestaConnect\Entities\OrderDetail<br />
> \PrestaConnect\Entities\OrderHistory<br />
> \PrestaConnect\Entities\OrderInvoice<br />
> \PrestaConnect\Entities\OrderPayment<br />
> \PrestaConnect\Entities\OrderSlip<br />
> \PrestaConnect\Entities\OrderState<br />
> \PrestaConnect\Entities\Product<br />
> \PrestaConnect\Entities\ProductSupplier<br />
> \PrestaConnect\Entities\RangePrice<br />
> \PrestaConnect\Entities\RangeWeight<br />
> \PrestaConnect\Entities\Shop<br />
> \PrestaConnect\Entities\ShopGroup<br />
> \PrestaConnect\Entities\ShopUrl<br />
> \PrestaConnect\Entities\SpecificPrice<br />
> \PrestaConnect\Entities\SpecificPriceRule<br />
> \PrestaConnect\Entities\State<br />
> \PrestaConnect\Entities\Stock<br />
> \PrestaConnect\Entities\StockAvailable<br />
> \PrestaConnect\Entities\StockMvt<br />
> \PrestaConnect\Entities\StockMvtReason<br />
> \PrestaConnect\Entities\Store<br />
> \PrestaConnect\Entities\Supplier<br />
> \PrestaConnect\Entities\SupplyOrder<br />
> \PrestaConnect\Entities\SupplyOrderDetail<br />
> \PrestaConnect\Entities\SupplyOrderHistory<br />
> \PrestaConnect\Entities\SupplyOrderReceiptHistory<br />
> \PrestaConnect\Entities\SupplyOrderState<br />
> \PrestaConnect\Entities\Tag<br />
> \PrestaConnect\Entities\Tax<br />
> \PrestaConnect\Entities\TaxRule<br />
> \PrestaConnect\Entities\TaxRulesGroup<br />
> \PrestaConnect\Entities\TranslatedConfiguration<br />
> \PrestaConnect\Entities\Warehouse<br />
> \PrestaConnect\Entities\WarehouseProductLocation<br />
> \PrestaConnect\Entities\Zone<br />

## Image Class
> \PrestaConnect\Entities\Image

## Search Class
> \PrestaConnect\Entities\Search

## Validate Class
> \PrestaConnect\Validate

## Tools Class
> \PrestaConnect\Tools

[Exists Method](02-exists-method.md) &rarr;
