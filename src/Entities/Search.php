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

class Search extends WebServiceModel
{
    public static function find(string $query, int $id_lang = null)
    {
        if (empty($id_lang) || !empty($id_lang) && !Language::exists($id_lang)) {
            $id_lang = (int) Configuration::get('PS_LANG_DEFAULT');
        }

        $options = [
            'resource' => 'search',
            'language' => $id_lang,
            'query' => $query
        ];

        $response = static::getInstance()->getWs()->get($options);

        $return = [
            'products' => [],
            'categories' => []
        ];

        foreach ($response->products->children() as $product) {
            $return['products'][] = (int)$product->attributes()->id;
        }

        foreach ($response->categories->children() as $category) {
            $return['categories'][] = (int)$category->attributes()->id;
        }

        return $return;
    }
}
