<?php

namespace CompilerApi\Compiler;

// Klasa służąca jako proxy dla żądania AJAX WordPressa.
class CompilerProxy {
    // Metoda statyczna obsługująca żądanie.
    public static function handleRequest() {
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