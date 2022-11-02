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

class OrderSlip extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'order_slip';

    public static $xmlNode = 'order_slip';

    public static $association_nodes = [
        'order_slip_details' => [
            'api' => '',
            'nodeType' => 'order_slip_detail',
            'fields' => [
                'id' => [
                ],
                'id_order_detail' => [
                    'required' => true,
                ],
                'product_quantity' => [
                    'required' => true,
                ],
                'amount_tax_excl' => [
                    'required' => true,
                ],
                'amount_tax_incl' => [
                    'required' => true,
                ],
            ],
        ],
    ];

    public $id;
    public $id_customer;
    public $id_order;
    public $conversion_rate;
    public $total_products_tax_excl;
    public $total_products_tax_incl;
    public $total_shipping_tax_excl;
    public $total_shipping_tax_incl;
    public $amount;
    public $shipping_cost;
    public $shipping_cost_amount;
    public $partial;
    public $date_add;
    public $date_upd;
    public $order_slip_type;
    public $associations = [
        'order_slip_details' => []
    ];
}
