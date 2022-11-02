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

class OrderInvoice extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'order_invoices';

    public static $xmlNode = 'order_invoice';

    public static $association_nodes = [
    ];

    public $id;
    public $id_order;
    public $number;
    public $delivery_number;
    public $delivery_date;
    public $total_discount_tax_excl;
    public $total_discount_tax_incl;
    public $total_paid_tax_excl;
    public $total_paid_tax_incl;
    public $total_products;
    public $total_products_wt;
    public $total_shipping_tax_excl;
    public $total_shipping_tax_incl;
    public $shipping_tax_computation_method;
    public $total_wrapping_tax_excl;
    public $total_wrapping_tax_incl;
    public $shop_address;
    public $note;
    public $date_add;
}
