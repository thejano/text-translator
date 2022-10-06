<?php

use TheJano\TextTranslator\GoogleTranslator;

it('Translate from English to Kurdish (ckb)', function () {
    $google = new GoogleTranslator('en');
    $translated = $google->translate('Hello world', 'ckb');
    $this->assertEquals('سڵاو جیهان', $translated);
});

it('Translate from English to Kurdish (ckb) provide target language on initiation', function () {
    $google = new GoogleTranslator('en', 'ckb');
    $translated = $google->translate('Hello world');
    $this->assertEquals('سڵاو جیهان', $translated);
});

it('Calling translate statically', function () {
    $translated = GoogleTranslator::translate('Hello world', 'ckb', 'en');
    $this->assertEquals('سڵاو جیهان', $translated);
});

it('translate from Kurdish (ckb) to English (en)', function () {
    $translated = GoogleTranslator::translate('سڵاو جیهان', 'en', 'ckb');
    $this->assertEquals('hello world', $translated);
});

it('A target language which is not exists', function () {
    $translated = GoogleTranslator::translate('Hello world', 'a target language that not exist', 'en');
    $this->assertEquals('Hello world', $translated);
});

it('Throws exception if target language not provided', function () {
    GoogleTranslator::translate('Hello world');
})->throws('Target Language should be set!');

it('Throws exception if more than 5000 characters', function () {
    $text = file_get_contents(__DIR__ . '/../../assets/sample_text.txt');
    GoogleTranslator::translate($text, 'ckb');
})->throws('Text is too long! Upto 5000 characters can be translated');
