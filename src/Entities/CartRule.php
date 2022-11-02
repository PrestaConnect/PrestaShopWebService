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

class CartRule extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'cart_rules';

    public static $xmlNode = 'cart_rule';

    public static $association_nodes = [
    ];

    public $id;
    public $id_customer;
    public $date_from;
    public $date_to;
    public $description;
    public $quantity;
    public $quantity_per_user;
    public $priority;
    public $partial_use;
    public $code;
    public $minimum_amount;
    public $minimum_amount_tax;
    public $minimum_amount_currency;
    public $minimum_amount_shipping;
    public $country_restriction;
    public $carrier_restriction;
    public $group_restriction;
    public $cart_rule_restriction;
    public $product_restriction;
    public $shop_restriction;
    public $free_shipping;
    public $reduction_percent;
    public $reduction_amount;
    public $reduction_tax;
    public $reduction_currency;
    public $reduction_product;
    public $reduction_exclude_special;
    public $gift_product;
    public $gift_product_attribute;
    public $highlight;
    public $active;
    public $date_add;
    public $date_upd;
    public $name = [];
}
