# The ```add()``` Method
The ```->add()``` method is the same as the ```POST``` request in the Web Service API. The ```->add()``` method create to new data records of the Entity object. Returns Entity object with created data.
```php
<?php
define('WEBSERVICE_URI', 'https://www.your-prestashop.com'); // Your PrestaShop main url
define('WEBSERVICE_API_KEY', 'XR848EJWTNQYK6GEDZR2XIZFDT8RAGXD'); // Your WebService API Key

require_once dirname(__FILE__).'/vendor/autoloader.php';

use \PrestaConnect\Entities\Configuration;
use \PrestaConnect\Entities\Product;
use \PrestaConnect\Tools;

try {
    $id_lang = Configuration::get('PS_LANG_DEFAULT');

    $p = new Product(65016);
    $p->id_manufacturer = 1;
    $p->id_category_default = 2;
    $p->id_tax_rules_group = 3;
    $p->id_shop_default = (int) Configuration::get('PS_SHOP_DEFAULT');
    $p->reference = 'ASB124CX3';
    $p->width = 13; // Cm
    $p->height = 3; // Cm
    $p->depth = 2; // Cm
    $p->weight = 0.012; // Kg
    $p->ean13 = '4525918051082';
    $p->is_virtual = 0; // Boolean Is virtual product
    $p->condition = 'new'; // new, used, refurbished
    $p->additional_delivery_times = 1; 0 = none, 1 = default, 2 = Custom Delivery Times (Shows delivery_in_stock and delivery_out_stock field values on product page)
    $p->delivery_in_stock = []; // If $p->additional_delivery_times = 2 set this
    $p->delivery_out_stock = []; // If $p->additional_delivery_times = 2 set this
    $p->product_type = 'standard'; // standard, pack, virtual, combinations
    $p->on_sale = 0; // Boolean
    $p->online_only = 0; // Boolean
    $p->ecotax = '0.000000';
    $p->minimal_quantity = 1;
    $p->low_stock_threshold = null; // null or integer
    $p->low_stock_alert = 0; // Boolean, if $p->low_stock_threshold is not null and $p->low_stock_alert == 1; then sends an e-mail notification when the quantity falls below the specified quantity.
    $p->price = '28.200000'; // Tax excluded price, decimals must max 6 length
    $p->wholesale_price = '21.420000'; // Cost price without tax (It is used to calculate exact profitability. No shows any customer area. Not required but recommended)
    $p->unity = null; // Per kilo, per litre (Unit price description)
    $p->unit_price_ratio = '0.000000'; // Kilo price or Litre price / Product price
    $p->additional_shipping_cost = '0.000000';
    $p->customizable = 0; // Boolean
    $p->active = 1; // Boolean
    $p->redirect_type = '404'; // Available values; 404, 301-category, 301-product, 302-product
    $p->id_type_redirected = 0; // if redirect_type == 301-category then id_category, if redirect_type == 301-product or redirect_type_302-product then id_product
    $p->available_for_order = 1; // Boolean
    $p->available_date = '0000-00-00'; // Y-m-d date format. If product out of stock and fill this fields customers seen a available date on product detail page
    $p->show_condition = 0; // Boolean Show new, used or refurbished condition on product details page
    $p->condition = 'new'; // Available values; new, used, refurbished
    $p->show_price = 1; // Boolean
    $p->visibility = 'both'; // Available values; both, catalog, search, none
    $p->pack_stock_type = 3; // 0 => Pack Only, 1 => Product Only, 2 => Both Pack and Product, 3 => Default
    $p->meta_description = [$id_lang => 'Meta description here'];
    $p->meta_keywords = [$id_lang => 'Meta keywords here'];
    $p->meta_title = [$id_lang => 'Meta title here'];
    $p->link_rewrite = [$id_lang => Tools::str2url('Produc URL here')];
    $p->name = [$id_lang => 'Product name here'];
    $p->description = [$id_lang => '<p>Product long description here</p>'];
    $p->description_short = [$id_lang => '<p>Product short description here</p>'];
    $p->available_now = [$id_lang => 'In Stock']; // Custom product in stock label, default empty array
    $p->available_later = [$id_lang => 'Pre-sale']; // Custom product in stock out of stock, default empty array
    
    $p->add();
} catch (\PrestaShopWebserviceException $e) {
    die($e->getMessage()); // Or do something
}
```

&larr; [Advanced Filters on Listing](04-advanced-filters-on-listing.md) | [Update Method](06-update-method.md) &rarr;
