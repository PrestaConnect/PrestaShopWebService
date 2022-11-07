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

class Tools
{
    /**
     * Random password generator.
     *
     * @param int $length Desired length (optional)
     * @param string $flag Output type (NUMERIC, ALPHANUMERIC, NO_NUMERIC, RANDOM)
     *
     * @return bool|string Password
     */
    public static function passwdGen($length = 8, $flag = 'ALPHANUMERIC')
    {
        $length = (int) $length;

        if ($length <= 0) {
            return false;
        }

        switch ($flag) {
            case 'NUMERIC':
                $str = '0123456789';

                break;
            case 'NO_NUMERIC':
                $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                break;
            case 'RANDOM':
                $num_bytes = ceil($length * 0.75);
                $bytes = Tools::getBytes($num_bytes);

                return substr(rtrim(base64_encode($bytes), '='), 0, $length);
            case 'ALPHANUMERIC':
            default:
                $str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                break;
        }

        $bytes = Tools::getBytes($length);
        $position = 0;
        $result = '';

        for ($i = 0; $i < $length; ++$i) {
            $position = ($position + ord($bytes[$i])) % strlen($str);
            $result .= $str[$position];
        }

        return $result;
    }

    /**
     * Random bytes generator.
     *
     * Limited to OpenSSL since 1.7.0.0
     *
     * @param int $length Desired length of random bytes
     *
     * @return bool|string Random bytes
     */
    public static function getBytes($length)
    {
        $length = (int) $length;

        if ($length <= 0) {
            return false;
        }

        $bytes = openssl_random_pseudo_bytes($length, $cryptoStrong);

        if ($cryptoStrong === true) {
            return $bytes;
        }

        return false;
    }

    /**
     * Replace text within a portion of a string.
     *
     * Replaces a string matching a search, (optionally) string from a certain position
     *
     * @param string $search The string to search in the input string
     * @param string $replace The replacement string
     * @param string $subject The input string
     * @param int $cur Starting position cursor for the search
     *
     * @return string the result string is returned
     */
    public static function strReplaceFirst($search, $replace, $subject, $cur = 0)
    {
        $strPos = strpos($subject, $search, $cur);

        return $strPos !== false ? substr_replace($subject, $replace, (int) $strPos, strlen($search)) : $subject;
    }

    /**
     * Return the friendly url from the provided string.
     *
     * @param string $str
     * @param bool $utf8_decode (deprecated)
     *
     * @return string
     */
    public static function link_rewrite($str)
    {
        return Tools::str2url($str);
    }

    /**
     * Return a friendly url made from the provided string
     * If the mbstring library is available, the output is the same as the js function of the same name.
     *
     * @param string $str
     *
     * @return string|bool
     */
    public static function str2url($str)
    {
        static $array_str = [];
        static $allow_accented_chars = null;
        static $has_mb_strtolower = null;

        if ($has_mb_strtolower === null) {
            $has_mb_strtolower = function_exists('mb_strtolower');
        }

        if (!is_string($str)) {
            return false;
        }

        if (isset($array_str[$str])) {
            return $array_str[$str];
        }

        if ($str == '') {
            return '';
        }

        if ($allow_accented_chars === null) {
            $allow_accented_chars = Configuration::get('PS_ALLOW_ACCENTED_CHARS_URL');
        }

        $return_str = trim($str);

        if ($has_mb_strtolower) {
            $return_str = mb_strtolower($return_str, 'utf-8');
        }
        if (!$allow_accented_chars) {
            $return_str = Tools::replaceAccentedChars($return_str);
        }

        // Remove all non-whitelist chars.
        if ($allow_accented_chars) {
            $return_str = preg_replace('/[^a-zA-Z0-9\s\'\:\/\[\]\-\p{L}]/u', '', $return_str);
        } else {
            $return_str = preg_replace('/[^a-zA-Z0-9\s\'\:\/\[\]\-]/', '', $return_str);
        }

        $return_str = preg_replace('/[\s\'\:\/\[\]\-]+/', ' ', $return_str);
        $return_str = str_replace([' ', '/'], '-', $return_str);

        // If it was not possible to lowercase the string with mb_strtolower, we do it after the transformations.
        // This way we lose fewer special chars.
        if (!$has_mb_strtolower) {
            $return_str = Tools::strtolower($return_str);
        }

        $array_str[$str] = $return_str;

        return $return_str;
    }

    /**
     * Replace all accented chars by their equivalent non accented chars.
     *
     * @param string $str
     *
     * @return string
     */
    public static function replaceAccentedChars($str)
    {
        /* One source among others:
            http://www.tachyonsoft.com/uc0000.htm
            http://www.tachyonsoft.com/uc0001.htm
            http://www.tachyonsoft.com/uc0004.htm
        */
        $patterns = [
            /* Lowercase */
            /* a  */ '/[\x{00E0}\x{00E1}\x{00E2}\x{00E3}\x{00E4}\x{00E5}\x{0101}\x{0103}\x{0105}\x{0430}\x{00C0}-\x{00C3}\x{1EA0}-\x{1EB7}]/u',
            /* b  */ '/[\x{0431}]/u',
            /* c  */ '/[\x{00E7}\x{0107}\x{0109}\x{010D}\x{0446}]/u',
            /* d  */ '/[\x{010F}\x{0111}\x{0434}\x{0110}\x{00F0}]/u',
            /* e  */ '/[\x{00E8}\x{00E9}\x{00EA}\x{00EB}\x{0113}\x{0115}\x{0117}\x{0119}\x{011B}\x{0435}\x{044D}\x{00C8}-\x{00CA}\x{1EB8}-\x{1EC7}]/u',
            /* f  */ '/[\x{0444}]/u',
            /* g  */ '/[\x{011F}\x{0121}\x{0123}\x{0433}\x{0491}]/u',
            /* h  */ '/[\x{0125}\x{0127}]/u',
            /* i  */ '/[\x{00EC}\x{00ED}\x{00EE}\x{00EF}\x{0129}\x{012B}\x{012D}\x{012F}\x{0131}\x{0438}\x{0456}\x{00CC}\x{00CD}\x{1EC8}-\x{1ECB}\x{0128}]/u',
            /* j  */ '/[\x{0135}\x{0439}]/u',
            /* k  */ '/[\x{0137}\x{0138}\x{043A}]/u',
            /* l  */ '/[\x{013A}\x{013C}\x{013E}\x{0140}\x{0142}\x{043B}]/u',
            /* m  */ '/[\x{043C}]/u',
            /* n  */ '/[\x{00F1}\x{0144}\x{0146}\x{0148}\x{0149}\x{014B}\x{043D}]/u',
            /* o  */ '/[\x{00F2}\x{00F3}\x{00F4}\x{00F5}\x{00F6}\x{00F8}\x{014D}\x{014F}\x{0151}\x{043E}\x{00D2}-\x{00D5}\x{01A0}\x{01A1}\x{1ECC}-\x{1EE3}]/u',
            /* p  */ '/[\x{043F}]/u',
            /* r  */ '/[\x{0155}\x{0157}\x{0159}\x{0440}]/u',
            /* s  */ '/[\x{015B}\x{015D}\x{015F}\x{0161}\x{0441}]/u',
            /* ss */ '/[\x{00DF}]/u',
            /* t  */ '/[\x{0163}\x{0165}\x{0167}\x{0442}]/u',
            /* u  */ '/[\x{00F9}\x{00FA}\x{00FB}\x{00FC}\x{0169}\x{016B}\x{016D}\x{016F}\x{0171}\x{0173}\x{0443}\x{00D9}-\x{00DA}\x{0168}\x{01AF}\x{01B0}\x{1EE4}-\x{1EF1}]/u',
            /* v  */ '/[\x{0432}]/u',
            /* w  */ '/[\x{0175}]/u',
            /* y  */ '/[\x{00FF}\x{0177}\x{00FD}\x{044B}\x{1EF2}-\x{1EF9}\x{00DD}]/u',
            /* z  */ '/[\x{017A}\x{017C}\x{017E}\x{0437}]/u',
            /* ae */ '/[\x{00E6}]/u',
            /* ch */ '/[\x{0447}]/u',
            /* kh */ '/[\x{0445}]/u',
            /* oe */ '/[\x{0153}]/u',
            /* sh */ '/[\x{0448}]/u',
            /* shh*/ '/[\x{0449}]/u',
            /* ya */ '/[\x{044F}]/u',
            /* ye */ '/[\x{0454}]/u',
            /* yi */ '/[\x{0457}]/u',
            /* yo */ '/[\x{0451}]/u',
            /* yu */ '/[\x{044E}]/u',
            /* zh */ '/[\x{0436}]/u',

            /* Uppercase */
            /* A  */ '/[\x{0100}\x{0102}\x{0104}\x{00C0}\x{00C1}\x{00C2}\x{00C3}\x{00C4}\x{00C5}\x{0410}]/u',
            /* B  */ '/[\x{0411}]/u',
            /* C  */ '/[\x{00C7}\x{0106}\x{0108}\x{010A}\x{010C}\x{0426}]/u',
            /* D  */ '/[\x{010E}\x{0110}\x{0414}\x{00D0}]/u',
            /* E  */ '/[\x{00C8}\x{00C9}\x{00CA}\x{00CB}\x{0112}\x{0114}\x{0116}\x{0118}\x{011A}\x{0415}\x{042D}]/u',
            /* F  */ '/[\x{0424}]/u',
            /* G  */ '/[\x{011C}\x{011E}\x{0120}\x{0122}\x{0413}\x{0490}]/u',
            /* H  */ '/[\x{0124}\x{0126}]/u',
            /* I  */ '/[\x{0128}\x{012A}\x{012C}\x{012E}\x{0130}\x{0418}\x{0406}]/u',
            /* J  */ '/[\x{0134}\x{0419}]/u',
            /* K  */ '/[\x{0136}\x{041A}]/u',
            /* L  */ '/[\x{0139}\x{013B}\x{013D}\x{0139}\x{0141}\x{041B}]/u',
            /* M  */ '/[\x{041C}]/u',
            /* N  */ '/[\x{00D1}\x{0143}\x{0145}\x{0147}\x{014A}\x{041D}]/u',
            /* O  */ '/[\x{00D3}\x{014C}\x{014E}\x{0150}\x{041E}]/u',
            /* P  */ '/[\x{041F}]/u',
            /* R  */ '/[\x{0154}\x{0156}\x{0158}\x{0420}]/u',
            /* S  */ '/[\x{015A}\x{015C}\x{015E}\x{0160}\x{0421}]/u',
            /* T  */ '/[\x{0162}\x{0164}\x{0166}\x{0422}]/u',
            /* U  */ '/[\x{00D9}\x{00DA}\x{00DB}\x{00DC}\x{0168}\x{016A}\x{016C}\x{016E}\x{0170}\x{0172}\x{0423}]/u',
            /* V  */ '/[\x{0412}]/u',
            /* W  */ '/[\x{0174}]/u',
            /* Y  */ '/[\x{0176}\x{042B}]/u',
            /* Z  */ '/[\x{0179}\x{017B}\x{017D}\x{0417}]/u',
            /* AE */ '/[\x{00C6}]/u',
            /* CH */ '/[\x{0427}]/u',
            /* KH */ '/[\x{0425}]/u',
            /* OE */ '/[\x{0152}]/u',
            /* SH */ '/[\x{0428}]/u',
            /* SHH*/ '/[\x{0429}]/u',
            /* YA */ '/[\x{042F}]/u',
            /* YE */ '/[\x{0404}]/u',
            /* YI */ '/[\x{0407}]/u',
            /* YO */ '/[\x{0401}]/u',
            /* YU */ '/[\x{042E}]/u',
            /* ZH */ '/[\x{0416}]/u',
        ];

        // ö to oe
        // å to aa
        // ä to ae

        $replacements = [
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 'ss', 't', 'u', 'v', 'w', 'y', 'z', 'ae', 'ch', 'kh', 'oe', 'sh', 'shh', 'ya', 'ye', 'yi', 'yo', 'yu', 'zh',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'V', 'W', 'Y', 'Z', 'AE', 'CH', 'KH', 'OE', 'SH', 'SHH', 'YA', 'YE', 'YI', 'YO', 'YU', 'ZH',
        ];

        return preg_replace($patterns, $replacements, $str);
    }

    /**
     * Truncate strings.
     *
     * @param string $str
     * @param int $max_length Max length
     * @param string $suffix Suffix optional
     *
     * @return string $str truncated
     */
    /* CAUTION : Use it only on module hookEvents.
    ** For other purposes use the smarty function instead */
    public static function truncate($str, $max_length, $suffix = '...')
    {
        if (Tools::strlen($str) <= $max_length) {
            return $str;
        }
        $str = utf8_decode($str);

        return utf8_encode(substr($str, 0, $max_length - Tools::strlen($suffix)) . $suffix);
    }

    /*Copied from CakePHP String utility file*/
    public static function truncateString($text, $length = 120, $options = [])
    {
        $default = [
            'ellipsis' => '...', 'exact' => true, 'html' => true,
        ];

        $options = array_merge($default, $options);
        extract($options);
        /**
         * @var string
         * @var bool $exact
         * @var bool $html
         */
        if ($html) {
            if (Tools::strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }

            $total_length = Tools::strlen(strip_tags($ellipsis));
            $open_tags = [];
            $truncate = '';
            preg_match_all('/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER);

            foreach ($tags as $tag) {
                if (!preg_match('/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2])) {
                    if (preg_match('/<[\w]+[^>]*>/s', $tag[0])) {
                        array_unshift($open_tags, $tag[2]);
                    } elseif (preg_match('/<\/([\w]+)[^>]*>/s', $tag[0], $close_tag)) {
                        $pos = array_search($close_tag[1], $open_tags);
                        if ($pos !== false) {
                            array_splice($open_tags, $pos, 1);
                        }
                    }
                }
                $truncate .= $tag[1];
                $content_length = Tools::strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3]));

                if ($content_length + $total_length > $length) {
                    $left = $length - $total_length;
                    $entities_length = 0;

                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE)) {
                        foreach ($entities[0] as $entity) {
                            if ($entity[1] + 1 - $entities_length <= $left) {
                                --$left;
                                $entities_length += Tools::strlen($entity[0]);
                            } else {
                                break;
                            }
                        }
                    }

                    $truncate .= Tools::substr($tag[3], 0, $left + $entities_length);

                    break;
                } else {
                    $truncate .= $tag[3];
                    $total_length += $content_length;
                }

                if ($total_length >= $length) {
                    break;
                }
            }
        } else {
            if (Tools::strlen($text) <= $length) {
                return $text;
            }

            $truncate = Tools::substr($text, 0, $length - Tools::strlen($ellipsis));
        }

        if (!$exact) {
            $spacepos = Tools::strrpos($truncate, ' ');
            if ($html) {
                $truncate_check = Tools::substr($truncate, 0, $spacepos);
                $last_open_tag = Tools::strrpos($truncate_check, '<');
                $last_close_tag = Tools::strrpos($truncate_check, '>');

                if ($last_open_tag > $last_close_tag) {
                    preg_match_all('/<[\w]+[^>]*>/s', $truncate, $last_tag_matches);
                    $last_tag = array_pop($last_tag_matches[0]);
                    $spacepos = Tools::strrpos($truncate, $last_tag) + Tools::strlen($last_tag);
                }

                $bits = Tools::substr($truncate, $spacepos);
                preg_match_all('/<\/([a-z]+)>/', $bits, $dropped_tags, PREG_SET_ORDER);

                if (!empty($dropped_tags)) {
                    if (!empty($open_tags)) {
                        foreach ($dropped_tags as $closing_tag) {
                            if (!in_array($closing_tag[1], $open_tags)) {
                                array_unshift($open_tags, $closing_tag[1]);
                            }
                        }
                    } else {
                        foreach ($dropped_tags as $closing_tag) {
                            $open_tags[] = $closing_tag[1];
                        }
                    }
                }
            }

            $truncate = Tools::substr($truncate, 0, $spacepos);
        }

        $truncate .= $ellipsis;

        if ($html) {
            foreach ($open_tags as $tag) {
                $truncate .= '</' . $tag . '>';
            }
        }

        return $truncate;
    }

    public static function strtolower($str)
    {
        if (is_array($str)) {
            return false;
        }
        if (function_exists('mb_strtolower')) {
            return mb_strtolower($str, 'utf-8');
        }

        return strtolower($str);
    }

    public static function strlen($str, $encoding = 'UTF-8')
    {
        if (is_array($str)) {
            return false;
        }
        $str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
        if (function_exists('mb_strlen')) {
            return mb_strlen($str, $encoding);
        }

        return strlen($str);
    }

    public static function strtoupper($str)
    {
        if (is_array($str)) {
            return false;
        }
        if (function_exists('mb_strtoupper')) {
            return mb_strtoupper($str, 'utf-8');
        }

        return strtoupper($str);
    }

    public static function substr($str, $start, $length = false, $encoding = 'utf-8')
    {
        if (is_array($str)) {
            return false;
        }
        if (function_exists('mb_substr')) {
            return mb_substr($str, (int) $start, ($length === false ? Tools::strlen($str) : (int) $length), $encoding);
        }

        return substr($str, $start, ($length === false ? Tools::strlen($str) : (int) $length));
    }

    public static function strpos($str, $find, $offset = 0, $encoding = 'UTF-8')
    {
        if (function_exists('mb_strpos')) {
            return mb_strpos($str, $find, $offset, $encoding);
        }

        return strpos($str, $find, $offset);
    }

    public static function strrpos($str, $find, $offset = 0, $encoding = 'utf-8')
    {
        if (function_exists('mb_strrpos')) {
            return mb_strrpos($str, $find, $offset, $encoding);
        }

        return strrpos($str, $find, $offset);
    }

    public static function ucfirst($str)
    {
        return Tools::strtoupper(Tools::substr($str, 0, 1)) . Tools::substr($str, 1);
    }

    public static function ucwords($str)
    {
        if (function_exists('mb_convert_case')) {
            return mb_convert_case($str, MB_CASE_TITLE);
        }

        return ucwords(Tools::strtolower($str));
    }

    /**
     * Translates a string with underscores into camel case (e.g. first_name -> firstName).
     *
     * @prototype string public static function toCamelCase(string $str[, bool $capitalise_first_char = false])
     *
     * @param string $str Source string to convert in camel case
     * @param bool $capitaliseFirstChar Optionnal parameters to transform the first letter in upper case
     *
     * @return string The string in camel case
     */
    public static function toCamelCase($str, $capitaliseFirstChar = false)
    {
        $str = Tools::strtolower($str);
        $str = str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $str)));
        if (!$capitaliseFirstChar) {
            $str = lcfirst($str);
        }

        return $str;
    }

    /**
     * Transform a CamelCase string to underscore_case string.
     *
     * 'CMSCategories' => 'cms_categories'
     * 'RangePrice' => 'range_price'
     *
     * @param string $string
     *
     * @return string
     */
    public static function toUnderscoreCase($string)
    {
        return Tools::strtolower(trim(preg_replace('/([A-Z][a-z])/', '_$1', $string), '_'));
    }

    /**
     * Converts SomethingLikeThis to something-like-this
     *
     * @param string $string
     *
     * @return string
     */
    public static function camelCaseToKebabCase($string)
    {
        return Tools::strtolower(
            preg_replace('/([a-z])([A-Z])/', '$1-$2', $string)
        );
    }

    public static function str_replace_once($needle, $replace, $haystack)
    {
        $pos = false;
        if ($needle) {
            $pos = strpos($haystack, $needle);
        }
        if ($pos === false) {
            return $haystack;
        }

        return substr_replace($haystack, $replace, $pos, strlen($needle));
    }
}
