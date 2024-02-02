<?php

namespace CompilerApi\Proxy;

use Exception;

// Klasa odpowiedzialna za komunikację z zewnętrznym API kompilatora.
class CompilerService {
    private $language; // Zmienna przechowująca język programowania.
    private $code; // Zmienna przechowująca kod do kompilacji.
    private $version = 'latest';
    private $apiKey = 'b8251e0cb7mshc30d4392580738bp13a8f1jsnd86a6b0e688b';

    // Konstruktor klasy inicjujący zmienne.
    public function __construct($language, $code) {
        $this->language = $language;
        $this->code = $code;
    }

    // Metoda odpowiedzialna za proces kompilacji.
    public function compile() {
        $url = $this->getUrlBasedOnLanguage($this->language);
        $headers = $this->prepareHeadersBasedOnLanguage($this->language);

        $data = json_encode(['code' => $this->code, 'version' => $this->version]);

        return $this->sendRequest($url, $headers, $data);
    }

    private function getUrlBasedOnLanguage($language) {
        // Twoja logika wyboru URL na podstawie języka
        // Na przykład:
        switch ($language) {
            case 'java':
                return 'https://java-code-compiler.p.rapidapi.com/';
            case 'python':
                return 'https://python-code-compiler.p.rapidapi.com/';
            case 'scala':
                return 'https://scala-code-compiler.p.rapidapi.com/';
            default:
                throw new \Exception('Nieobsługiwany język.');
        }
    }

    private function prepareHeadersBasedOnLanguage($language) {

        $apiHost = $this->getApiHostBasedOnLanguage($language);

        return [
            'Content-Type: application/json',
            'X-RapidAPI-Key' => $this->apiKey,
            'X-RapidAPI-Host' => $apiHost
        ];
    }

    private function getApiHostBasedOnLanguage($language) {
        switch ($language) {
            case 'java':
                return 'java-code-compiler.p.rapidapi.com';
            case 'python':
                return 'python-code-compiler.p.rapidapi.com';
            case 'scala':
                return 'scala-code-compiler.p.rapidapi.com';
            default:
                throw new \Exception('Nieobsługiwany język.');
        }
    }

    // Metoda pomocnicza do wysyłania żądania HTTP.
    private function sendRequest($url, $headers, $data) {
        $options = [
            'http' => [
                'header'  => implode("\r\n", $headers),
                'method'  => 'POST',
                'content' => $data
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            throw new Exception('Błąd komunikacji z zewnętrznym API.');
        }
        return $result;
    }

}