
## ```list()``` Method
The ```->list()``` method is used to list the database records of Entity objects under the ```\PrestaConnect\Entities``` namespace.<br /><br />
If ```filter``` prefixed methods are used on the object before using the ```->list()``` method, it returns the database results filtered according to the specified filtering directives.

```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Configuration;

try {
    var_dump(
        Configuration::getInstance()
            ->filterAddDisplay('key')
            ->filterAddDisplay('value')
            ->filterAddContain('key', 'LANG')
            ->list()
    );
    // array
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

## Advanced Filter Methods
The list of advanced filter methods, Check [Advanced Filters on Listing](04-advanced-filters-on-listing.md) for method descriptions and details.
>```->resetFilters()```<br />
>```->filterAddDisplay($field)```<br />
>```->filterRemoveDisplay($field)```<br />
>```->filterAddSort($field, $way = 'ASC')```<br />
>```->filterRemoveSort($field)```<br />
>```->filterSetLimit(int $limit = 100, int $offset = 0)```<br />
>```->filterUnsetLimit()```<br />
>```->filterAddLanguage(int $id_lang)```<br />
>```->filterRemoveLanguage(int $id_lang)```<br />
>```->filterUnsetField($field)```<br />
>```->filterAddEqual($field, $value)```<br />
>```->filterRemoveEqual($field, $value)```<br />
>```->filterAddNot($field, $value)```<br />
>```->filterRemoveNot($field, $value)```<br />
>```->filterAddBegin($field, $value)```<br />
>```->filterRemoveBegin($field)```<br />
>```->filterAddEnd($field, $value)```<br />
>```->filterRemoveEnd($field)```<br />
>```->filterAddContain($field, $value)```<br />
>```->filterRemoveContain($field)```<br />
>```->filterAddGreater($field, $value)```<br />
>```->filterRemoveGreater($field)```<br />
>```->filterAddLower($field, $value)```<br />
>```->filterRemoveLower($field)```<br />
>```->filterAddBetween($field, $start, $end)```<br />
>```->filterRemoveBetween($field)```

&larr; [Exists Method](02-exists-method.md) | [Advanced Filters on Listing](04-advanced-filters-on-listing.md) &rarr;
