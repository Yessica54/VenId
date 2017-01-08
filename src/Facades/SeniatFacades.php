<?php

namespace Selkis\VenID\Facades;
use Illuminate\Support\Facades\Facade;

class SeniatFacades extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'seniat';
    }
}
