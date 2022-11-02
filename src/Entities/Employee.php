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

class Employee extends WebServiceModel
{
    /* @ResourceType :default*/
    public static $resource = 'employees';

    public static $xmlNode = 'employee';

    public static $association_nodes = [
    ];

    public $id;
    public $id_lang;
    public $last_passwd_gen;
    public $stats_date_from;
    public $stats_date_to;
    public $stats_compare_from;
    public $stats_compare_to;
    public $passwd;
    public $lastname;
    public $firstname;
    public $email;
    public $active;
    public $id_profile;
    public $bo_color;
    public $default_tab;
    public $bo_theme;
    public $bo_css;
    public $bo_width;
    public $bo_menu;
    public $stats_compare_option;
    public $preselect_date_range;
    public $id_last_order;
    public $id_last_customer_message;
    public $id_last_customer;
    public $reset_password_token;
    public $reset_password_validity;
    public $has_enabled_gravatar;
}
