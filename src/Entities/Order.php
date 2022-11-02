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

class Order extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'orders';

    public static $xmlNode = 'order';

    public static $association_nodes = [
        'order_rows' => [
            'api' => '',
            'nodeType' => 'order_row',
            'fields' => [
                'id' => [
                ],
                'product_id' => [
                    'required' => true,
                ],
                'product_attribute_id' => [
                    'required' => true,
                ],
                'product_quantity' => [
                    'required' => true,
                ],
                'product_name' => [
                    'read_only' => true,
                    'readOnly' => true,
                ],
                'product_reference' => [
                    'read_only' => true,
                    'readOnly' => true,
                ],
                'product_ean13' => [
                    'read_only' => true,
                    'readOnly' => true,
                ],
                'product_isbn' => [
                    'read_only' => true,
                    'readOnly' => true,
                ],
                'product_upc' => [
                    'read_only' => true,
                    'readOnly' => true,
                ],
                'product_price' => [
                    'read_only' => true,
                    'readOnly' => true,
                ],
                'id_customization' => [
                ],
                'unit_price_tax_incl' => [
                    'read_only' => true,
                    'readOnly' => true,
                ],
                'unit_price_tax_excl' => [
                    'read_only' => true,
                    'readOnly' => true,
                ],
            ],
        ],
    ];

    public $id;
    public $id_address_delivery;
    public $id_address_invoice;
    public $id_cart;
    public $id_currency;
    public $id_lang;
    public $id_customer;
    public $id_carrier;
    public $current_state;
    public $module;
    public $invoice_number;
    public $invoice_date;
    public $delivery_number;
    public $delivery_date;
    public $valid;
    public $date_add;
    public $date_upd;
    public $shipping_number;
    public $note;
    public $id_shop_group;
    public $id_shop;
    public $secure_key;
    public $payment;
    public $recyclable;
    public $gift;
    public $gift_message;
    public $mobile_theme;
    public $total_discounts;
    public $total_discounts_tax_incl;
    public $total_discounts_tax_excl;
    public $total_paid;
    public $total_paid_tax_incl;
    public $total_paid_tax_excl;
    public $total_paid_real;
    public $total_products;
    public $total_products_wt;
    public $total_shipping;
    public $total_shipping_tax_incl;
    public $total_shipping_tax_excl;
    public $carrier_tax_rate;
    public $total_wrapping;
    public $total_wrapping_tax_incl;
    public $total_wrapping_tax_excl;
    public $round_mode;
    public $round_type;
    public $conversion_rate;
    public $reference;
    public $associations = [
        'order_rows' => []
    ];
}
