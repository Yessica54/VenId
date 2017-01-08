<?php

namespace Selkis\VenID\Exceptions;

class PersonNotFoundException extends \Exception{
    
    /**
     * Creates a new instance of the exception ID number not found
    */
    public function __construct()
    {
        $this->message = sprintf('ID number not found');
        $this->code = $code;
    }

}