<?php
/**
 * Copyright since 2022 PrestaConnect
 * PrestaConnect is an Registered Trademark & Property of Metin EREN
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/MIT
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestaconnect.net so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaConnect to newer
 * versions in the future.
 *
 * @author    PrestaConnect <contact@prestaconnect.net>
 * @copyright Since 2022 PrestaConnect
 * @license   * https://opensource.org/licenses/MIT MIT License
 */

namespace PrestaConnect\Entities;

use PrestaConnect\WebServiceModel;
use PrestaConnect\Tools;

class Api extends WebServiceModel
{
    /* @ResourceType :default */
    public static $resource = '';

    public static $xmlNode = 'api';

    public static $association_nodes = [
    ];

    public static $entity_resources = [
        'addresses' => \PrestaConnect\Entities\Address::class,
        'attachments' => \PrestaConnect\Entities\Attachment::class,
        'carriers' => \PrestaConnect\Entities\Carrier::class,
        'cart_rules' => \PrestaConnect\Entities\CartRule::class,
        'carts' => \PrestaConnect\Entities\Cart::class,
        'categories' => \PrestaConnect\Entities\Category::class,
        'combinations' => \PrestaConnect\Entities\Combination::class,
        'configurations' => \PrestaConnect\Entities\Configuration::class,
        'contacts' => \PrestaConnect\Entities\Contact::class,
        'content_management_system' => \PrestaConnect\Entities\CMS::class,
        'countries' => \PrestaConnect\Entities\Country::class,
        'currencies' => \PrestaConnect\Entities\Currency::class,
        'customer_messages' => \PrestaConnect\Entities\CustomerMessage::class,
        'customer_threads' => \PrestaConnect\Entities\CustomerThread::class,
        'customers' => \PrestaConnect\Entities\Customer::class,
        'customizations' => \PrestaConnect\Entities\Customization::class,
        'deliveries' => \PrestaConnect\Entities\Delivery::class,
        'employees' => \PrestaConnect\Entities\Employee::class,
        'groups' => \PrestaConnect\Entities\Group::class,
        'guests' => \PrestaConnect\Entities\Guest::class,
        'image_types' => \PrestaConnect\Entities\ImageType::class,
        'images' => \PrestaConnect\Entities\Image::class,
        'languages' => \PrestaConnect\Entities\Language::class,
        'manufacturers' => \PrestaConnect\Entities\Manufacturer::class,
        'messages' => \PrestaConnect\Entities\Message::class,
        'order_carriers' => \PrestaConnect\Entities\OrderCarrier::class,
        'order_cart_rules' => \PrestaConnect\Entities\OrderCartRule::class,
        'order_details' => \PrestaConnect\Entities\OrderDetail::class,
        'order_histories' => \PrestaConnect\Entities\OrderHistory::class,
        'order_invoices' => \PrestaConnect\Entities\OrderInvoice::class,
        'order_payments' => \PrestaConnect\Entities\OrderPayment::class,
        'order_slip' => \PrestaConnect\Entities\OrderSlip::class,
        'order_states' => \PrestaConnect\Entities\OrderState::class,
        'orders' => \PrestaConnect\Entities\Order::class,
        'price_ranges' => \PrestaConnect\Entities\RangePrice::class,
        'product_customization_fields' => \PrestaConnect\Entities\CustomizationField::class,
        'product_feature_values' => \PrestaConnect\Entities\FeatureValue::class,
        'product_features' => \PrestaConnect\Entities\Feature::class,
        'product_option_values' => \PrestaConnect\Entities\Attribute::class,
        'product_options' => \PrestaConnect\Entities\AttributeGroup::class,
        'product_suppliers' => \PrestaConnect\Entities\Supplier::class,
        'products' => \PrestaConnect\Entities\Product::class,
        'search' => \PrestaConnect\Entities\Search::class,
        'shop_groups' => \PrestaConnect\Entities\ShopGroup::class,
        'shop_urls' => \PrestaConnect\Entities\ShopUrl::class,
        'shops' => \PrestaConnect\Entities\Shop::class,
        'specific_price_rules' => \PrestaConnect\Entities\SpecificPriceRule::class,
        'specific_prices' => \PrestaConnect\Entities\SpecificPrice::class,
        'states' => \PrestaConnect\Entities\State::class,
        'stock_availables' => \PrestaConnect\Entities\StockAvailable::class,
        'stock_movement_reasons' => \PrestaConnect\Entities\StockMvtReason::class,
        'stock_movements' => \PrestaConnect\Entities\StockMvt::class,
        'stocks' => \PrestaConnect\Entities\Stock::class,
        'stores' => \PrestaConnect\Entities\Store::class,
        'suppliers' => \PrestaConnect\Entities\Supplier::class,
        'supply_order_details' => \PrestaConnect\Entities\SupplyOrderDetail::class,
        'supply_order_histories' => \PrestaConnect\Entities\SupplyOrderHistory::class,
        'supply_order_receipt_histories' => \PrestaConnect\Entities\SupplyOrderReceiptHistory::class,
        'supply_order_states' => \PrestaConnect\Entities\SupplyOrderState::class,
        'supply_orders' => \PrestaConnect\Entities\SupplyOrder::class,
        'tags' => \PrestaConnect\Entities\Tag::class,
        'tax_rule_groups' => \PrestaConnect\Entities\TaxRulesGroup::class,
        'tax_rules' => \PrestaConnect\Entities\TaxRule::class,
        'taxes' => \PrestaConnect\Entities\Tax::class,
        'translated_configurations' => \PrestaConnect\Entities\TranslatedConfiguration::class,
        'warehouse_product_locations' => \PrestaConnect\Entities\WarehouseProductLocation::class,
        'warehouses' => \PrestaConnect\Entities\Warehouse::class,
        'weight_ranges' => \PrestaConnect\Entities\RangeWeight::class,
        'zones' => \PrestaConnect\Entities\Zone::class,
    ];

    public function __construct()
    {
        parent::__construct(null);
    }

    public static function getPermissions()
    {
        $response = static::getInstance()->getWs()->get(['resource' => static::$resource]);

        $permissions = [];

        foreach ($response->{static::$xmlNode}->children() as $resource => $child) {
            $permission = [];
            foreach ($child->attributes() as $attribute => $value) {
                $permission[Tools::strtoupper($attribute)] = (string)$value == 'true';
            }
            if (array_key_exists($resource, static::$entity_resources)) {
                $permissions[$resource]['entity'] = static::$entity_resources[$resource];
            }
            $permissions[$resource]['permissions'] = $permission;
        }

        return $permissions;
    }
}
