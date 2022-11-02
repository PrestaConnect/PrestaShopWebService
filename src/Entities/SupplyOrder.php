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

class SupplyOrder extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'supply_orders';

    public static $xmlNode = 'supply_order';

    public static $association_nodes = [
        'supply_order_details' => [
            'api' => 'supply_order_details',
            'nodeType' => 'supply_order_detail',
            'fields' => [
                'id' => [
                ],
                'id_product' => [
                ],
                'id_product_attribute' => [
                ],
                'supplier_reference' => [
                ],
                'product_name' => [
                ],
            ],
        ],
    ];

    public $id;
    public $id_supplier;
    public $id_lang;
    public $id_warehouse;
    public $id_supply_order_state;
    public $id_currency;
    public $supplier_name;
    public $reference;
    public $date_delivery_expected;
    public $total_te;
    public $total_with_discount_te;
    public $total_ti;
    public $total_tax;
    public $discount_rate;
    public $discount_value_te;
    public $is_template;
    public $date_add;
    public $date_upd;
    public $associations = [
        'supply_order_details' => []
    ];
}
