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

class Store extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'stores';

    public static $xmlNode = 'store';

    public static $association_nodes = [
    ];

    public $id;
    public $id_country;
    public $id_state;
    public $hours = [];
    public $postcode;
    public $city;
    public $latitude;
    public $longitude;
    public $phone;
    public $fax;
    public $email;
    public $active;
    public $date_add;
    public $date_upd;
    public $name = [];
    public $address1 = [];
    public $address2 = [];
    public $note = [];
}
