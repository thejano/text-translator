<?php

namespace TheJano\TextTranslator\Abstracts;

use TheJano\TextTranslator\Traits\FluentApi;

abstract class Translate
{
    use FluentApi;

    protected string $sourceLanguage;

    protected string $targetLanguage;

    protected string $text;

    public function __construct(string $sourceLanguage = 'auto', string $targetLanguage = '')
    {
        $this->sourceLanguage = $sourceLanguage;
        $this->targetLanguage = $targetLanguage;
    }

    public function setText(string $text)
    {
        $this->text = $text;

        return $this;
    }

    public function setSourceLanguage(string $sourceLanguage)
    {
        $this->sourceLanguage = $sourceLanguage;

        return $this;
    }

    public function setTargetLanguage(string $targetLanguage)
    {
        $this->targetLanguage = $targetLanguage;

        return $this;
    }

    public function setProvidedLanguages(string $sourceLanguage, string $targetLanguage): void
    {
        if ($sourceLanguage !== '') {
            $this->setSourceLanguage($sourceLanguage);
        }

        if ($targetLanguage !== '') {
            $this->setTargetLanguage($targetLanguage);
        }
    }

    public function validateLanguages(): void
    {
        if ($this->sourceLanguage === '') {
            throw new \Exception('Source Language should be set!');
        }

        if ($this->targetLanguage === '') {
            throw new \Exception('Target Language should be set!');
        }
    }

    public function checkTextCanBeTranslate(): void
    {
        $allowedCharacters = $this->numberOfAllowedCharacters();
        if (\strlen($this->text) > $allowedCharacters) {
            throw new \Exception("Text is too long! Upto {$allowedCharacters} characters can be translated");
        }
    }
}
