# Sonos Wrapper 

Library to get information of every product sell by sonos

## Installation

```bash
composer require elyes/sonos-wrapper
```

## Local development

```bash
composer install
```

```bash
php vendor/bin/phpstan analyze src --level=max
```

## Usage

When you install the library you will have access to multiple function

## Get all categories

Retrieve all categories from sonos website

```php
 $api = new \Elyes\SonosWrapper\Api()->getCategories();
```
return an array of categories

## Get all products of category

## Get product information