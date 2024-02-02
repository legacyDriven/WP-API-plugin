<?php


function my_code_compiler_shortcode() {
    ob_start();
    ?>
    <select id="language-select">
        <option value="java">Java 17</option>
        <option value="scala">Scala 2.13</option>
        <option value="python3">Python 3</option>
    </select>

    <textarea id="code-input" placeholder="Wpisz swój kod tutaj..." class="language-javascript"></textarea>
    <button id="check-code">Sprawdź Kod</button>
    <pre id="result"><code class="language-javascript"></code></pre>

    <script>
        jQuery(document).ready(function($) {
            $('#check-code').click(function() {
                var language = $('#language-select').val();
                var code = $('#code-input').val();

                // Przygotowanie kodu do wyświetlenia
                $('#result code').text(code);
                // Odświeżenie Prism do kolorowania składni
                Prism.highlightAll();

                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'compiler_proxy', // "xxxyyy" - zmień nazwę akcji na odpowiednią
                        language: language,
                        code: code
                    },
                    success: function(response) {
                        $('#result code').text(response);
                        // Ponowne zastosowanie Prism do nowej treści
                        Prism.highlightAll();
                    },
                    error: function(error) {
                        $('#result code').text('Wystąpił błąd: ' + error.responseText);
                        // Ponowne zastosowanie Prism, nawet w przypadku błędu
                        Prism.highlightAll();
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode('code_compiler', 'my_code_compiler_shortcode');


