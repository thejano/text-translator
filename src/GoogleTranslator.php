<?php

namespace TheJano\TextTranslator;

use TheJano\TextTranslator\Abstracts\Translate;
use TheJano\TextTranslator\Contracts\TranslateInterface;

class GoogleTranslator extends Translate implements TranslateInterface
{
    public function numberOfAllowedCharacters(): int
    {
        return 5000;
    }

    public function _translate(string $text, string $targetLanguage = '', string $sourceLanguage = ''): string
    {
        $this->setText($text);
        $this->setProvidedLanguages($sourceLanguage, $targetLanguage);

        $this->validateLanguages();
        $this->checkTextCanBeTranslate();

        $request = $this->makeRequest();

        return $this->extractTranslate($request);
    }

    public function makeRequest(): string
    {
        $url = "https://translate.google.com/m?tl={$this->targetLanguage}&sl={$this->sourceLanguage}&q={$this->text}";

        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);

        if (200 !== $response->getStatusCode()) {
            throw new \Exception('Could not connect to google translate');
        }

        return $response->getBody()->getContents();
    }

    public function extractTranslate(string $html): string
    {
        $pattern = '/(?s)class="(?:t0|result-container)">(.*?)</';

        preg_match_all('/(?s)class="(?:t0|result-container)">(.*?)</', $html, $result);

        return $result[1][0];
    }
}
