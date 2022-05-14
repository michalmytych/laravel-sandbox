<?php

namespace App\Exceptions\Chat;

use Exception;

class ReceiverNotSpecifiedException extends Exception
{
    protected $message = 'Message receiver not specified.';
}
