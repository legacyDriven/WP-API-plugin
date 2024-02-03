<?php

namespace CompilerApi\Proxy;

// Klasa służąca jako proxy dla żądania AJAX WordPressa.
use Exception;

class CompilerProxy {

    // Metoda statyczna obsługująca żądanie.
    public static function handleRequest() {
        check_ajax_referer('my_code_compiler_nonce', 'nonce'); // Sprawdzenie nonce

        try {
            // Odbiór danych JSON przesłanych metodą POST.
            $json = file_get_contents('php://input');
            $requestData = json_decode($json, true);

            // Sprawdzenie czy otrzymano wymagane dane.
            if (!isset($requestData['language']) || !isset($requestData['code'])) {
                throw new Exception('Brakujące parametry.');
            }

            // Utworzenie instancji CompilerService i wykonanie kompilacji.
            $compilerService = new CompilerService($requestData['language'], $requestData['code']);
            $result = $compilerService->compile();
            echo $result; // Wysłanie wyniku do klienta.
        } catch (Exception $e) {
            // Obsługa błędów i wysłanie komunikatu o błędzie.
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }

        wp_die(); // Zakończenie działania skryptu w kontekście WordPressa.
    }
}
// Tutaj rejestrujesz handleRequest w WordPress
add_action('wp_ajax_compiler_proxy', ['CompilerApi\Proxy\CompilerProxy', 'handleRequest']);
add_action('wp_ajax_nopriv_compiler_proxy', ['CompilerApi\Proxy\CompilerProxy', 'handleRequest']);