<?php
/**
 * Copyright since 2020 PrestaConnect and Contributors
 * PrestaConnect is an Registered Trademark & Property of Metin EREN
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestasconnect.net so we can send you a copy immediately.
 *
 * @author    PrestaConnect and Contributors <contact@prestaconnect.net>
 * @copyright Since 2020 PrestaConnect and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace PrestaConnect;

class WebService
{
    protected $webservice_uri;
    protected $webservice_api_key;
    protected $pswsl;
    protected $object = false;

    public $resource = '';

    public function __construct($webservice_uri = null, $webservice_api_key = null)
    {
        if ($webservice_uri === null && defined('WEBSERVICE_URI')) {
            $webservice_uri = WEBSERVICE_URI;
        }

        if ($webservice_api_key === null && defined('WEBSERVICE_API_KEY')) {
            $webservice_api_key = WEBSERVICE_API_KEY;
        }

        $this->setWebServiceUri($webservice_uri);
        $this->setWebServiceApiKey($webservice_api_key);
        $this->pswsl = new \PrestaShopWebservice($this->getWebServiceUri(), $this->getWebServiceApiKey(), false);
    }

    public function setWebServiceUri($uri)
    {
        $this->webservice_uri = $uri;
        return $this;
    }

    public function getWebServiceUri()
    {
        return $this->webservice_uri;
    }

    public function setWebServiceApiKey($api_key)
    {
        $this->webservice_api_key = $api_key;
        return $this;
    }

    public function getWebServiceApiKey()
    {
        return $this->webservice_api_key;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function setObject($object = false)
    {
        if ($object instanceof \stdClass || $object === false) {
            $this->object = $object;
        }

        return $this;
    }

    public function getPrestaShopWebServiceLibrary()
    {
        return $this->pswsl;
    }

    public function getList()
    {
        return $this->pswsl->get(['resource' => $this->resource]);
    }

    public function exists($id)
    {
        try {
            $this->pswsl->head(['resource' => $this->resource, 'id' => $id]);
            return true;
        } catch (\PrestaShopWebserviceException $e) {
            return false;
        }
    }

    public function get($id = null)
    {
        $params = ['resource' => $this->resource];
        if ($id !== null) {
            $params['id'] = $id;
        }

        $response = $this->pswsl->get($params);

        return $response;
    }

    public function add()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
