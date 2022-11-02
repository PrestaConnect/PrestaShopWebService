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

class SupplyOrderDetail extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'supply_order_details';

    public static $xmlNode = 'supply_order_detail';

    public static $association_nodes = [
    ];

    public $id;
    public $id_supply_order;
    public $id_product;
    public $id_product_attribute;
    public $reference;
    public $supplier_reference;
    public $name;
    public $ean13;
    public $isbn;
    public $upc;
    public $mpn;
    public $exchange_rate;
    public $unit_price_te;
    public $quantity_expected;
    public $quantity_received;
    public $price_te;
    public $discount_rate;
    public $discount_value_te;
    public $price_with_discount_te;
    public $tax_rate;
    public $tax_value;
    public $price_ti;
    public $tax_value_with_order_discount;
    public $price_with_order_discount_te;
}
