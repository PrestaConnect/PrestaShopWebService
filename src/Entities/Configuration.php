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

class Configuration extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'configurations';

    public static $xmlNode = 'configuration';

    public static $association_nodes = [
    ];

    public $id;
    public $value;
    public $name;
    public $id_shop_group;
    public $id_shop;
    public $date_add;
    public $date_upd;

    public static function getIdByName($key, $id_shop_group = null, $id_shop = null)
    {
        if (!empty($id_shop) && empty($id_shop_group)) {
            throw new \PrestaShopWebserviceException('When the id_shop_group parameter is specified, the id_shop parameter must also be specified!');
        } elseif (empty($id_shop) && !empty($id_shop_group)) {
            throw new \PrestaShopWebserviceException('When the id_shop parameter is specified, the id_shop_group parameter must also be specified!');
        }

        $instance = static::getInstance();
        $instance->filterAddDisplay('full');
        $instance->filterAddEqual('name', $key);

        if (!empty($id_shop_group) && !empty($id_shop)) {
            $instance->filterAddEqual('id_shop_group', $id_shop_group)->filterAddEqual('id_shop', $id_shop);
        }

        $list = $instance->list();
        $instance->resetFilters();

        if (count($list)) {
            foreach ($list as $row) {
                if (!empty($id_shop_group) && !empty($id_shop)) {
                    if ($row['id_shop_group'] == $id_shop_group && $row['id_shop'] == $id_shop) {
                        return (int) $row['id'];
                    }
                } else {
                    if (empty($row['id_shop_group']) && empty($row['id_shop'])) {
                        return (int) $row['id'];
                    }
                }
            }

            return false;
        }

        return false;
    }

    public static function get($key, $id_shop_group = null, $id_shop = null, $default = false)
    {
        $id = static::getIdByName($key, $id_shop_group, $id_shop);

        if ($id) {
            $instance = static::getInstance($id);
            if (!empty($instance->id) && $instance->id == $id) {
                return $instance->value;
            }
            return $default;
        }

        return $default;
    }

    public static function updateValue($key, $value, $id_shop_group = null, $id_shop = null)
    {
        $id = static::getIdByName($key, $id_shop_group, $id_shop);

        $instance = static::getInstance($id);
        $instance->name = $key;
        $instance->value = $value;
        $instance->id_shop_group = $id_shop_group;
        $instance->id_shop = $id_shop;

        $save = $instance->save();

        if ($save->value == $value) {
            return true;
        }

        return false;
    }
}
