<?php

namespace TheJano\TextTranslator\Contracts;

interface TranslateInterface
{
    public function numberOfAllowedCharacters(): int;

    public function setText(string $text);

    public function setSourceLanguage(string $sourceLanguage);

    public function setTargetLanguage(string $targetLanguage);

    public function _translate(string $text, string $targetLanguage = '', string $sourceLanguage = ''): string;

    public function makeRequest(): string;

    public function extractTranslate(string $data): string;
}
