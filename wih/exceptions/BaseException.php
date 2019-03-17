<?php

namespace exceptions;

use Exception;

class BaseException extends Exception
{
    protected $userFacingMessage;

    protected function setUserFacingMessage($userFacingMessage)
    {
        $this->userFacingMessage = $userFacingMessage;
    }

    public function getUserFacingMessage()
    {
        return $this->userFacingMessage;
    }
}