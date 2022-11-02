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

class Manufacturer extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'manufacturers';

    public static $xmlNode = 'manufacturer';

    public static $association_nodes = [
        'addresses' => [
            'api' => 'addresses',
            'nodeType' => 'address',
            'fields' => [
                'id' => [
                ],
            ],
        ],
    ];

    public $id;
    public $active;
    public $name;
    public $date_add;
    public $date_upd;
    public $description = [];
    public $short_description = [];
    public $meta_title = [];
    public $meta_description = [];
    public $meta_keywords = [];
    public $associations = [
        'addresses' => []
    ];
}
