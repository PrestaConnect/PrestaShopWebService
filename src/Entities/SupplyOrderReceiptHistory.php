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

class SupplyOrderReceiptHistory extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'supply_order_receipt_histories';

    public static $xmlNode = 'supply_order_receipt_history';

    public static $association_nodes = [
    ];

    public $id;
    public $id_supply_order_detail;
    public $id_employee;
    public $id_supply_order_state;
    public $employee_firstname;
    public $employee_lastname;
    public $quantity;
    public $date_add;
}
