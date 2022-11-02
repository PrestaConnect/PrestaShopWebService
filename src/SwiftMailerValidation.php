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

declare(strict_types=1);

namespace PrestaConnect;

use Egulias\EmailValidator\EmailLexer;
use Egulias\EmailValidator\Exception\InvalidEmail;
use Egulias\EmailValidator\Validation\EmailValidation;
use PrestaConnect\NonASCIIInLocalPartException;

class SwiftMailerValidation implements EmailValidation
{
    private $error;

    public function isValid($email, EmailLexer $emailLexer)
    {
        if (is_string($email)) {
            $parts = explode('@', $email);
            if (preg_match('/[^\x00-\x7F]/', $parts[0])) {
                $this->error = new NonASCIIInLocalPartException();
            }
        }

        return null === $this->error;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getWarnings()
    {
        return [];
    }
}
