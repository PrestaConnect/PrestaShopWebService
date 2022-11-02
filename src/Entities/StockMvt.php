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

class StockMvt extends WebServiceModel
{
    /* @ResourceType :deprecated*/
    public static $resource = 'stock_movements';

    public static $xmlNode = 'stock_mvt';

    public static $association_nodes = [
    ];

    public $id;
    public $id_employee;
    public $id_stock;
    public $id_stock_mvt_reason;
    public $id_order;
    public $id_supply_order;
    public $physical_quantity;
    public $sign;
    public $last_wa;
    public $current_wa;
    public $price_te;
    public $date_add;
}
