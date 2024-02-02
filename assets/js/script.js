jQuery(document).ready(function($) {
    $('#check-code').click(function() {
        var language = $('#language-select').val();
        var code = $('#code-input').val();

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'compiler_proxy',
                language: language,
                code: code
            },
            beforeSend: function() {
                $('#result').removeClass('result-success result-error').text('Kompilacja w toku...');
            },
            success: function(response) {
                var resultData = JSON.parse(response); // Parsowanie odpowiedzi JSON
                $('#result code').text(resultData.output); // Wstawienie wyniku do elementu <code>
                if (resultData.output && !resultData.error) { // Sprawdzenie, czy jest wynik i nie ma błędu
                    $('#result').addClass('result-success').removeClass('result-error');
                } else {
                    $('#result').addClass('result-error').removeClass('result-success');
                }
                Prism.highlightAll();
            },
            // success: function(response) {
            //     // Przykład: Możesz dostosować logikę w zależności od struktury Twojej odpowiedzi
            //     $('#result code').text(response);
            //     if (response.includes('Error')) { // Zakładamy, że błąd kompilacji zawiera słowo "Error"
            //         $('#result').addClass('result-error');
            //     } else {
            //         $('#result').addClass('result-success');
            //     }
            //     Prism.highlightAll();
            // },
            error: function() {
                $('#result code').text('Wystąpił błąd podczas kompilacji kodu.').addClass('result-error');
                Prism.highlightAll();
            }
        });
    });
});


// jQuery(document).ready(function($) {
//     // Nasłuchiwanie kliknięcia przycisku "Sprawdź Kod"
//     $('#check-code').click(function() {
//         // Pobieranie danych z formularza
//         var language = $('#language-select').val();
//         var code = $('#code-input').val();
//
//         // Wykonanie żądania AJAX
//         $.ajax({
//             url: ajaxurl, // 'ajaxurl' jest zmienną globalną zdefiniowaną przez WordPress
//             type: 'POST',
//             data: {
//                 action: 'compiler_proxy', // Nazwa akcji przekazywana do WordPressa, aby zidentyfikować, które zapytanie obsłużyć
//                 language: language, // Przekazanie wybranego języka programowania
//                 code: code // Przekazanie kodu źródłowego do kompilacji
//             },
//             beforeSend: function() {
//                 // Opcjonalnie: aktualizacja UI, np. pokazanie loadera
//                 $('#result').text('Kompilacja w toku...');
//             },
//             success: function(response) {
//                 // Aktualizacja interfejsu użytkownika z wynikami kompilacji
//                 $('#result').html(response);
//             },
//             error: function() {
//                 // Obsługa błędu żądania
//                 $('#result').text('Wystąpił błąd podczas kompilacji kodu.');
//             }
//         });
//     });
// });
