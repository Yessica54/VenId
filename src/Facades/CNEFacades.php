<?php

namespace Selkis\VenID\Facades;
use Illuminate\Support\Facades\Facade;

class CNEFacades extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'cne';
    }
}
