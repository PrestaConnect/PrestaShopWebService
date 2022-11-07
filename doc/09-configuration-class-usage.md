# Configuration Class
Configuration class have three additional static methods<br />
### The ```getIdByName``` Static Method
The ```getByName``` static method returns the id of the corresponding record if the specified key exists in the database. Returns ```false``` if no record exists. Also, by specifying the ```$id_shop_group``` and ```$id_shop``` parameters, the record for the specified store is queried.<br />
> ```Configuration::getIdByName($key, $id_shop_group = null, $id_shop = null)``` //returns int | boolean

### The ```get``` Static Method
The ```get``` static method returns the value of the corresponding record if the specified key exists in the database. Returns ```$default``` if no record exists. Also, by specifying the ```$id_shop_group``` and ```$id_shop``` parameters, the record for the specified store is queried.<br />
> ```Configuration::get($key, $id_shop_group = null, $id_shop = null, $default = false)``` //returns string | $default

### The ```updateValue``` Static Method
The ```updateValue``` static method update or create the ```key``` => ```value``` record in the database. Returns ```true``` if the create or update is successful, ```false``` on failure. Also, a record is created or updated for the specified store by specifying the ```$id_shop_group``` and ```$id_shop``` parameters.<br />
> ```Configuration::updateValue($key, $value, $id_shop_group = null, $id_shop = null)``` //returns boolean

## Basic Usage
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Configuration;

// For list all configurations with name and value fields
var_dump(
    Configuration::getInstance()
    ->filterAddDisplay('name')
    ->filterAddDisplay('value')
    ->list()
);
/**
array([
    ['value' => '1', 'name' => 'PS_LANG_DEFAULT'],
    ['value' => '1.7.8.0', 'name' => 'PS_VERSION_DB'],
    ['value' => '1.7.8.0', 'name' => 'PS_INSTALL_VERSION'],
    ['value' => '1', 'name' => 'PS_CARRIER_DEFAULT'],
    ...
])
**/

var_dump(Configuration::getIdByName('PS_INSTALL_VERSION'))
// string('3')

var_dump(Configuration::get('PS_LANG_DEFAULT'));
// string('1')

var_dump(Configuration::updateValue('PS_INVOICE_PREFIX', '#IN'));
// boolean(true)

```

&larr; [Delete Method](08-delete-method.md) | [Search Class Usage](10-search-class-usage.md) &rarr;
