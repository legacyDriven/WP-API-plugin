jQuery(document).ready(function($) {
    var ajaxurl = myCodeCompiler.ajaxurl; // Teraz masz zmienną ajaxurl dostępną w JavaScript

    $('#check-code').click(function() {
        var language = $('#language-select').val();
        var code = $('#code-input').val();

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'compiler_proxy',
                nonce: myCodeCompiler.nonce,
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
            error: function() {
                $('#result code').text('Wystąpił błąd podczas kompilacji kodu.').addClass('result-error');
                Prism.highlightAll();
            }
        });
    });
});
