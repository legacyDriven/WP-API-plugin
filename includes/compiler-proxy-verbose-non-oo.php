<?php
// Rozpoczęcie skryptu PHP. W Javie każdy plik źródłowy zaczyna się od pakietu lub importów.

if (!defined('ABSPATH')) exit;

function handle_compiler_request() {
// Definicja funkcji `handle_compiler_request`. W Javie odpowiadałoby to definicji metody, np. `public void handleCompilerRequest() {`.

    $json = file_get_contents('php://input');
    // Odczytanie surowych danych przesłanych metodą POST. W Javie możesz to zrobić za pomocą `ServletRequest` i metody `getInputStream()`.

    $requestData = json_decode($json, true);
    // Dekodowanie JSONa na tablicę asocjacyjną w PHP. W Javie użyjesz biblioteki do parsowania JSON, np. Gson lub Jackson, aby przekonwertować JSON na obiekt.

    if (isset($requestData['language']) && isset($requestData['code'])) {
        // Sprawdzenie, czy określone klucze istnieją w tablicy. W Javie to sprawdzanie obecności pola w obiekcie.

        $language = $requestData['language'];
        $code = $requestData['code'];
        // Przypisanie wartości do zmiennych. Analogiczne do Javy.

        $data = array(
            'code' => $code,
            'version' => 'latest',
        );
        // Przygotowanie danych do wysłania. W Javie użyjesz obiektu z odpowiednimi polami.

        switch ($language) {
            // Instrukcja warunkowa na podstawie zmiennej. W Javie `switch` działa bardzo podobnie.

            case 'java':
            case 'python':
            case 'scala':
                // Przypadki dla różnych języków programowania. W Javie to samo.

                $url = 'https://...'; // Tutaj wybierany jest URL na podstawie języka.
                $apiKey = 'Your...APIKey'; // Tutaj przypisywany jest klucz API.
                break;
            // Przerwanie switch, aby nie wykonywać dalszego kodu po dopasowaniu przypadku.

            default:
                // Domyślny przypadek, gdy żaden z przypadków nie pasuje.
                http_response_code(400); // Ustawienie kodu odpowiedzi HTTP na 400.
                echo json_encode(array('error' => 'Nieobsługiwany język.'));
                wp_die();
            // Wysłanie odpowiedzi i zakończenie skryptu.
        }

        $headers = array(
            'Content-Type: application/json',
            "Authorization: Bearer {$apiKey}",
        );
        // Przygotowanie nagłówków HTTP. W Javie mogłoby to być zrealizowane przy pomocy obiektu `HttpHeaders`.

        $options = array(
            'http' => array(
                'header'  => implode("\r\n", $headers),
                'method'  => 'POST',
                'content' => json_encode($data),
            )
        );
        // Konfiguracja kontekstu żądania HTTP. W Javie użyłbyś klasy `HttpURLConnection` lub klienta HTTP z biblioteki zewnętrznej, np. Apache HttpClient, do skonfigurowania żądania.

        $context  = stream_context_create($options);
        // Tworzenie kontekstu strumienia, aby użyć go w żądaniu HTTP.

        $result = file_get_contents($url, false, $context);
        // Wykonanie żądania HTTP i otrzymanie odpowiedzi. W Javie użyjesz metody `execute()` na obiekcie reprezentującym żądanie HTTP.

        if ($result === FALSE) {
            // Sprawdzenie, czy wynik jest FALSE, co oznacza błąd w żądaniu.

            http_response_code(500); // Ustawienie kodu błędu HTTP na 500.
            echo json_encode(array('error' => 'Błąd komunikacji z zewnętrznym API.'));
            // Wysłanie odpowiedzi z błędem.
        } else {
            echo $result;
            // Wysłanie prawidłowej odpowiedzi.
        }
    } else {
        http_response_code(400); // Nieprawidłowe żądanie, np. brak wymaganych danych.
        echo json_encode(array('error' => 'Brakujące parametry.'));
        // Informacja o błędzie.
    }

    wp_die();
    // Zakończenie wykonania skryptu i zapobieganie dalszemu wykonywaniu kodu WordPressa.
}

add_action('wp_ajax_compiler_proxy', 'handle_compiler_request');
add_action('wp_ajax_nopriv_compiler_proxy', 'handle_compiler_request');
// Rejestracja funkcji obsługującej żądania AJAX w WordPressie, dla zalogowanych i niezalogowanych użytkowników.
