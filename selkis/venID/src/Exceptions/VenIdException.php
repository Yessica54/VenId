<?php

namespace Selkis\VenID\Exceptions;

class VenIdException extends \Exception{
    
    /**
     * Creates a new instance of the generic VenID exception
     * @param string $message 
     * @param string $code 
    */
    public function __construct($message, $code)
    {
        $this->message = sprintf($message);
        $this->code = $code;
    }

}