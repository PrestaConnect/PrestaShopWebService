# Image Class Usage

## Theme Images
It includes methods that allow you to update the theme logos of your site. Just like in ```Backoffice > IMPROVE > Design > Theme &amp; Logo > Logo``` section.
### Update Logo
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $image_path = '/path/to/your/logo.jpg';
    var_dump(Image::getInstance()->updateLogo($image_path));
    // returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```
### Update Mail Logo
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $image_path = '/path/to/your/logo.jpg';
    var_dump(Image::getInstance()->updateMailLogo($image_path));
    // returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```
### Update Invoice Logo
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $image_path = '/path/to/your/logo.jpg';
    var_dump(Image::getInstance()->updateInvoiceLogo($image_path));
    // returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```
### Update Store Icon
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $image_path = '/path/to/your/store-icon.png';
    var_dump(Image::getInstance()->updateStoreIcon($image_path));
    // returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

## Product Images
### List products with has image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    var_dump(Image::getInstance()->listProductsHasImage());
    // returns array with product ids
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Get products image ids
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_product = 1;
    var_dump(Image::getInstance()->getProductImageIds($id_product));
    // returns array with product image ids
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Get product image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_product = 1;
    $id_image = 14;
    $image_type = 'default';
    /**
     * @var $image_type available vars;
     * default = original size
     * for get other image types ImageType::getInstance()->filterAddDisplay('name')->filterAddDisplay('width')->filterAddDisplay('height')->filterAddEqual('products', 1)->list(); 
     */
    var_dump(Image::getInstance()->getProductImage($id_product, $id_image, $image_type));
    // returns array ['image_data' => 'raw image data', image_mime => 'image/jpeg', 'image_sha1' => 'image sha1 fingerprint']
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Add product image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_product = 1;
    $image_path = '/path/to/your/product/image.jpg';
    var_dump(Image::getInstance()->addProductImage($image_path, $id_product));
    // returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Update product image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_product = 1;
    $image_path = '/path/to/your/product/image.jpg';
    $id_image = 14;
    var_dump(Image::getInstance()->updateProductImage($image_path, $id_product, $id_image));
    // returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

## Category Images

### List categories with has image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    var_dump(Image::getInstance()->listCategoriesHasImage());
    // returns array with category ids
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Get category image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_category = 3;
    $image_type = 'default';
    /**
     * @var $image_type available vars;
     * default = original size
     * for get other image types ImageType::getInstance()->filterAddDisplay('name')->filterAddDisplay('width')->filterAddDisplay('height')->filterAddEqual('categories', 1)->list(); 
     */
    var_dump(Image::getInstance()->getCategoryImage($id_product, $image_type));
    // returns array ['image_data' => 'raw image data', image_mime => 'image/jpeg', 'image_sha1' => 'image sha1 fingerprint']
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Add category image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_category = 3;
    $image_path = '/path/to/your/product/image.jpg';
    var_dump(Image::getInstance()->addCategoryImage($image_path, $id_category));
    // returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Update category image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_category = 3;
    $image_path = '/path/to/your/product/image.jpg';
    var_dump(Image::getInstance()->updateCategoryImage($image_path, $id_category));
    // returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

## Manufacturer Images

### List manufacturers with has image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    var_dump(Image::getInstance()->listManufacturersHasImage());
    // returns array with manufacturer ids
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Get manufacturer image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_manufacturer = 1;
    $image_type = 'default';
    /**
     * @var $image_type available vars;
     * default = original size
     * for get other image types ImageType::getInstance()->filterAddDisplay('name')->filterAddDisplay('width')->filterAddDisplay('height')->filterAddEqual('manufacturers', 1)->list(); 
     */
    var_dump(Image::getInstance()->getManufacturerImage($id_manufacturer, $image_type));
    // returns array ['image_data' => 'raw image data', image_mime => 'image/jpeg', 'image_sha1' => 'image sha1 fingerprint']
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Add manufacturer image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_manufacturer = 1;
    $image_path = '/path/to/your/product/image.jpg';
    var_dump(Image::getInstance()->addManufacturerImage($image_path, $id_manufacturer));
    // returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Update manufacturer image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_manufacturer = 1;
    $image_path = '/path/to/your/product/image.jpg';
    var_dump(Image::getInstance()->updateManufacturerImage($image_path, $id_manufacturer));
    // returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

## Supplier Images

### List suppliers with has image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    var_dump(Image::getInstance()->listSuppliersHasImage());
    // returns array with suppliers ids
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Get supplier image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_supplier = 1;
    $image_type = 'default';
    /**
     * @var $image_type available vars;
     * default = original size
     * for get other image types ImageType::getInstance()->filterAddDisplay('name')->filterAddDisplay('width')->filterAddDisplay('height')->filterAddEqual('suppliers', 1)->list(); 
     */
    var_dump(Image::getInstance()->getSupplierImage($id_manufacturer, $image_type));
    // returns array ['image_data' => 'raw image data', image_mime => 'image/jpeg', 'image_sha1' => 'image sha1 fingerprint']
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Add supplier image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_supplier = 1;
    $image_path = '/path/to/your/product/image.jpg';
    var_dump(Image::getInstance()->addSupplierImage($image_path, $id_supplier));
    // returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Update supplier image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_supplier = 1;
    $image_path = '/path/to/your/product/image.jpg';
    var_dump(Image::getInstance()->updateSupplierImage($image_path, $id_supplier));
    // returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

## Store Images

### List stores with has image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    var_dump(Image::getInstance()->listStoresHasImage());
    // returns array with store ids
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Get store image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_store = 1;
    $image_type = 'default';
    /**
     * @var $image_type available vars;
     * default = original size
     * for get other image types ImageType::getInstance()->filterAddDisplay('name')->filterAddDisplay('width')->filterAddDisplay('height')->filterAddEqual('stores', 1)->list(); 
     */
    var_dump(Image::getInstance()->getStoreImage($id_store, $image_type));
    // returns array ['image_data' => 'raw image data', image_mime => 'image/jpeg', 'image_sha1' => 'image sha1 fingerprint']
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Add store image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_store = 1;
    $image_path = '/path/to/your/product/image.jpg';
    var_dump(Image::getInstance()->addStoreImage($image_path, $id_store));
    // returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Update store image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_store = 1;
    $image_path = '/path/to/your/product/image.jpg';
    var_dump(Image::getInstance()->updateStoreImage($image_path, $id_store));
    // returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```


## Customization Images
### List customizations with has image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    var_dump(Image::getInstance()->listCustomizationsHasImage());
    // returns array with customizations ids
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Get customizations image ids
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_cart = 1;
    var_dump(Image::getInstance()->getCustomizationsImageIds($id_cart));
    // returns array with cart ids and and customizations ids
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

### Get customizations image
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Image;

try {
    $id_cart = 119;
    $id_customization = 6;
    var_dump(Image::getInstance()->getCustomizationsImage($id_cart, $id_customization));
    // returns array ['image_data' => 'raw image data', image_mime => 'image/jpeg', 'image_sha1' => 'image sha1 fingerprint']
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```



&larr; [Search Class Usage](10-search-class-usage.md) | [Tools &amp; Validate Classes](12-tools-and-validate-classe-usages.md) &rarr;
