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
        $params = [
            'sl' => $this->sourceLanguage,
            'tl' => $this->targetLanguage,
            'q' => $this->text,
            'dt' => 't',
            'dj' => '1',
            'client' => 'gtx',
            'oe' => 'utf-8',
            'ie' => 'utf-8',
        ];

        $url = 'https://translate.googleapis.com/translate_a/single?'.http_build_query($params);

        $client = new \GuzzleHttp\Client();
        $response = $client->get($url, [
            'headers' => [
                'User-Agent' => 'GoogleTranslate/6.6.1.RC09.302039986 (Linux; U; Android 9; Redmi Note 8)',
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Could not connect to google translate');
        }

        return $response->getBody()->getContents();
    }

    public function extractTranslate(string $data): string
    {
        $data = json_decode($data, true);

        return $data['sentences'][0]['trans'];
    }
}
