# PrestaShopWebService
[![Total Downloads](https://img.shields.io/packagist/dt/prestaconnect/prestashopwebservice.svg)](https://packagist.org/packages/prestaconnect/prestashopwebservice)
[![Latest Stable Version](https://img.shields.io/packagist/v/prestaconnect/prestashopwebservice.svg)](https://packagist.org/packages/prestaconnect/prestashopwebservice)

>#### Object-Oriented PHP implementation for PrestaShop WebService API
> This library allows you to use PrestaShop Web Service API just like a native PrestaShop Object.

## Installation

Install the latest version with

```bash
$ composer require prestaconnect/prestashopwebservice
```

> ⚠ This repo needs ```minimum-stability```: ```dev``` on your composer.json

## Documentation

- [Introduction](doc/01-introduction.md)
- [Exists Method](doc/02-exists-method.md)
- [List Method](doc/03-list-method.md)
- [Advanced Filters on Listing](doc/04-advanced-filters-on-listing.md)
- [Add Method](doc/05-add-method.md)
- [Update Method](doc/06-update-method.md)
- [Save Method](doc/07-save-method.md)
- [Delete Method](doc/08-delete-method.md)
- [Configuration Class Usage](doc/09-configuration-class-usage.md)
- [Search Class Usage](doc/10-search-class-usage.md)
- [Image Class Usage](doc/11-image-class-usage.md)
- [Tools &amp; Validate Classes](doc/12-tools-and-validate-classe-usages.md)

## About

### Requirements

- PHP `^7.1.3`.
- PHP Extension `ext-curl`.
- PHP Extension `ext-libxml`.
- PHP Extension `ext-simplexml`.
- PHP Extension `ext-json`.
- PHP Extension `ext-dom`.
- PHP Extension `ext-fileinfo`.
- PHP Extension `ext-intl`.

Bugs and feature request are tracked on [GitHub](https://github.com/PrestaConnect/PrestaShopWebService/issues)

### Author

PrestaConnect - <contact@prestaconnect.net> - <https://www.prestaconnect.net><br />
See also the list of [contributors](https://github.com/PrestaConnect/PrestaShopWebService/contributors) who participated in this project.

### License

PrestaShopWebService is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

### Acknowledgements

This library is heavily inspired by PrestaShop's [ORM](https://github.com/PrestaShop/PrestaShop/blob/develop/classes/ObjectModel.php).
