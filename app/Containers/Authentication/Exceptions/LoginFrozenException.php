<?php

namespace App\Containers\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginFailedException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class LoginFrozenException extends Exception
{
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = '此账号已被冻结';
}
