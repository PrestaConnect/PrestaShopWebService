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

class ProductSupplier extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'product_suppliers';

    public static $xmlNode = 'product_supplier';

    public static $association_nodes = [
    ];

    public $id;
    public $id_product;
    public $id_product_attribute;
    public $id_supplier;
    public $id_currency;
    public $product_supplier_reference;
    public $product_supplier_price_te;
}
