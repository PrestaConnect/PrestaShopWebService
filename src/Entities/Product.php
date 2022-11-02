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

class Product extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'products';

    public static $xmlNode = 'product';

    public static $association_nodes = [
        'categories' => [
            'api' => 'categories',
            'nodeType' => 'category',
            'fields' => [
                'id' => [
                    'required' => true,
                ],
            ],
        ],
        'images' => [
            'api' => 'images',
            'nodeType' => 'image',
            'fields' => [
                'id' => [
                ],
            ],
        ],
        'combinations' => [
            'api' => 'combinations',
            'nodeType' => 'combination',
            'fields' => [
                'id' => [
                    'required' => true,
                ],
            ],
        ],
        'product_option_values' => [
            'api' => 'product_option_values',
            'nodeType' => 'product_option_value',
            'fields' => [
                'id' => [
                    'required' => true,
                ],
            ],
        ],
        'product_features' => [
            'api' => 'product_features',
            'nodeType' => 'product_feature',
            'fields' => [
                'id' => [
                    'required' => true,
                ],
                'id_feature_value' => [
                    'required' => true,
                ],
            ],
        ],
        'tags' => [
            'api' => 'tags',
            'nodeType' => 'tag',
            'fields' => [
                'id' => [
                    'required' => true,
                ],
            ],
        ],
        'stock_availables' => [
            'api' => 'stock_availables',
            'nodeType' => 'stock_available',
            'fields' => [
                'id' => [
                    'required' => true,
                ],
                'id_product_attribute' => [
                    'required' => true,
                ],
            ],
        ],
        'attachments' => [
            'api' => 'attachments',
            'nodeType' => 'attachment',
            'fields' => [
                'id' => [
                    'required' => true,
                ],
            ],
        ],
        'accessories' => [
            'api' => 'products',
            'nodeType' => 'product',
            'fields' => [
                'id' => [
                    'required' => true,
                ],
            ],
        ],
        'product_bundle' => [
            'api' => 'products',
            'nodeType' => 'product',
            'fields' => [
                'id' => [
                    'required' => true,
                ],
                'id_product_attribute' => [
                ],
                'quantity' => [
                ],
            ],
        ],
    ];

    public $id;
    public $id_manufacturer;
    public $id_supplier;
    public $id_category_default;
    public $cache_default_attribute;
    public $id_tax_rules_group;
    public $id_shop_default;
    public $reference;
    public $supplier_reference;
    public $location;
    public $width;
    public $height;
    public $depth;
    public $weight;
    public $quantity_discount;
    public $ean13;
    public $isbn;
    public $upc;
    public $mpn;
    public $cache_is_pack;
    public $cache_has_attachments;
    public $is_virtual;
    public $state;
    public $additional_delivery_times;
    public $delivery_in_stock = [];
    public $delivery_out_stock = [];
    public $product_type;
    public $on_sale;
    public $online_only;
    public $ecotax;
    public $minimal_quantity;
    public $low_stock_threshold;
    public $low_stock_alert;
    public $price;
    public $wholesale_price;
    public $unity;
    public $unit_price_ratio;
    public $additional_shipping_cost;
    public $customizable;
    public $text_fields;
    public $uploadable_files;
    public $active;
    public $redirect_type;
    public $id_type_redirected;
    public $available_for_order;
    public $available_date;
    public $show_condition;
    public $condition;
    public $show_price;
    public $indexed;
    public $visibility;
    public $advanced_stock_management;
    public $date_add;
    public $date_upd;
    public $pack_stock_type;
    public $meta_description = [];
    public $meta_keywords = [];
    public $meta_title = [];
    public $link_rewrite = [];
    public $name = [];
    public $description = [];
    public $description_short = [];
    public $available_now = [];
    public $available_later = [];
    public $associations = [
        'categories' => [],
        'images' => [],
        'combinations' => [],
        'product_option_values' => [],
        'product_features' => [],
        'tags' => [],
        'stock_availables' => [],
        'attachments' => [],
        'accessories' => [],
        'product_bundle' => []
    ];
}
