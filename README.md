# VenId
Consultation of Venezuelan CI

## Installation

Require the `selkis/ven-id` package in your composer.json and update your dependencies.

    $ composer require selkis/ven-id

Add the Providers to your config/app.php providers array:

```php
Selkis\VenID\Providers\VenIdServicesProvider::class,
Ixudra\Curl\CurlServiceProvider::class,
```

Add the Aliases to your config/app.php aliases array:

```php
'Seniat' => Selkis\VenID\Facades\SeniatFacades::class,
'CNE' => Selkis\VenID\Facades\CNEFacades::class,
```

## Usage

To get information from the cne, you must invoke the CNE class to the getInfo method, sending the parameters "nationality" and "identification number".

```php
public function index(){
	return \CNE::getInfo('V','4824519');
};
```

To obtain information from the seniat, you must invoke the Seniat class to the method getInfo, sending you the parameter "rif"

```php
public function index(){
	return \Seniat::getInfo('V214714759');
};
```
## License

Released under the MIT License, see LICENSE.