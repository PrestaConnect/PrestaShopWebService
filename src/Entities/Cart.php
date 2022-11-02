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

class Cart extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'carts';

    public static $xmlNode = 'cart';

    public static $association_nodes = [
        'cart_rows' => [
            'api' => '',
            'nodeType' => 'cart_row',
            'fields' => [
                'id_product' => [
                    'required' => true,
                ],
                'id_product_attribute' => [
                    'required' => true,
                ],
                'id_address_delivery' => [
                    'required' => true,
                ],
                'id_customization' => [
                ],
                'quantity' => [
                    'required' => true,
                ],
            ],
        ],
    ];

    public $id;
    public $id_address_delivery;
    public $id_address_invoice;
    public $id_currency;
    public $id_customer;
    public $id_guest;
    public $id_lang;
    public $id_shop_group;
    public $id_shop;
    public $id_carrier;
    public $recyclable;
    public $gift;
    public $gift_message;
    public $mobile_theme;
    public $delivery_option;
    public $secure_key;
    public $allow_seperated_package;
    public $date_add;
    public $date_upd;
    public $associations = [
        'cart_rows' => []
    ];
}
