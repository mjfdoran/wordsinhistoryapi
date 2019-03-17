<?php 

namespace exceptions;

class DBException extends BaseException
{
    public $userFacingMessage;

	CONST DB_EXCEPTION_MESSAGE = 'db exception';
    public function __construct($message, $code = 0, $userFacingMessage) {

        $this->setUserFacingMessage($userFacingMessage);
        parent::__construct($message, $code, null);
    }

}