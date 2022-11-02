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

class Customer extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'customers';

    public static $xmlNode = 'customer';

    public static $association_nodes = [
        'groups' => [
            'api' => 'groups',
            'nodeType' => 'group',
            'fields' => [
                'id' => [
                ],
            ],
        ],
    ];

    public $id;
    public $id_default_group;
    public $id_lang;
    public $newsletter_date_add;
    public $ip_registration_newsletter;
    public $last_passwd_gen;
    public $secure_key;
    public $deleted;
    public $passwd;
    public $lastname;
    public $firstname;
    public $email;
    public $id_gender;
    public $birthday;
    public $newsletter;
    public $optin;
    public $website;
    public $company;
    public $siret;
    public $ape;
    public $outstanding_allow_amount;
    public $show_public_prices;
    public $id_risk;
    public $max_payment_days;
    public $active;
    public $note;
    public $is_guest;
    public $id_shop;
    public $id_shop_group;
    public $date_add;
    public $date_upd;
    public $reset_password_token;
    public $reset_password_validity;
    public $associations = [
        'groups' => []
    ];
}
