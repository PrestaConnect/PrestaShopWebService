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

class Country extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'countries';

    public static $xmlNode = 'country';

    public static $association_nodes = [
    ];

    public $id;
    public $id_zone;
    public $id_currency;
    public $call_prefix;
    public $iso_code;
    public $active;
    public $contains_states;
    public $need_identification_number;
    public $need_zip_code;
    public $zip_code_format;
    public $display_tax_label;
    public $name = [];
}
