<?php

namespace PrestaConnect;

use Egulias\EmailValidator\Exception\InvalidEmail;

class NonASCIIInLocalPartException extends InvalidEmail
{
}
