# Cart Quantity Multiple - Magento 2 Module

[![License: MIT](https://img.shields.io/github/license/advocodo/magento2-cart-quantity-multiple.svg?style=flat-square)](./LICENSE)
[![Latest Stable Version](https://img.shields.io/packagist/v/advocodo/module-cart-quantity-multiple.svg?style=flat-square)](https://packagist.org/packages/advocodo/module-cart-quantity-multiple)
![Coding Standard workflow](https://github.com/advocodo/magento2-cart-quantity-multiple/actions/workflows/coding-standard.yml/badge.svg?branch=main)
![Mess Detector workflow](https://github.com/advocodo/magento2-cart-quantity-multiple/actions/workflows/mess-detector.yml/badge.svg?branch=main)
![PHPStan workflow](https://github.com/advocodo/magento2-cart-quantity-multiple/actions/workflows/phpstan.yml/badge.svg?branch=main)

## Introduction

This module allows to limit checkout only when the contents of the cart are a multiple of X.

## Screenshots

[Frontend view](screenshots/frontend.png) | [Backend view](screenshots/backend.png)

## Setup

Magento 2 Open Source or Commerce edition is required.

###  Composer installation

Run the following composer command:

```
composer require advocodo/module-cart-quantity-multiple
```

### Setup the module

Run the following magento command:

```
bin/magento setup:upgrade
```

## Features

Limit cart multiple of X is useful feature when selling beer or wine, where your shipping is in boxes with fixed number of items (usually 6 for wine).
It's also possible to exclude some categories from this rule.

## Settings

The configuration for this module is available in `Stores > Configuration > Sales > Cart Quantity Multiple`.

## Authors

- **ADVOCODO** - *Lead* - [![Twitter Follow](https://img.shields.io/twitter/follow/ADVOCODO.svg?style=social)](https://twitter.com/ADVOCODO)
- **Mehdi Chaouch** - *Maintainer* - [![GitHub followers](https://img.shields.io/github/followers/mehdichaouch.svg?style=social)](https://github.com/mehdichaouch)

## License

This project is licensed under the MIT License - see the [LICENSE](./LICENSE) details.

## Credits

This module was partially designed with the inspiration from these fine folks:
- [ron273/CheckCartQuantityM2](https://github.com/ron273/CheckCartQuantityM2)
- [Extendix_ValidateCartMultipleQty](https://github.com/extendix/Extendix_ValidateCartMultipleQty)
