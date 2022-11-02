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

namespace PrestaConnect;

use \PrestaShopWebservice;
use \PrestaShopWebserviceException;

class WebServiceLibrary extends PrestaShopWebservice
{
    public function get($options, $return_image = false)
    {
        if (isset($options['url'])) {
            $url = $options['url'];
        } elseif (isset($options['resource'])) {
            $url = $this->url . '/api/' . $options['resource'];
            $url_params = array();
            if (isset($options['id'])) {
                $url .= '/' . $options['id'];
            }

            $params = array('filter', 'display', 'sort', 'limit', 'id_shop', 'id_group_shop', 'schema', 'language', 'date', 'price', 'query');
            foreach ($params as $p) {
                foreach ($options as $k => $o) {
                    if (strpos($k, $p) !== false) {
                        $url_params[$k] = $options[$k];
                    }
                }
            }
            if (count($url_params) > 0) {
                $url .= '?' . http_build_query($url_params);
            }
        } else {
            throw new PrestaShopWebserviceException('Bad parameters given');
        }

        $request = $this->executeRequest($url, array(CURLOPT_CUSTOMREQUEST => 'GET'));

        $this->checkStatusCode($request['status_code']);// check the response validity

        if ($return_image) {
            $headers = [];
            $_headers = explode("\r\n", $request['header']);
            foreach ($_headers as $_header) {
                if (strpos($_header, ':') === false) {
                    continue;
                }
                list($key, $value) = explode(':', $_header, 2);
                $headers[strtolower(trim($key))] = trim($value);
            }

            $return = [
                'image_data' => $request['response']
            ];

            if (array_key_exists('content-type', $headers)) {
                $return['image_mime'] = $headers['content-type'];
            }

            if (array_key_exists('content-sha1', $headers)) {
                $return['image_sha1'] = $headers['content-sha1'];
            }

            return $return;
        }

        return $this->parseXML($request['response']);
    }

    public function getKey()
    {
        $debug_backtrace = debug_backtrace();

        if (count($debug_backtrace) >= 2 && $debug_backtrace[1]['class'] == 'PrestaConnect\Entities\Image' && $debug_backtrace[1]['function'] == 'uploadImage') {
            return $this->key;
        } else {
            return false;
        }
    }

    public function getUrl()
    {
        $debug_backtrace = debug_backtrace();

        if (count($debug_backtrace) >= 2 && $debug_backtrace[1]['class'] == 'PrestaConnect\Entities\Image' && $debug_backtrace[1]['function'] == 'uploadImage') {
            return $this->url;
        } else {
            return false;
        }
    }
}
