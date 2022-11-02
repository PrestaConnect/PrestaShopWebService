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

use PrestaConnect\Entities\Configuration;
use PrestaConnect\Tools;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;
use PrestaConnect\SwiftMailerValidation;

class Validate
{
    public static function isIp2Long($ip)
    {
        return preg_match('#^-?[0-9]+$#', (string) $ip);
    }

    public static function isAnything()
    {
        return true;
    }

    public static function isEmail($email)
    {
        return !empty($email) && (new EmailValidator())->isValid($email, new MultipleValidationWithAnd([
                new RFCValidation(),
                new SwiftMailerValidation(), // special validation to be compatible with Swift Mailer
            ]));
    }

    public static function isModuleUrl($url, &$errors)
    {
        if (!$url || $url == 'http://') {
            $errors[] = 'Please specify module URL';
        } elseif (substr($url, -4) != '.tar' && substr($url, -4) != '.zip' && substr($url, -4) != '.tgz' && substr($url, -7) != '.tar.gz') {
            $errors[] = 'Unknown archive type.';
        } else {
            if ((strpos($url, 'http')) === false) {
                $url = 'http://' . $url;
            }
            if (!is_array(@get_headers($url))) {
                $errors[] = 'Invalid URL';
            }
        }
        if (!count($errors)) {
            return true;
        }

        return false;
    }

    public static function isMd5($md5)
    {
        return preg_match('/^[a-f0-9A-F]{32}$/', $md5);
    }

    public static function isSha1($sha1)
    {
        return preg_match('/^[a-fA-F0-9]{40}$/', $sha1);
    }

    public static function isFloat($float)
    {
        return (string) ((float) $float) == (string) $float;
    }

    public static function isUnsignedFloat($float)
    {
        return (string) ((float) $float) == (string) $float && $float >= 0;
    }

    public static function isOptFloat($float)
    {
        return empty($float) || Validate::isFloat($float);
    }

    public static function isCarrierName($name)
    {
        return empty($name) || preg_match('/^[^<>;=#{}]*$/u', $name);
    }

    public static function isImageSize($size)
    {
        return preg_match('/^[0-9]{1,4}$/', $size);
    }

    public static function isCustomerName($name)
    {
        $return = (bool) preg_match('/^(?!\s*$)(?:[^0-9!<>,;?=+()\/\\\\@#"°*`{}_^$%:¤\[\]|\.。]|[。\.](?:\s|$))*$/u', $name);

        if (mb_strpos($name, '.') === false && mb_strpos($name, '。') === false) {
            $return &=  true;
        } else {
            $return &= (bool) preg_match('/[\.。](\s{1}[^\ ]|$)/', $name);
        }

        return ($return == true ? 1 : 0);
    }

    public static function isName($name)
    {
        return preg_match('/^[^0-9!<>,;?=+()@#"°{}_$%:¤|]*$/u', $name);
    }

    public static function isHookName($hook)
    {
        return preg_match('/^[a-zA-Z0-9_-]+$/', $hook);
    }

    public static function isMailName($mail_name)
    {
        return is_string($mail_name) && preg_match('/^[^<>;=#{}]*$/u', $mail_name);
    }

    public static function isMailSubject($mail_subject)
    {
        return preg_match('/^[^<>]*$/u', $mail_subject);
    }

    public static function isModuleName($module_name)
    {
        return is_string($module_name) && preg_match('/^[a-zA-Z0-9_-]+$/', $module_name);
    }

    public static function isTplName($tpl_name)
    {
        return preg_match('/^[a-zA-Z0-9_-]+$/', $tpl_name);
    }

    public static function isImageTypeName($type)
    {
        return preg_match('/^[a-zA-Z0-9_ -]+$/', $type);
    }

    public static function isPrice($price)
    {
        return preg_match('/^[0-9]{1,10}(\.[0-9]{1,9})?$/', $price);
    }

    public static function isNegativePrice($price)
    {
        return preg_match('/^[-]?[0-9]{1,10}(\.[0-9]{1,9})?$/', $price);
    }

    public static function isLanguageIsoCode($iso_code)
    {
        return preg_match('/^[a-zA-Z]{2,3}$/', $iso_code);
    }

    public static function isLanguageCode($s)
    {
        return preg_match('/^[a-zA-Z]{2}(-[a-zA-Z]{2})?$/', $s);
    }

    public static function isLocale($s)
    {
        return preg_match('/^[a-z]{2}-[A-Z]{2}$/', $s);
    }

    public static function isStateIsoCode($iso_code)
    {
        return preg_match('/^[a-zA-Z0-9]{1,4}((-)[a-zA-Z0-9]{1,4})?$/', $iso_code);
    }

    public static function isNumericIsoCode($iso_code)
    {
        return preg_match('/^[0-9]{3}$/', $iso_code);
    }

    public static function isDiscountName($voucher)
    {
        return preg_match('/^[^!<>,;?=+()@"°{}_$%:]{3,32}$/u', $voucher);
    }

    public static function isCatalogName($name)
    {
        return preg_match('/^[^<>;=#{}]*$/u', $name);
    }

    public static function isMessage($message)
    {
        return !preg_match('/[<>{}]/i', $message);
    }

    public static function isCountryName($name)
    {
        return preg_match('/^[a-zA-Z -]+$/', $name);
    }

    public static function isLinkRewrite($link)
    {
        if (Configuration::get('PS_ALLOW_ACCENTED_CHARS_URL')) {
            return preg_match('/^[_a-zA-Z0-9\x{0600}-\x{06FF}\pL\pS-]+$/u', $link);
        }

        return preg_match('/^[_a-zA-Z0-9\-]+$/', $link);
    }

    public static function isRoutePattern($pattern)
    {
        if (Configuration::get('PS_ALLOW_ACCENTED_CHARS_URL')) {
            return preg_match('/^[_a-zA-Z0-9\x{0600}-\x{06FF}\(\)\.{}:\/\pL\pS-]+$/u', $pattern);
        }

        return preg_match('/^[_a-zA-Z0-9\(\)\.{}:\/\-]+$/', $pattern);
    }

    public static function isAddress($address)
    {
        return empty($address) || preg_match('/^[^!<>?=+@{}_$%]*$/u', $address);
    }

    public static function isCityName($city)
    {
        return preg_match('/^[^!<>;?=+@#"°{}_$%]*$/u', $city);
    }

    public static function isValidSearch($search)
    {
        return preg_match('/^[^<>;=#{}]{0,64}$/u', $search);
    }

    public static function isGenericName($name)
    {
        return empty($name) || preg_match('/^[^<>={}]*$/u', $name);
    }

    public static function isCleanHtml($html, $allow_iframe = false)
    {
        $events = 'onmousedown|onmousemove|onmmouseup|onmouseover|onmouseout|onload|onunload|onfocus|onblur|onchange';
        $events .= '|onsubmit|ondblclick|onclick|onkeydown|onkeyup|onkeypress|onmouseenter|onmouseleave|onerror|onselect|onreset|onabort|ondragdrop|onresize|onactivate|onafterprint|onmoveend';
        $events .= '|onafterupdate|onbeforeactivate|onbeforecopy|onbeforecut|onbeforedeactivate|onbeforeeditfocus|onbeforepaste|onbeforeprint|onbeforeunload|onbeforeupdate|onmove';
        $events .= '|onbounce|oncellchange|oncontextmenu|oncontrolselect|oncopy|oncut|ondataavailable|ondatasetchanged|ondatasetcomplete|ondeactivate|ondrag|ondragend|ondragenter|onmousewheel';
        $events .= '|ondragleave|ondragover|ondragstart|ondrop|onerrorupdate|onfilterchange|onfinish|onfocusin|onfocusout|onhashchange|onhelp|oninput|onlosecapture|onmessage|onmouseup|onmovestart';
        $events .= '|onoffline|ononline|onpaste|onpropertychange|onreadystatechange|onresizeend|onresizestart|onrowenter|onrowexit|onrowsdelete|onrowsinserted|onscroll|onsearch|onselectionchange';
        $events .= '|onselectstart|onstart|onstop';

        if (preg_match('/<[\s]*script/ims', $html) || preg_match('/(' . $events . ')[\s]*=/ims', $html) || preg_match('/.*script\:/ims', $html)) {
            return false;
        }

        if (!$allow_iframe && preg_match('/<[\s]*(i?frame|form|input|embed|object)/ims', $html)) {
            return false;
        }

        return true;
    }

    public static function isReference($reference)
    {
        return preg_match('/^[^<>;={}]*$/u', $reference);
    }

    public static function isPasswd($passwd, $size = 5)
    {
        return self::isPlaintextPassword($passwd, $size);
    }

    public static function isPlaintextPassword($plaintextPasswd, $size = 5)
    {
        // The password lenght is limited by `password_hash()`
        return Tools::strlen($plaintextPasswd) >= $size && Tools::strlen($plaintextPasswd) <= 72;
    }

    public static function isHashedPassword($hashedPasswd)
    {
        return Tools::strlen($hashedPasswd) == 32 || Tools::strlen($hashedPasswd) == 60;
    }

    public static function isPasswdAdmin($passwd)
    {
        return Validate::isPlaintextPassword($passwd, 8);
    }

    public static function isConfigName($config_name)
    {
        return preg_match('/^[a-zA-Z_0-9-]+$/', $config_name);
    }

    public static function isPhpDateFormat($date_format)
    {
        // We can't really check if this is valid or not, because this is a string and you can write whatever you want in it.
        // That's why only < et > are forbidden (HTML)
        return preg_match('/^[^<>]+$/', $date_format);
    }

    public static function isDateFormat($date)
    {
        return (bool) preg_match('/^([0-9]{4})-((0?[0-9])|(1[0-2]))-((0?[0-9])|([1-2][0-9])|(3[01]))( [0-9]{2}:[0-9]{2}:[0-9]{2})?$/', $date);
    }

    public static function isDate($date)
    {
        if (!preg_match('/^([0-9]{4})-((?:0?[0-9])|(?:1[0-2]))-((?:0?[0-9])|(?:[1-2][0-9])|(?:3[01]))( [0-9]{2}:[0-9]{2}:[0-9]{2})?$/', $date, $matches)) {
            return false;
        }

        return checkdate((int) $matches[2], (int) $matches[3], (int) $matches[1]);
    }

    public static function isDateOrNull($date)
    {
        if (null === $date || $date === '0000-00-00 00:00:00' || $date === '0000-00-00') {
            return true;
        }

        return self::isDate($date);
    }

    public static function isBirthDate($date, $format = 'Y-m-d')
    {
        if (empty($date) || $date == '0000-00-00') {
            return true;
        }

        $d = \DateTime::createFromFormat($format, $date);
        if (!empty(\DateTime::getLastErrors()['warning_count']) || false === $d) {
            return false;
        }
        $twoHundredYearsAgo = new \Datetime();
        $twoHundredYearsAgo->sub(new \DateInterval('P200Y'));

        return $d->setTime(0, 0, 0) <= new \Datetime() && $d->setTime(0, 0, 0) >= $twoHundredYearsAgo;
    }

    public static function isBool($bool)
    {
        return $bool === null || is_bool($bool) || preg_match('/^(0|1)$/', $bool);
    }

    public static function isPhoneNumber($number)
    {
        return preg_match('/^[+0-9. ()\/-]*$/', $number);
    }

    public static function isEan13($ean13)
    {
        return !$ean13 || preg_match('/^[0-9]{0,13}$/', $ean13);
    }

    public static function isIsbn($isbn)
    {
        return !$isbn || preg_match('/^[0-9-]{0,32}$/', $isbn);
    }

    public static function isUpc($upc)
    {
        return !$upc || preg_match('/^[0-9]{0,12}$/', $upc);
    }

    public static function isMpn($mpn)
    {
        return Tools::strlen($mpn) <= 40;
    }

    public static function isPostCode($postcode)
    {
        return empty($postcode) || preg_match('/^[a-zA-Z 0-9-]+$/', $postcode);
    }

    public static function isZipCodeFormat($zip_code)
    {
        if (!empty($zip_code)) {
            return preg_match('/^[NLCnlc 0-9-]+$/', $zip_code);
        }

        return true;
    }

    public static function isOrderWay($way)
    {
        return $way === 'ASC' | $way === 'DESC' | $way === 'asc' | $way === 'desc';
    }

    public static function isOrderBy($order)
    {
        return preg_match('/^(?:(`?)[\w!_-]+\1\.)?(?:(`?)[\w!_-]+\2)$/', $order);
    }

    public static function isTableOrIdentifier($table)
    {
        return preg_match('/^[a-zA-Z0-9_-]+$/', $table);
    }

    public static function isTagsList($list)
    {
        return preg_match('/^[^!<>;?=+#"°{}_$%]*$/u', $list);
    }

    public static function isProductVisibility($s)
    {
        return preg_match('/^both|catalog|search|none$/i', $s);
    }

    public static function isInt($value)
    {
        return (string) (int) $value === (string) $value || $value === false;
    }

    public static function isUnsignedInt($value)
    {
        return (is_numeric($value) || is_string($value)) && (string) (int) $value === (string) $value && $value < 4294967296 && $value >= 0;
    }

    public static function isPercentage($value)
    {
        return Validate::isFloat($value) && $value >= 0 && $value <= 100;
    }

    public static function isUnsignedId($id)
    {
        return Validate::isUnsignedInt($id); /* Because an id could be equal to zero when there is no association */
    }

    public static function isNullOrUnsignedId($id)
    {
        return $id === null || Validate::isUnsignedId($id);
    }

    public static function isLoadedObject($object)
    {
        return is_object($object) && $object->id;
    }

    public static function isColor($color)
    {
        return preg_match('/^(#[0-9a-fA-F]{6}|[a-zA-Z0-9-]*)$/', $color);
    }

    public static function isUrl($url)
    {
        return preg_match('/^[~:#,$%&_=\(\)\.\? \+\-@\/a-zA-Z0-9\pL\pS-]+$/u', $url);
    }

    public static function isTrackingNumber($tracking_number)
    {
        return preg_match('/^[~:#,%&_=\(\)\[\]\.\? \+\-@\/a-zA-Z0-9]+$/', $tracking_number);
    }

    public static function isUrlOrEmpty($url)
    {
        return empty($url) || Validate::isUrl($url);
    }

    public static function isAbsoluteUrl($url)
    {
        if (!empty($url)) {
            return preg_match('/^(https?:)?\/\/[$~:;#,%&_=\(\)\[\]\.\? \+\-@\/a-zA-Z0-9]+$/', $url);
        }

        return true;
    }

    public static function isMySQLEngine($engine)
    {
        return in_array($engine, ['InnoDB', 'MyISAM']);
    }

    public static function isUnixName($data)
    {
        return preg_match('/^[a-z0-9\._-]+$/ui', $data);
    }

    public static function isTablePrefix($data)
    {
        // Even if "-" is theorically allowed, it will be considered a syntax error if you do not add backquotes (`) around the table name
        return preg_match('/^[a-z0-9_]+$/ui', $data);
    }

    public static function isFileName($name)
    {
        return preg_match('/^[a-zA-Z0-9_.-]+$/', $name);
    }

    public static function isDirName($dir)
    {
        return (bool) preg_match('/^[a-zA-Z0-9_.-]*$/', $dir);
    }

    public static function isTabName($name)
    {
        return preg_match('/^[^<>]+$/u', $name);
    }

    public static function isWeightUnit($unit)
    {
        return Validate::isGenericName($unit) & (Tools::strlen($unit) < 5);
    }

    public static function isDistanceUnit($unit)
    {
        return Validate::isGenericName($unit) & (Tools::strlen($unit) < 5);
    }

    public static function isSubDomainName($domain)
    {
        return preg_match('/^[a-zA-Z0-9-_]*$/', $domain);
    }

    public static function isVoucherDescription($text)
    {
        return preg_match('/^([^<>{}]|<br \/>)*$/i', $text);
    }

    public static function isSortDirection($value)
    {
        return $value !== null && ($value === 'ASC' || $value === 'DESC');
    }

    public static function isLabel($label)
    {
        return preg_match('/^[^{}<>]*$/u', $label);
    }

    public static function isPriceDisplayMethod($data)
    {
        return $data == 1 || $data == 0;
    }

    public static function isDniLite($dni)
    {
        return empty($dni) || (bool) preg_match('/^[0-9A-Za-z-.]{1,16}$/U', $dni);
    }

    public static function isCookie($data)
    {
        return is_object($data) && get_class($data) == 'Cookie';
    }

    public static function isString($data)
    {
        return is_string($data);
    }

    public static function isReductionType($data)
    {
        return $data === 'amount' || $data === 'percentage';
    }

    public static function isBoolId($ids)
    {
        return (bool) preg_match('#^[01]_[0-9]+$#', $ids);
    }

    public static function isLocalizationPackSelection($data)
    {
        return in_array((string) $data, ['states', 'taxes', 'currencies', 'languages', 'units', 'groups']);
    }

    public static function isSerializedArray($data)
    {
        return $data === null || (is_string($data) && preg_match('/^a:[0-9]+:{.*;}$/s', $data));
    }

    public static function isJson($string)
    {
        json_decode($string);

        return json_last_error() == JSON_ERROR_NONE;
    }

    public static function isCoordinate($data)
    {
        return $data === null || preg_match('/^\-?[0-9]{1,8}\.[0-9]{1,8}$/s', $data);
    }

    public static function isLangIsoCode($iso_code)
    {
        return (bool) preg_match('/^[a-zA-Z]{2,3}$/s', $iso_code);
    }

    public static function isLanguageFileName($file_name)
    {
        return (bool) preg_match('/^[a-zA-Z]{2,3}\.(?:gzip|tar\.gz)$/s', $file_name);
    }

    public static function isArrayWithIds($ids)
    {
        if (!is_array($ids) || count($ids) < 1) {
            return false;
        }

        foreach ($ids as $id) {
            if ($id == 0 || !Validate::isUnsignedInt($id)) {
                return false;
            }
        }

        return true;
    }

    public static function isStockManagement($stock_management)
    {
        if (!in_array($stock_management, ['WA', 'FIFO', 'LIFO'])) {
            return false;
        }

        return true;
    }

    public static function isSiret($siret)
    {
        if (Tools::strlen($siret) != 14) {
            return false;
        }
        $sum = 0;
        for ($i = 0; $i != 14; ++$i) {
            $tmp = ((($i + 1) % 2) + 1) * (int) ($siret[$i]);
            if ($tmp >= 10) {
                $tmp -= 9;
            }
            $sum += $tmp;
        }

        return $sum % 10 === 0;
    }

    public static function isApe($ape)
    {
        return (bool) preg_match('/^[0-9]{3,4}[a-zA-Z]{1}$/s', $ape);
    }

    public static function isControllerName($name)
    {
        return (bool) (is_string($name) && preg_match('/^[0-9a-zA-Z-_]*$/u', $name));
    }

    public static function isPrestaShopVersion($version)
    {
        return preg_match('/^[0-1]\.[0-9]{1,2}(\.[0-9]{1,2}){0,2}$/', $version) && ip2long($version);
    }

    public static function isOrderInvoiceNumber($id)
    {
        return preg_match('/^(?:' . Configuration::get('PS_INVOICE_PREFIX', Configuration::get('PS_LANG_DEFAULT')) . ')\s*([0-9]+)$/i', $id);
    }

    public static function isThemeName($theme_name)
    {
        return (bool) preg_match('/^[\w-]{3,255}$/u', $theme_name);
    }
}
