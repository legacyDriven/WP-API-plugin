<?php

require_once __DIR__ . '/CompilerService.php'; // Użycie absolutnej ścieżki dostępu

use CompilerApi\Proxy\CompilerService;

// Przykładowe dane do testowania
$language = 'java'; // Możesz zmienić na 'python', 'scala', etc.
$code = 'public class Main { public static void main(String[] args) { System.out.println("Hello, World!, hello, twoja_stara"); } }';

// Utworzenie instancji serwisu i wywołanie kompilacji
$compilerService = new CompilerService($language, $code);

try {
    $result = $compilerService->compile();
    echo "Wynik kompilacji: \n" . $result;
} catch (Exception $e) {
    echo "Wystąpił błąd: " . $e->getMessage();
}
