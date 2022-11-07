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

class Image extends WebServiceModel
{
    /**
     * @param string $resource available values are [general, products, categories, manufacturers, suppliers, stores, customizations]
     * @return false|string[]
     * @throws \PrestaShopWebserviceException
     */
    public function getImageResourceUploadAllowedMimeTypes(string $resource)
    {
        if (!in_array($resource, ['general', 'products', 'categories', 'manufacturers', 'suppliers', 'stores', 'customizations'])) {
            return false;
        }

        $response = $this->getWs()->get(['resource' => 'images']);

        return explode(', ', (string)$response->image_types->{$resource}->attributes()->upload_allowed_mimetypes);

    }

    /**
     * @return array
     * @throws \PrestaShopWebserviceException
     */
    public function listProductsHasImage()
    {
        $response = $this->getWs()->get(['resource' => 'images/products/']);

        $return = [];

        foreach ($response->images->children() as $image) {
            $return[] = (int)$image->attributes()->id;
        }

        return $return;
    }

    /**
     * @param $id_product
     * @return array
     * @throws \PrestaShopWebserviceException
     * @see \PrestaConnect\Entities\Image::listProductsHasImage()
     */
    public function getProductImageIds($id_product)
    {
        $response = $this->getWs()->get(['resource' => 'images/products/' . (int) $id_product]);

        $return = [];

        foreach ($response->children()->children() as $declination => $declination_row) {
            $return[] = [
                'id_image' => (int) $declination_row->attributes()->id,
                'id_product' => (int) $id_product
            ];
        }

        return $return;
    }

    /**
     * @return array
     * @throws \PrestaShopWebserviceException
     */
    public function listCategoriesHasImage()
    {
        $response = $this->getWs()->get(['resource' => 'images/categories/']);

        $return = [];

        foreach ($response->images->children() as $image) {
            $return[] = (int)$image->attributes()->id;
        }

        return $return;
    }

    /**
     * @return array
     * @throws \PrestaShopWebserviceException
     */
    public function listManufacturersHasImage()
    {
        $response = $this->getWs()->get(['resource' => 'images/manufacturers/']);

        $return = [];

        foreach ($response->images->children() as $image) {
            $return[] = (int)$image->attributes()->id;
        }

        return $return;
    }

    /**
     * @return array
     * @throws \PrestaShopWebserviceException
     */
    public function listSuppliersHasImage()
    {
        $response = $this->getWs()->get(['resource' => 'images/suppliers/']);

        $return = [];

        foreach ($response->images->children() as $image) {
            $return[] = (int)$image->attributes()->id;
        }

        return $return;
    }

    /**
     * @return array
     * @throws \PrestaShopWebserviceException
     */
    public function listStoresHasImage()
    {
        $response = $this->getWs()->get(['resource' => 'images/stores/']);

        $return = [];

        foreach ($response->images->children() as $image) {
            $return[] = (int)$image->attributes()->id;
        }

        return $return;
    }

    /**
     * @return array
     * @throws \PrestaShopWebserviceException
     */
    public function listCustomizationsHasImage()
    {
        $response = $this->getWs()->get(['resource' => 'images/customizations/']);

        $return = [];

        foreach ($response->carts->children() as $image) {
            $return[] = (int)$image->attributes()->id;
        }

        return $return;
    }

    /**
     * @param $id_cart
     * @return array
     * @throws \PrestaShopWebserviceException
     * @see \PrestaConnect\Entities\Image::listCustomizationsHasImage() for $id_cart param
     */
    public function getCustomizationsImageIds($id_cart)
    {
        $response = $this->getWs()->get(['resource' => 'images/customizations/' . (int) $id_cart]);

        $return = [];

        foreach ($response->children()->children() as $customization => $customization_row) {
            $return[] = [
                'id_customization' => (int) $customization_row->attributes()->id,
                'id_cart' => (int) $id_cart
            ];
        }

        return $return;
    }

    /**
     * @param $id_product
     * @param $id_image
     * @param $image_type
     * @return array|false|\SimpleXMLElement
     * @throws \PrestaShopWebserviceException
     * @see \PrestaConnect\Entities\Image::listProductsHasImage() for $id_product param
     * @see \PrestaConnect\Entities\Image::getProductImageIds() for $id_image param
     * @see \PrestaConnect\Entities\ImageType for $image_type param
     */
    public function getProductImage($id_product, $id_image, $image_type = 'default')
    {
        $data = $_data = ['resource' => 'images/products/' . $id_product . '/' . $id_image];

        if ($image_type !== 'default') {
            $_image_types = ImageType::getInstance()
                ->filterAddDisplay('id')
                ->filterAddDisplay('name')
                ->filterAddEqual('products', 1)
                ->list();

            $image_types = [];

            foreach ($_image_types as $_image_type) {
                $image_types[] = $_image_type['name'];
            }

            if (!in_array($image_type, $image_types)) {
                throw new \PrestaShopWebserviceException('Image Type "' . $image_type . '" does not exists for Product Image');
            }

            $data['resource'] .= '/' . $image_type;
        }

        try {
            $this->getWs()->head($_data);
        } catch (\PrestaShopWebserviceException $e) {
            return false;
        }

        return $this->getWs()->get($data, true);
    }

    /**
     * @param $id_category
     * @param $image_type
     * @return array|false|\SimpleXMLElement
     * @throws \PrestaShopWebserviceException
     * @see \PrestaConnect\Entities\Image::listCategoriesHasImage() for $id_category param
     * @see \PrestaConnect\Entities\ImageType for $image_type param
     */
    public function getCategoryImage($id_category, $image_type = 'default')
    {
        $data = $_data = ['resource' => 'images/categories/' . $id_category];

        if ($image_type !== 'default') {
            $_image_types = ImageType::getInstance()
                ->filterAddDisplay('id')
                ->filterAddDisplay('name')
                ->filterAddEqual('category', 1)
                ->list();

            $image_types = [];

            foreach ($_image_types as $_image_type) {
                $image_types[] = $_image_type['name'];
            }

            if (!in_array($image_type, $image_types)) {
                throw new \PrestaShopWebserviceException('Image Type "' . $image_type . '" does not exists for Category Image');
            }

            $data['resource'] .= '/' . $image_type;
        }

        try {
            $this->getWs()->head($_data);
        } catch (\PrestaShopWebserviceException $e) {
            return false;
        }

        return $this->getWs()->get($data, true);
    }

    /**
     * @param $id_manufacturer
     * @param $image_type
     * @return array|false|\SimpleXMLElement
     * @throws \PrestaShopWebserviceException
     * @see \PrestaConnect\Entities\Image::listManufacturersHasImage() for $id_manufacturer param
     * @see \PrestaConnect\Entities\ImageType for $image_type param
     */
    public function getManufacturerImage($id_manufacturer, $image_type = 'default')
    {
        $data = $_data = ['resource' => 'images/manufacturers/' . $id_manufacturer];

        if ($image_type !== 'default') {
            $_image_types = ImageType::getInstance()
                ->filterAddDisplay('id')
                ->filterAddDisplay('name')
                ->filterAddEqual('manufacturers', 1)
                ->list();

            $image_types = [];

            foreach ($_image_types as $_image_type) {
                $image_types[] = $_image_type['name'];
            }

            if (!in_array($image_type, $image_types)) {
                throw new \PrestaShopWebserviceException('Image Type "' . $image_type . '" does not exists for Manufacturer Image');
            }

            $data['resource'] .= '/' . $image_type;
        }

        try {
            $this->getWs()->head($_data);
        } catch (\PrestaShopWebserviceException $e) {
            return false;
        }

        return $this->getWs()->get($data, true);
    }

    /**
     * @param $id_supplier
     * @param $image_type
     * @return array|false|\SimpleXMLElement
     * @throws \PrestaShopWebserviceException
     * @see \PrestaConnect\Entities\Image::listSuppliersHasImage() for $id_supplier param
     * @see \PrestaConnect\Entities\ImageType for $image_type param
     */
    public function getSupplierImage($id_supplier, $image_type = 'default')
    {
        $data = $_data = ['resource' => 'images/suppliers/' . $id_supplier];

        if ($image_type !== 'default') {
            $_image_types = ImageType::getInstance()
                ->filterAddDisplay('id')
                ->filterAddDisplay('name')
                ->filterAddEqual('suppliers', 1)
                ->list();

            $image_types = [];

            foreach ($_image_types as $_image_type) {
                $image_types[] = $_image_type['name'];
            }

            if (!in_array($image_type, $image_types)) {
                throw new \PrestaShopWebserviceException('Image Type "' . $image_type . '" does not exists for Supplier Image');
            }

            $data['resource'] .= '/' . $image_type;
        }

        try {
            $this->getWs()->head($_data);
        } catch (\PrestaShopWebserviceException $e) {
            return false;
        }

        return $this->getWs()->get($data, true);
    }

    /**
     * @param $id_store
     * @param $image_type
     * @return array|false|\SimpleXMLElement
     * @throws \PrestaShopWebserviceException
     * @see \PrestaConnect\Entities\Image::listStoresHasImage() for $id_store param
     * @see \PrestaConnect\Entities\ImageType for $image_type param
     */
    public function getStoreImage($id_store, $image_type = 'default')
    {
        $data = $_data = ['resource' => 'images/stores/' . $id_store];

        if ($image_type !== 'default') {
            $_image_types = ImageType::getInstance()
                ->filterAddDisplay('id')
                ->filterAddDisplay('name')
                ->filterAddEqual('stores', 1)
                ->list();

            $image_types = [];

            foreach ($_image_types as $_image_type) {
                $image_types[] = $_image_type['name'];
            }

            if (!in_array($image_type, $image_types)) {
                throw new \PrestaShopWebserviceException('Image Type "' . $image_type . '" does not exists for Store Image');
            }

            $data['resource'] .= '/' . $image_type;
        }

        try {
            $this->getWs()->head($_data);
        } catch (\PrestaShopWebserviceException $e) {
            return false;
        }

        return $this->getWs()->get($data, true);
    }

    /**
     * @param $id_cart
     * @param $id_customization
     * @return array|false|\SimpleXMLElement
     * @throws \PrestaShopWebserviceException
     * @see \PrestaConnect\Entities\Image::listCustomizationsHasImage() for $id_cart param
     * @see \PrestaConnect\Entities\Image::getCustomizationsImageIds() for $id_customization param
     */
    public function getCustomizationsImage($id_cart, $id_customization)
    {
        $data = $_data = ['resource' => 'images/customizations/' . $id_cart . '/' . $id_customization . '/' . 1];

        try {
            $this->getWs()->head($_data);
        } catch (\PrestaShopWebserviceException $e) {
            return false;
        }

        return $this->getWs()->get($data, true);
    }

    /**
     * @param $image_path
     * @return bool
     * @throws \PrestaShopWebserviceException
     */
    public function updateLogo($image_path)
    {
        return $this->uploadImage($image_path, 'general', 'header', null, 'update');
    }

    /**
     * @param $image_path
     * @return bool
     * @throws \PrestaShopWebserviceException
     */
    public function updateMailLogo($image_path)
    {
        return $this->uploadImage($image_path, 'general', 'mail', null, 'update');
    }

    /**
     * @param $image_path
     * @return bool
     * @throws \PrestaShopWebserviceException
     */
    public function updateInvoiceLogo($image_path)
    {
        return $this->uploadImage($image_path, 'general', 'invoice', null, 'update');
    }

    /**
     * @param $image_path
     * @return bool
     * @throws \PrestaShopWebserviceException
     */
    public function updateStoreIcon($image_path)
    {
        return $this->uploadImage($image_path, 'general', 'store_icon', null, 'update');
    }

    /**
     * @param $image_path
     * @param $id_product
     * @return bool
     * @throws \PrestaShopWebserviceException
     */
    public function addProductImage($image_path, $id_product)
    {
        return $this->uploadImage($image_path, 'products', $id_product, null, 'add');
    }

    /**
     * @param $image_path
     * @param $id_product
     * @param $id_image
     * @return bool
     * @throws \PrestaShopWebserviceException
     */
    public function updateProductImage($image_path, $id_product, $id_image)
    {
        return $this->uploadImage($image_path, 'products', $id_product, $id_image, 'update');
    }

    /**
     * @param $image_path
     * @param $id_category
     * @return bool|mixed
     * @throws \PrestaShopWebserviceException
     */
    public function addCategoryImage($image_path, $id_category)
    {
        if (in_array($id_category, $this->listCategoriesHasImage())) {
            return $this->updateCategoryImage($image_path, $id_category);
        }

        return $this->uploadImage($image_path, 'categories', $id_category, null, 'add');
    }

    /**
     * @param $image_path
     * @param $id_category
     * @return bool|mixed
     * @throws \PrestaShopWebserviceException
     */
    public function updateCategoryImage($image_path, $id_category)
    {
        if (!in_array($id_category, $this->listCategoriesHasImage())) {
            return $this->addCategoryImage($image_path, $id_category);
        }

        return $this->uploadImage($image_path, 'categories', $id_category, null, 'update');
    }

    /**
     * @param $image_path
     * @param $id_manufacturer
     * @return bool|mixed
     * @throws \PrestaShopWebserviceException
     */
    public function addManufacturerImage($image_path, $id_manufacturer)
    {
        if (in_array($id_manufacturer, $this->listManufacturersHasImage())) {
            return $this->updateManufacturerImage($image_path, $id_manufacturer);
        }

        return $this->uploadImage($image_path, 'manufacturers', $id_manufacturer, null, 'add');
    }

    /**
     * @param $image_path
     * @param $id_manufacturer
     * @return bool|mixed
     * @throws \PrestaShopWebserviceException
     */
    public function updateManufacturerImage($image_path, $id_manufacturer)
    {
        if (!in_array($id_manufacturer, $this->listManufacturersHasImage())) {
            return $this->addManufacturerImage($image_path, $id_manufacturer);
        }

        return $this->uploadImage($image_path, 'manufacturers', $id_manufacturer, null, 'update');
    }

    /**
     * @param $image_path
     * @param $id_supplier
     * @return bool|mixed
     * @throws \PrestaShopWebserviceException
     */
    public function addSupplierImage($image_path, $id_supplier)
    {
        if (in_array($id_supplier, $this->listSuppliersHasImage())) {
            return $this->updateSupplierImage($image_path, $id_supplier);
        }

        return $this->uploadImage($image_path, 'suppliers', $id_supplier, null, 'add');
    }

    /**
     * @param $image_path
     * @param $id_supplier
     * @return bool|mixed
     * @throws \PrestaShopWebserviceException
     */
    public function updateSupplierImage($image_path, $id_supplier)
    {
        if (!in_array($id_supplier, $this->listSuppliersHasImage())) {
            return $this->addSupplierImage($image_path, $id_supplier);
        }

        return $this->uploadImage($image_path, 'suppliers', $id_supplier, null, 'update');
    }

    /**
     * @param $image_path
     * @param $id_store
     * @return bool|mixed
     * @throws \PrestaShopWebserviceException
     */
    public function addStoreImage($image_path, $id_store)
    {
        if (in_array($id_store, $this->listStoresHasImage())) {
            return $this->updateStoreImage($image_path, $id_store);
        }

        return $this->uploadImage($image_path, 'stores', $id_store, null, 'add');
    }

    /**
     * @param $image_path
     * @param $id_store
     * @return bool|mixed
     * @throws \PrestaShopWebserviceException
     */
    public function updateStoreImage($image_path, $id_store)
    {
        if (!in_array($id_store, $this->listStoresHasImage())) {
            return $this->addStoreImage($image_path, $id_store);
        }

        return $this->uploadImage($image_path, 'stores', $id_store, null, 'update');
    }

    /**
     * @param $image_path
     * @param string $resource available values are [general, products, categories, manufacturers, suppliers, stores, customizations]
     * @param $id_resource
     * @param $id_image | required in update method
     * @param string $method available values are [add, update]
     * @return bool
     * @throws \PrestaShopWebserviceException
     */
    private function uploadImage($image_path, string $resource, $id_resource, $id_image = null, string $method = 'add')
    {
        $image_path = realpath($image_path);

        if (empty($image_path) || !file_exists($image_path)) {
            throw new \PrestaShopWebserviceException('Image "'.$image_path.'" does not exists!');
        }

        $mime = mime_content_type($image_path);

        if (!in_array($mime, $this->getImageResourceUploadAllowedMimeTypes($resource))) {
            throw new \PrestaShopWebserviceException('The "'.$image_path.'" file mime-type must in [' . implode(', ', $this->getImageResourceUploadAllowedMimeTypes($resource)) . ']');
        }

        switch ($method) {
            case 'add':
                $ps_method = 'POST';
                break;

            case 'update':
                $ps_method = 'PUT';
                break;
        }

        $key = $this->getWs()->getKey();
        $url = $this->getWs()->getUrl() . '/api/images/' . $resource . '/' . $id_resource . (!empty($id_image) && $ps_method == 'PUT' ? '/' . $id_image : '') .  '/?ps_method='.$ps_method;

        $args['image'] = new \CurlFile($image_path, $mime);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $key.':');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (200 == $httpCode) {
            return true;
        } else {
            return false;
        }
    }
}
