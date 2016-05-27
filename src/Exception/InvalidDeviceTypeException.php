<?php

namespace DSteiner23\Light\Exception;

/**
 * Class InvalidDeviceTypeException
 * @package DSteiner23\Light\Exception
 */
class InvalidDeviceTypeException extends \Exception
{
    public function __construct($message, $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
