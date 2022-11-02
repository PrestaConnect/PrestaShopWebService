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

class OrderDetail extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'order_details';

    public static $xmlNode = 'order_detail';

    public static $association_nodes = [
        'taxes' => [
            'api' => 'taxes',
            'nodeType' => 'tax',
            'fields' => [
                'id' => [
                ],
            ],
        ],
    ];

    public $id;
    public $id_order;
    public $product_id;
    public $product_attribute_id;
    public $product_quantity_reinjected;
    public $group_reduction;
    public $discount_quantity_applied;
    public $download_hash;
    public $download_deadline;
    public $id_order_invoice;
    public $id_warehouse;
    public $id_shop;
    public $id_customization;
    public $product_name;
    public $product_quantity;
    public $product_quantity_in_stock;
    public $product_quantity_return;
    public $product_quantity_refunded;
    public $product_price;
    public $reduction_percent;
    public $reduction_amount;
    public $reduction_amount_tax_incl;
    public $reduction_amount_tax_excl;
    public $product_quantity_discount;
    public $product_ean13;
    public $product_isbn;
    public $product_upc;
    public $product_mpn;
    public $product_reference;
    public $product_supplier_reference;
    public $product_weight;
    public $tax_computation_method;
    public $id_tax_rules_group;
    public $ecotax;
    public $ecotax_tax_rate;
    public $download_nb;
    public $unit_price_tax_incl;
    public $unit_price_tax_excl;
    public $total_price_tax_incl;
    public $total_price_tax_excl;
    public $total_shipping_price_tax_excl;
    public $total_shipping_price_tax_incl;
    public $purchase_supplier_price;
    public $original_product_price;
    public $original_wholesale_price;
    public $total_refunded_tax_excl;
    public $total_refunded_tax_incl;
    public $associations = [
        'taxes' => []
    ];
}
