
# Text Translator for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/thejano/text-translator.svg?style=flat-square)](https://packagist.org/packages/thejano/text-translator)
[![Total Downloads](https://img.shields.io/packagist/dt/thejano/text-translator.svg?style=flat-square)](https://packagist.org/packages/thejano/text-translator)


This package allows text translation using Google Translate for free without an API. It extracts the translated text from the Google Translate website. Meanwhile, it only supports Google Translate.

Supported Languages for Google Translate

https://cloud.google.com/translate/docs/languages


## Requirement

The package requires:
- PHP 8.0 or higher


## Installation

You can install the package via composer:

```bash
composer require thejano/text-translator
```

## Usage
You can use the package like below example
```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use TheJano\TextTranslator\GoogleTranslator;

$text = 'Hello World';

$translator = new GoogleTranslator();

$translated =  $translator->translate($text,'ckb'); // ckb stands for Kurdish Sorani language 

echo $translated; // Prints سڵاو جیهان

# Or Call statically
GoogleTranslator::translate($text,'ckb'); 

# Translate from Arabic to English 
GoogleTranslator::translate('مرحبا بالعالم','en','ar'); // will returns Hello World


```
<br>

The class `GoogleTranslator` by default the source language is set to English, also you can override and provide target language on initiation.
```php
new GoogleTranslator(string $sourceLanguage = 'en', string $targetLanguage = '')
```
<br>

The `translate` method can be called statically or non statically, and it accepts three parameters, which are:
```php
public function _translate(string $text, string $targetLanguage = '', string $sourceLanguage = ''): string;
```



## Testing

```bash
composer test
```
## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Dr Pshtiwan](https://github.com/drpshtiwan)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


