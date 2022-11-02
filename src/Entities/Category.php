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

class Category extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'categories';

    public static $xmlNode = 'category';

    public static $association_nodes = [
        'categories' => [
            'api' => 'categories',
            'nodeType' => 'category',
            'fields' => [
                'id' => [
                ],
            ],
        ],
        'products' => [
            'api' => 'products',
            'nodeType' => 'product',
            'fields' => [
                'id' => [
                ],
            ],
        ],
    ];

    public $id;
    public $id_parent;
    public $active;
    public $id_shop_default;
    public $is_root_category;
    public $position;
    public $date_add;
    public $date_upd;
    public $name = [];
    public $link_rewrite = [];
    public $description = [];
    public $meta_title = [];
    public $meta_description = [];
    public $meta_keywords = [];
    public $associations = [
        'categories' => [],
        'products' => []
    ];
}
