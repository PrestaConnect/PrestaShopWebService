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

class Stock extends WebServiceModel
{
    /* @ResourceType :deprecated*/
    public static $resource = 'stocks';

    public static $xmlNode = 'stock';

    public static $association_nodes = [
    ];

    public $id;
    public $id_warehouse;
    public $id_product;
    public $id_product_attribute;
    public $reference;
    public $ean13;
    public $isbn;
    public $upc;
    public $mpn;
    public $physical_quantity;
    public $usable_quantity;
    public $price_te;
}
