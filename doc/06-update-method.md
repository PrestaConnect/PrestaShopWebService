# The ```update()``` Method
The ```->update()``` method is the same as the ```PUT``` request in the Web Service API. The ```->update()``` method update to data records of the Entity object. Returns Entity object with updated data.
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Configuration;
use \PrestaConnect\Entities\Product;

try {
    $id_lang = (int) Configuration::get('PS_LANG_DEFAULT');
    $p = new Product(1);
    $p->id_manufacturer = 1;
    $p->name[$id_lang] = 'Your product name';
    $p->update();
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

&larr; [Add Method](05-add-method.md) | [Save Method](07-save-method.md) &rarr;
