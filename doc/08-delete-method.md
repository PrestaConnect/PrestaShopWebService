# The ```delete()``` Method
The ```->delete()``` method is the same as the ```DELETE``` request in the Web Service API. The ```->delete()``` method delete to data records of the Entity object. Returns ```true``` if the object deleted. Returns ```false``` if the object does not deleted.
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Employee;

try {
    $id_empoyee = 13;
    Employee::getInstance($id_empoyee)->delete();
    // Returns boolean
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

&larr; [Save Method](07-save-method.md) | [Configuration Class Usage](09-configuration-class-usage.md) &rarr;
