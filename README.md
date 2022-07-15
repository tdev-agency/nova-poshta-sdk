# Laravel package for integration with Nova Poshta API
> It provides json format only

It is adaptation of the [Nova Poshta API](https://developers.novaposhta.ua/documentation) for Laravel

## Installation 

```bash
composer require tdev-agency/nova-poshta-sdk
```

## Examples

### Getting wirehouses by CityRef

```php
\TDevAgency\NovaPoshtaSdk\Facades\NovaPoshta::addressGeneralModel()->getWarehouses(
                        ['CityRef' => 'city_ref'],
                        AddressGeneral::CATEGORY_BRANCH
                    );
```

### Search city by name

```php
$collection = \TDevAgency\NovaPoshtaSdk\Facades\NovaPoshta::addressModel()->getCities(['FindByString' => $request->get('q')]);
```


## Adding new features

If you need some features please write me to [contact@tdev.agency](mailto:contact@tdev.agency) or create an issue


## Contribution guidelines

Support follows PSR-12 PHP coding standards, and semantic versioning.

Please report any issue you find in the issues page. 
Pull requests are welcome.