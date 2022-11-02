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

class WebServiceModel
{
    public static $resource = '';

    public static $xmlNode = '';

    public static $association_nodes = [];

    private $ws;

    /**
     * @var array $listing_filters
     *
     * filter types; equal, equal_or, not_equal, like_left, like_right, like_both, greater_then, lower_then, between
     */
    private $listing_filters = [
        'filters' => [],
        'displays' => [],
        'sorts' => [],
        'limit' => [],
        'languages' => []
    ];

    private $date_fields = [
        'date_add',
        'date_upd',
        'date_from',
        'date_to',
        'time_start',
        'time_end',
        'birthday',
        'reset_password_validity',
        'stats_date_from',
        'stats_date_to',
        'stats_compare_from',
        'stats_compare_to',
        'last_connection_date',
        'invoice_date',
        'delivery_date',
        'download_deadline',
        'available_date',
        'date_expiration',
        'from',
        'to',
        'date_delivery_expected',
        'last_update',
        'last_flush'
    ];

    public $id;

    public function __construct($id = null)
    {
        $this->ws = new WebServiceLibrary(WEBSERVICE_URI, WEBSERVICE_API_KEY, false);

        if (!is_null($id)) {
            try {
                $response = $this->ws->get(['resource' => static::$resource, 'id' => (int) $id]);

                $reflect = new \ReflectionClass($this);
                $_props = [];
                $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);
                foreach ($props as $prop) {
                    if ($prop->getModifiers() == \ReflectionProperty::IS_PUBLIC) {
                        $_props[] = $prop->getName();
                    }
                }

                foreach ($response->{$response->children()->getName()}->children() as $field => $value) {
                    if (in_array($field, $_props)) {
                        if ($field == 'associations') {
                            foreach ($value as $asso_name => $association) {
                                if (array_key_exists($asso_name, $this->associations)) {
                                    foreach ($association->{(string)$association->attributes()->nodeType} as $asso_row) {
                                        $asso_data = [];
                                        foreach ($asso_row as $asso_key => $asso_val) {
                                            $asso_data[$asso_key] = (string)$asso_val;
                                        }
                                        $this->associations[$asso_name][] = $asso_data;
                                    }

                                }
                            }
                        } elseif ($value->children()->getName() == 'language') {
                            $this->{$field}[(int)$value->children()->attributes()->id] = (string)$value->children()->language;
                        } else {
                            if ($field == 'id_shop' && (string)$value == '') {
                                $this->{$field} = null;
                            } elseif($field == 'id_shop_group' && (string)$value == '') {
                                $this->{$field} = null;
                            } else {
                                $this->{$field} = (string)$value;
                            }
                        }
                    }
                }
            } catch (\PrestaShopWebserviceException $e) {
                if ($e->getMessage() === 'This call to PrestaShop Web Services failed and returned an HTTP status of 404. That means: Not Found.') {
                    // 404 skip object fill
                } else {
                    throw new \PrestaShopWebserviceException($e->getMessage(), $e->getCode(), $e);
                }
            }
        }
    }

    public static function getInstance($id = null)
    {
        return new static($id);
    }

    protected function getWs()
    {
        return $this->ws;
    }

    public function resetFilters()
    {
        $this->listing_filters = [
            'filters' => [],
            'displays' => [],
            'sorts' => [],
            'limit' => [],
            'languages' => []
        ];

        return $this;
    }

    public function filterAddDisplay($field)
    {
        if (strtolower($field) === 'full') {
            $this->listing_filters['displays'] = ['full'];
        } else {
            if (!empty($field) && property_exists($this, $field)) {
                if (in_array('full', $this->listing_filters['displays'])) {
                    $this->filterRemoveDisplay('full');
                }
                $this->listing_filters['displays'][] = $field;
            }
        }
        return $this;
    }

    public function filterRemoveDisplay($field)
    {
        if (!empty($field) && in_array($field, $this->listing_filters['displays'])) {
            $offset = array_search($field, $this->listing_filters['displays']);
            if ($offset !== false) {
                unset($this->listing_filters['displays'][$offset]);
            }
        }
        return $this;
    }

    public function filterAddSort($field, $way = 'ASC')
    {
        if (in_array(strtoupper($way), ['ASC', 'DESC'])) {
            if (!empty($field) && property_exists($this, $field)) {
                $this->listing_filters['sorts'][] = ['orderBy' => $field, 'orderWay' => strtoupper($way)];
            }
        }
        return $this;
    }

    public function filterRemoveSort($field)
    {
        if (!empty($field) && property_exists($this, $field) && count($this->listing_filters['sorts'])) {
            foreach ($this->listing_filters['sorts'] as $offset => $sort) {
                if ($sort['orderBy'] == $field) {
                    unset($this->listing_filters['sorts'][$offset]);
                }
            }
        }
        return $this;
    }

    public function filterSetLimit(int $limit = 100, int $offset = 0)
    {
        if ($offset < 0) {
            $offset = 0;
        }

        if ($limit < 0) {
            $limit = 1;
        }

        $this->listing_filters['limit'] = ['offset' => $offset, 'limit' => $limit];
        return $this;
    }

    public function filterUnsetLimit()
    {
        $this->listing_filters['limit'] = [];
        return $this;
    }

    public function filterAddLanguage(int $id_lang)
    {
        $language = new Entities\Language($id_lang);

        if (Validate::isLoadedObject($language)) {
            $this->listing_filters['languages'][] = $id_lang;
        }
        return $this;
    }

    public function filterRemoveLanguage(int $id_lang)
    {
        if (!empty($id_lang) && in_array($id_lang, $this->listing_filters['languages'])) {
            $offset = array_search($id_lang, $this->listing_filters['languages'], true);
            if ($offset !== false) {
                unset($this->listing_filters['languages'][$offset]);
            }
        }
        return $this;
    }

    public function filterUnsetField($field)
    {
        if (array_key_exists($field, $this->listing_filters['filters'])) {
            unset($this->listing_filters['filters'][$field]);
        }

        return $this;
    }

    public function filterAddEqual($field, $value)
    {
        if (!empty($field) && property_exists($this, $field) && !empty($value)) {
            if (array_key_exists($field, $this->listing_filters['filters'])) {
                if ($this->listing_filters['filters'][$field]['type'] == 'equal') {
                    $this->listing_filters['filters'][$field]['value'][] = $value;
                } else {
                    $this->listing_filters['filters'][$field] = [
                        'type' => 'equal',
                        'value' => [$value]
                    ];
                }
            } else {
                $this->listing_filters['filters'][$field] = [
                    'type' => 'equal',
                    'value' => [$value]
                ];
            }
        }

        return $this;
    }

    public function filterRemoveEqual($field, $value)
    {
        if (!empty($field) && property_exists($this, $field) && array_key_exists($field, $this->listing_filters['filters'])) {
            $offset = array_search($value, $this->listing_filters['filters'][$field]['value']);
            if ($offset !== false) {
                unset($this->listing_filters['filters'][$field]['value'][$offset]);
            }

            if (!count($this->listing_filters['filters'][$field]['value'])) {
                unset($this->listing_filters['filters'][$field]);
            }
        }

        return $this;
    }

    public function filterAddNot($field, $value)
    {
        if (!empty($field) && property_exists($this, $field) && !empty($value)) {
            if (array_key_exists($field, $this->listing_filters['filters'])) {
                if ($this->listing_filters['filters'][$field]['type'] == 'not') {
                    $this->listing_filters['filters'][$field]['value'][] = $value;
                } else {
                    $this->listing_filters['filters'][$field] = [
                        'type' => 'not',
                        'value' => [$value]
                    ];
                }
            } else {
                $this->listing_filters['filters'][$field] = [
                    'type' => 'not',
                    'value' => [$value]
                ];
            }
        }

        return $this;
    }

    public function filterRemoveNot($field, $value)
    {
        return $this->filterRemoveEqual($field, $value);
    }

    public function filterAddBegin($field, $value)
    {
        if (!empty($field) && property_exists($this, $field) && !empty($value)) {
            if (array_key_exists($field, $this->listing_filters['filters'])) {
                if ($this->listing_filters['filters'][$field]['type'] == 'begin') {
                    $this->listing_filters['filters'][$field]['value'] = $value;
                } else {
                    $this->listing_filters['filters'][$field] = [
                        'type' => 'begin',
                        'value' => $value
                    ];
                }
            } else {
                $this->listing_filters['filters'][$field] = [
                    'type' => 'begin',
                    'value' => $value
                ];
            }
        }

        return $this;
    }

    public function filterRemoveBegin($field)
    {
        return $this->filterUnsetField($field);
    }

    public function filterAddEnd($field, $value)
    {
        if (!empty($field) && property_exists($this, $field) && !empty($value)) {
            if (array_key_exists($field, $this->listing_filters['filters'])) {
                if ($this->listing_filters['filters'][$field]['type'] == 'end') {
                    $this->listing_filters['filters'][$field]['value'] = $value;
                } else {
                    $this->listing_filters['filters'][$field] = [
                        'type' => 'end',
                        'value' => $value
                    ];
                }
            } else {
                $this->listing_filters['filters'][$field] = [
                    'type' => 'end',
                    'value' => $value
                ];
            }
        }

        return $this;
    }

    public function filterRemoveEnd($field)
    {
        return $this->filterUnsetField($field);
    }

    public function filterAddContain($field, $value)
    {
        if (!empty($field) && property_exists($this, $field) && !empty($value)) {
            if (array_key_exists($field, $this->listing_filters['filters'])) {
                if ($this->listing_filters['filters'][$field]['type'] == 'contain') {
                    $this->listing_filters['filters'][$field]['value'] = $value;
                } else {
                    $this->listing_filters['filters'][$field] = [
                        'type' => 'contain',
                        'value' => $value
                    ];
                }
            } else {
                $this->listing_filters['filters'][$field] = [
                    'type' => 'contain',
                    'value' => $value
                ];
            }
        }

        return $this;
    }

    public function filterRemoveContain($field)
    {
        return $this->filterUnsetField($field);
    }

    public function filterAddGreater($field, $value)
    {
        if (!empty($field) && property_exists($this, $field) && !empty($value)) {
            if (array_key_exists($field, $this->listing_filters['filters'])) {
                if ($this->listing_filters['filters'][$field]['type'] == 'greater') {
                    $this->listing_filters['filters'][$field]['value'] = $value;
                } else {
                    $this->listing_filters['filters'][$field] = [
                        'type' => 'greater',
                        'value' => $value
                    ];
                }
            } else {
                $this->listing_filters['filters'][$field] = [
                    'type' => 'greater',
                    'value' => $value
                ];
            }
        }

        return $this;
    }

    public function filterRemoveGreater($field)
    {
        return $this->filterUnsetField($field);
    }

    public function filterAddLower($field, $value)
    {
        if (!empty($field) && property_exists($this, $field) && !empty($value)) {
            if (array_key_exists($field, $this->listing_filters['filters'])) {
                if ($this->listing_filters['filters'][$field]['type'] == 'lower') {
                    $this->listing_filters['filters'][$field]['value'] = $value;
                } else {
                    $this->listing_filters['filters'][$field] = [
                        'type' => 'lower',
                        'value' => $value
                    ];
                }
            } else {
                $this->listing_filters['filters'][$field] = [
                    'type' => 'lower',
                    'value' => $value
                ];
            }
        }

        return $this;
    }

    public function filterRemoveLower($field)
    {
        return $this->filterUnsetField($field);
    }

    public function filterAddBetween($field, $start, $end)
    {
        if ($start > $end) {
            $value = [$end, $start];
        } else {
            $value = [$start, $end];
        }

        if (!empty($field) && property_exists($this, $field) && !empty($value)) {
            if (array_key_exists($field, $this->listing_filters['filters'])) {
                if ($this->listing_filters['filters'][$field]['type'] == 'between') {
                    $this->listing_filters['filters'][$field]['value'] = $value;
                } else {
                    $this->listing_filters['filters'][$field] = [
                        'type' => 'between',
                        'value' => $value
                    ];
                }
            } else {
                $this->listing_filters['filters'][$field] = [
                    'type' => 'between',
                    'value' => $value
                ];
            }
        }

        return $this;
    }

    public function filterRemoveBetween($field)
    {
        return $this->filterUnsetField($field);
    }

    public function list()
    {
        $data = [
            'resource' => static::$resource,
        ];

        if (count($this->listing_filters['displays'])) {
            if (in_array('full', $this->listing_filters['displays'])) {
                $data['display'] = 'full';
            } else {
                $data['display'] = '[' . implode(',', $this->listing_filters['displays']) . ']';
            }
        }

        if (count($this->listing_filters['sorts'])) {
            $sorts = '';
            foreach ($this->listing_filters['sorts'] as $sort) {
                $sorts .= (!empty($sorts) ? ',' : '') . $sort['orderBy'] . '_' . $sort['orderWay'];
                if (in_array($sort['orderBy'], $this->date_fields)) {
                    $data['date'] = 1;
                }
            }
            $data['sort'] = $sorts;
        }

        if (count($this->listing_filters['limit'])) {
            $data['limit'] = $this->listing_filters['limit']['offset'] . ',' . $this->listing_filters['limit']['limit'];
        }

        $filters = [];
        if (count($this->listing_filters['filters'])) {
            foreach ($this->listing_filters['filters'] as $field => $filter) {

                if (in_array($field, $this->date_fields)) {
                    $data['date'] = 1;
                }

                switch ($filter['type']) {
                    case 'equal':
                        if (count($filter['value']) == 1) {
                            $filters[$field] = $filter['value'][0];
                        } elseif (count($filter['value']) > 1) {
                            $filters[$field] = '[' . implode('|', $filter['value']) . ']';
                        }
                        break;

                    case 'not':
                        $filters[$field] = '![' . implode('|', $filter['value']) . ']';
                        break;

                    case 'begin':
                        $filters[$field] = '[' . $filter['value'] . ']%';
                        break;

                    case 'end':
                        $filters[$field] = '%[' . $filter['value'] . ']';
                        break;

                    case 'contain':
                        $filters[$field] = '%[' . $filter['value'] . ']%';
                        break;

                    case 'greater':
                        $filters[$field] = '>[' . urlencode($filter['value']) . ']';
                        break;

                    case 'lower':
                        $filters[$field] = '<[' . urlencode($filter['value']) . ']';
                        break;

                    case 'between':
                        $filters[$field] = '[' . urlencode($filter['value'][0]) . ',' . urlencode($filter['value'][1]) . ']';
                        break;
                }
            }
        }

        if (count($filters)) {
            foreach ($filters as $field => $filter) {
                $data['filter['.$field.']'] = $filter;
            }
        }

        if ($lang_count = count($this->listing_filters['languages'])) {
            if ($lang_count > 1) {
                $data['language'] = '[' . implode('|', $this->listing_filters['languages']) . ']';
            } elseif ($lang_count == 1) {
                $data['language'] = $this->listing_filters['languages'][0];
            }
        }

        $response = $this->ws->get($data);

        $return = [];
        foreach ($response->children()->children() as $child) {
            $fields = [];

            foreach ($child->attributes() as $key => $value) {

                if ($key == 'id') {
                    $fields[$key] = (int)$value;
                } else {
                    $fields[$key] = (string) $value;
                }
            }

            foreach ($child->children() as $key => $value) {

                if ($key == 'associations') {
                    $associations = [];
                    foreach ($value as $asso_name => $association) {
                        $associations[$asso_name] = [];
                        foreach ($association->{(string)$association->attributes()->nodeType} as $asso_row) {
                            $asso_data = [];
                            foreach ($asso_row as $asso_key => $asso_val) {
                                $asso_data[$asso_key] = (string)$asso_val;
                            }
                            $associations[$asso_name][] = $asso_data;
                        }
                    }
                    $fields[$key] = $associations;
                } elseif ($value->children()->getName() == 'language') {
                    $fields[$key][(int)$value->children()->attributes()->id] = (string)$value->children()->language;
                } else {
                    $fields[$key] = (string) $value;
                }
            }

            $return[] = $fields;
        }

        return $return;
    }

    public function add($id_shop = null, $id_shop_group = null)
    {
        $validate = $this->validateFields(true);

        if ($validate !== true) {
            throw new \PrestaShopWebserviceException($validate);
        }

        if ($this->id) {
            $this->id = '';
        }

        try {
            $data = [
                'resource' => static::$resource,
                'postXml' => $this->__toString()
            ];

            if (!empty($id_shop) && is_int($id_shop) && (int) $id_shop > 0) {
                $data['id_shop'] = (int) $id_shop;
            }

            if (!empty($id_shop_group) && is_int($id_shop_group) && (int) $id_shop_group > 0) {
                $data['id_shop_group'] = (int) $id_shop_group;
            }

            $response = $this->ws->add($data);

            return new static((int) $response->children()->children()->id);
        } catch (\PrestaShopWebserviceException $e) {
            throw new \PrestaShopWebserviceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function update($id_shop = null, $id_shop_group = null)
    {
        $validate = $this->validateFields(true);

        if ($validate !== true) {
            throw new \PrestaShopWebserviceException($validate);
        }

        try {
            $data = [
                'resource' => static::$resource,
                'id' => $this->id,
                'putXml' => $this->__toString()
            ];

            if (!empty($id_shop) && is_int($id_shop) && (int) $id_shop > 0) {
                $data['id_shop'] = (int) $id_shop;
            }

            if (!empty($id_shop_group) && is_int($id_shop_group) && (int) $id_shop_group > 0) {
                $data['id_shop_group'] = (int) $id_shop_group;
            }

            $response = $this->ws->edit($data);

            return new static($this->id);
        } catch (\PrestaShopWebserviceException $e) {
            throw new \PrestaShopWebserviceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function save($id_shop = null, $id_shop_group = null)
    {
        if ($this->id) {
            return $this->update($id_shop, $id_shop_group);
        } else {
            return $this->add($id_shop, $id_shop_group);
        }
    }

    public function delete($id_shop = null, $id_shop_group = null)
    {
        if (!Validate::isLoadedObject($this)) {
            throw new \PrestaShopWebserviceException('id field required for delete method!');
        }

        try {
            $data = [
                'resource' => static::$resource,
                'id' => $this->id
            ];

            if (!empty($id_shop) && is_int($id_shop) && (int) $id_shop > 0) {
                $data['id_shop'] = (int) $id_shop;
            }

            if (!empty($id_shop_group) && is_int($id_shop_group) && (int) $id_shop_group > 0) {
                $data['id_shop_group'] = (int) $id_shop_group;
            }

            return $this->ws->delete($data);
        } catch (\PrestaShopWebserviceException $e) {
            throw new \PrestaShopWebserviceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public static function exists($id, $id_shop = null, $id_shop_group = null)
    {
        try {
            $data = [
                'resource' => static::$resource,
                'id' => $id
            ];

            if (!empty($id_shop) && is_int($id_shop) && (int) $id_shop > 0) {
                $data['id_shop'] = (int) $id_shop;
            }

            if (!empty($id_shop_group) && is_int($id_shop_group) && (int) $id_shop_group > 0) {
                $data['id_shop_group'] = (int) $id_shop_group;
            }

            $response = static::getInstance()->getWs()->head($data);
            return true;
        } catch (\PrestaShopWebserviceException $e) {
            if ($e->getMessage() === 'This call to PrestaShop Web Services failed and returned an HTTP status of 404. That means: Not Found.') {
                return false;
            } else {
                throw new \PrestaShopWebserviceException($e->getMessage(), $e->getCode(), $e);
            }
        }
    }

    public function getSpecificPrice(int $id_country = null, int $id_state = null, int $postcode = null, int $id_currency = null, int $id_customer_group = null, int $quantity = null, int $id_product_attribute = null, int $price_decimal_length = null, bool $use_tax = null, bool $use_reduction = null, bool $only_reduction = null, bool $use_ecotax = null)
    {
        if (static::$resource !== 'products') {
            throw new \PrestaShopWebserviceException('getSpecificPrice method only works with PrestaConnect\Entities\Product::class');
        }

        if (!Validate::isLoadedObject($this)) {
            throw new \PrestaShopWebserviceException('In order to use the getSpecificPrice method, the Product object must be loaded!');
        }

        $data = [
            'resource' => static::$resource,
            'id' => (int) $this->id,
        ];

        $found_param = false;

        if (!is_null($id_country)) {
            $data['price[my_specific_price][country]'] = $id_country;
            $found_param = true;
        }

        if (!is_null($id_state)) {
            $data['price[my_specific_price][state]'] = $id_state;
            $found_param = true;
        }

        if (!is_null($postcode)) {
            $data['price[my_specific_price][postcode]'] = $postcode;
            $found_param = true;
        }

        if (!is_null($id_currency)) {
            $data['price[my_specific_price][currency]'] = $id_currency;
            $found_param = true;
        }

        if (!is_null($id_customer_group)) {
            $data['price[my_specific_price][group]'] = $id_customer_group;
            $found_param = true;
        }

        if (!is_null($id_customer_group)) {
            $data['price[my_specific_price][group]'] = $id_customer_group;
            $found_param = true;
        }

        if (!is_null($quantity)) {
            $data['price[my_specific_price][quantity]'] = $quantity;
            $found_param = true;
        }

        if (!is_null($id_product_attribute)) {
            $data['price[my_specific_price][product_attribute]'] = $id_product_attribute;
            $found_param = true;
        }

        if (!is_null($price_decimal_length)) {
            $data['price[my_specific_price][decimals]'] = $price_decimal_length;
            $found_param = true;
        }

        if (!is_null($use_tax)) {
            $data['price[my_specific_price][use_tax]'] = ($use_tax ? 1 : 0);
            $found_param = true;
        }

        if (!is_null($use_reduction)) {
            $data['price[my_specific_price][use_reduction]'] = ($use_reduction ? 1 : 0);
            $found_param = true;
        }

        if (!is_null($only_reduction)) {
            $data['price[my_specific_price][only_reduction]'] = ($only_reduction ? 1 : 0);
            $found_param = true;
        }

        if (!is_null($use_ecotax)) {
            $data['price[my_specific_price][use_ecotax]'] = ($use_ecotax ? 1 : 0);
            $found_param = true;
        }

        if (!$found_param) {
            $data['price[my_specific_price][]'] = '';
        }

        $response = $this->ws->get($data);

        return (string)$response->children()->children()->my_specific_price;
    }

    public function associationExists($association = null, array $fields = [])
    {
        if (empty($association) || !isset($this->associations[$association])) {
            return false;
        }

        $association_fields = static::$association_nodes[$association]['fields'];

        $fields = array_filter($fields, function ($value, $key) use ($association_fields) {
            if (array_key_exists($key, $association_fields)) {
                return true;
            }
            return false;
        }, ARRAY_FILTER_USE_BOTH);

        foreach ($association_fields as $association_field => $association_field_data) {
            if (isset($association_field_data['required']) && $association_field_data['required'] && !array_key_exists($association_field, $fields)) {
                throw new \Exception('The "' .$association_field. '" is required!');
            }
        }

        foreach ($this->associations[$association] as $offset => $data) {
            if (!array_diff_assoc($fields, $data)) {
                return $offset;
            }
        }

        return false;
    }

    public function associationSet($association = null, array $fields = [], array $where_fields = [])
    {
        if (empty($association) || !isset($this->associations[$association])) {
            return false;
        }

        $association_fields = static::$association_nodes[$association]['fields'];

        $fields = array_filter($fields, function ($value, $key) use ($association_fields) {
            if (array_key_exists($key, $association_fields)) {
                return true;
            }
            return false;
        }, ARRAY_FILTER_USE_BOTH);

        foreach ($association_fields as $association_field => $association_field_data) {
            if (!array_key_exists($association_field, $fields)) {
                throw new \Exception('The "' .$association_field. '" is required on associationSet method!');
            }
        }

        if (count($where_fields)) {
            $offset = $this->associationExists($association, $where_fields);
            if ($offset !== false) {
                $this->associations[$association][$offset] = $fields;
            } else {
                $this->associations[$association][] = $fields;
            }
        } else {
            $this->associations[$association][] = $fields;
        }

        return $this;
    }

    public function associationUnset($association = null, array $where_fields = [])
    {
        if (empty($association) || !isset($this->associations[$association])) {
            return false;
        }

        $association_fields = static::$association_nodes[$association]['fields'];

        $where_fields = array_filter($where_fields, function ($value, $key) use ($association_fields) {
            if (array_key_exists($key, $association_fields)) {
                return true;
            }
            return false;
        }, ARRAY_FILTER_USE_BOTH);

        foreach ($association_fields as $association_field => $association_field_data) {
            if (isset($association_field_data['required']) && $association_field_data['required'] && !array_key_exists($association_field, $where_fields)) {
                throw new \Exception('The "' .$association_field. '" is required!');
            }
        }

        $offset = $this->associationExists($association, $where_fields);
        if ($offset !== false) {
            unset($this->associations[$association][$offset]);
        } else {
            throw new \Exception('The "' .$association_field. '" not found for unset with your criteria!');
        }

        return $this;
    }

    public function __toString()
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><prestashop />', LIBXML_BIGLINES | LIBXML_COMPACT);
        $xml->addAttribute("xlink:ps", "", "http://www.w3.org/1999/xlink");
        unset($xml->attributes('xlink', true)['ps']);

        $node = $xml->addChild(static::$xmlNode);

        $reflect = new \ReflectionClass($this);
        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);
        foreach ($props as $prop) {
            if ($prop->getModifiers() == \ReflectionProperty::IS_PUBLIC) {
                $field = $prop->getName();

                if ($field == 'date_add' || $field == 'date_upd') {
                    continue;
                }

                if ($field == 'associations') {
                    $associations = $node->addChild('associations');
                    foreach ($this->associations as $association => $association_data) {
                        if (array_key_exists($association, static::$association_nodes)) {
                            ${'association_'.$association} = $associations->addChild($association);
                            if (count($association_data)) {
                                foreach ($association_data as $association_key => $association_row) {
                                    ${'association_key_'.$association_key} = ${'association_'.$association}->addChild(static::$association_nodes[$association]['nodeType']);
                                    foreach ($association_row as $association_field => $association_value) {
                                        ${'association_key_'.$association_key}->addChild($association_field, '<![CDATA[' . $association_value . ']]>');
                                    }
                                }
                            }
                        }
                    }
                } elseif (is_array($this->{$field})) {
                    ${$field} = $node->addChild($field);
                    foreach ($this->{$field} as $id_lang => $value) {
                        ${$field . '_' . $id_lang} = ${$field}->addChild('language', '<![CDATA[' . $value . ']]>');
                        ${$field . '_' . $id_lang}->addAttribute('id', $id_lang);
                    }
                } else {
                    ${$field} = $node->addChild($field, '<![CDATA[' . $this->{$field} . ']]>');
                }
            }
        }
        $dom = new \DOMDocument('1.0');
        $dom->preserveWhiteSpace = true;
        $dom->formatOutput = true;
        $dom->loadXML(html_entity_decode($xml->asXML()));
        return $dom->saveXML();
    }

    public function validateFields($error_return = false)
    {
        $synopsis = $this->ws->get(['resource' => static::$resource, 'schema' => 'synopsis']);

        $validations = [];

        foreach ($synopsis->children()->children() as $field => $data) {
            if (property_exists($this, $field) && $field != 'associations') {
                $validations[$field] = [];
                foreach ($data->attributes() as $attribute_name => $attribute_value) {
                    $validations[$field][$attribute_name] = (string)$attribute_value;
                }
            }
        }

        foreach ($validations as $field => $rules) {
            if (array_key_exists('required', $rules) && $rules['required'] == 'true') {
                if (is_array($this->{$field})) {
                    foreach ($this->{$field} as $id_lang => $field_value) {
                        if ($field_value == '') {
                            // Throw required
                            if ($error_return) {
                                return 'The '.get_class($this) . '->' . $field.' field (language '.$id_lang.') is required.';
                            } else {
                                return false;
                            }
                        }

                        if (array_key_exists('format', $rules) && !call_user_func_array('\\PrestaConnect\\Validate::'.$rules['format'], [$field_value])) {
                            // Throw new invalid
                            if ($error_return) {
                                return 'The '.get_class($this) . '->' . $field.' field (language '.$id_lang.') is invalid.';
                            } else {
                                return false;
                            }
                        }

                        if (array_key_exists('maxSize', $rules) && Tools::strlen($field_value) > (int)$rules['maxSize']) {
                            // Throw new maxSize
                            if ($error_return) {
                                return 'The '.get_class($this) . '->' . $field.' field (language '.$id_lang.') is too long (' . (int)$rules['maxSize'] . ' chars max).';
                            } else {
                                return false;
                            }
                        }
                    }
                } else {
                    if ($this->{$field} == '') {
                        if ($error_return) {
                            return 'The '.get_class($this) . '->' . $field.' field is required.';
                        } else {
                            return false;
                        }
                    }

                    if (array_key_exists('format', $rules) && !call_user_func_array('\\PrestaConnect\\Validate::'.$rules['format'], [$this->{$field}])) {
                        // Throw new invalid
                        if ($error_return) {
                            return 'The '.get_class($this) . '->' . $field.' field is invalid.';
                        } else {
                            return false;
                        }
                    }

                    if (array_key_exists('maxSize', $rules) && Tools::strlen($this->{$field}) > (int)$rules['maxSize']) {
                        // Throw new maxSize
                        if ($error_return) {
                            return 'The '.get_class($this) . '->' . $field.' field is too long (' . (int)$rules['maxSize'] . ' chars max).';
                        } else {
                            return false;
                        }
                    }
                }
            } else {
                if (is_array($this->{$field})) {
                    foreach ($this->{$field} as $id_lang => $field_value) {
                        if ($field_value != '' && array_key_exists('format', $rules) && !call_user_func_array('\\PrestaConnect\\Validate::'.$rules['format'], [$field_value])) {
                            // Throw new invalid
                            if ($error_return) {
                                return 'The '.get_class($this) . '->' . $field.' field (language '.$id_lang.') is invalid.';
                            } else {
                                return false;
                            }
                        }

                        if (array_key_exists('maxSize', $rules) && Tools::strlen($field_value) > (int)$rules['maxSize']) {
                            // Throw new maxSize
                            if ($error_return) {
                                return 'The '.get_class($this) . '->' . $field.' field (language '.$id_lang.') is too long (' . (int)$rules['maxSize'] . ' chars max).';
                            } else {
                                return false;
                            }
                        }
                    }
                } else {
                    if ($this->{$field} != '' && array_key_exists('format', $rules) && !call_user_func_array('\\PrestaConnect\\Validate::'.$rules['format'], [$this->{$field}])) {
                        // Throw new invalid
                        if ($error_return) {
                            return 'The '.get_class($this) . '->' . $field.' field is invalid.';
                        } else {
                            return false;
                        }
                    }

                    if (array_key_exists('maxSize', $rules) && Tools::strlen($this->{$field}) > (int)$rules['maxSize']) {
                        // Throw new maxSize
                        if ($error_return) {
                            return 'The '.get_class($this) . '->' . $field.' field is too long (' . (int)$rules['maxSize'] . ' chars max).';
                        } else {
                            return false;
                        }
                    }
                }
            }
        }

        return true;
    }
}
