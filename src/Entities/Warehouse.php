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

class Warehouse extends WebServiceModel
{
    /* @ResourceType :deprecated*/
    public static $resource = 'warehouses';

    public static $xmlNode = 'warehouse';

    public static $association_nodes = [
        'stocks' => [
            'api' => 'stocks',
            'nodeType' => 'stock',
            'fields' => [
                'id' => [
                ],
            ],
        ],
        'carriers' => [
            'api' => 'carriers',
            'nodeType' => 'carrier',
            'fields' => [
                'id' => [
                ],
            ],
        ],
        'shops' => [
            'api' => 'shops',
            'nodeType' => 'shop',
            'fields' => [
                'id' => [
                ],
                'name' => [
                ],
            ],
        ],
    ];

    public $id;
    public $id_address;
    public $id_employee;
    public $id_currency;
    public $deleted;
    public $reference;
    public $name;
    public $management_type;
    public $associations = [
        'stocks' => [],
        'carriers' => [],
        'shops' => []
    ];
}
