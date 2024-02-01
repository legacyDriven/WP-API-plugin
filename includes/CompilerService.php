<?php

namespace CompilerApi\Compiler;

// Klasa odpowiedzialna za komunikację z zewnętrznym API kompilatora.
class CompilerService {
    private $language; // Zmienna przechowująca język programowania.
    private $code; // Zmienna przechowująca kod do kompilacji.

    // Konstruktor klasy inicjujący zmienne.
    public function __construct($language, $code) {
        $this->language = $language;
        $this->code = $code;
    }

    // Metoda odpowiedzialna za proces kompilacji.
    public function compile() {
        // Wybór odpowiedniego URL i klucza API na podstawie języka.
        switch ($this->language) {
            case 'java':
                $url = 'https://java.example.com/api/compile';
                $apiKey = 'YourJavaAPIKey';
                break;
            case 'python':
                $url = 'https://python.example.com/api/compile';
                $apiKey = 'YourPythonAPIKey';
                break;
            case 'scala':
                $url = 'https://scala.example.com/api/compile';
                $apiKey = 'YourScalaAPIKey';
                break;
            default:
                throw new Exception('Nieobsługiwany język.');
        }

        // Przygotowanie nagłówków HTTP i danych do wysłania.
        $headers = $this->prepareHeaders($apiKey);
        $data = json_encode(['code' => $this->code, 'version' => 'latest']);

        // Wysłanie żądania HTTP i odbiór odpowiedzi.
        return $this->sendRequest($url, $headers, $data);
    }

    // Metoda pomocnicza do przygotowania nagłówków HTTP.
    private function prepareHeaders($apiKey) {
        return [
            'Content-Type: application/json',
            "Authorization: Bearer {$apiKey}"
        ];
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