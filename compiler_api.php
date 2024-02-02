<?php

/*
Plugin Name: Compiler API
Plugin URI: http://youwishtherewasone.joke
Description: A brief description of the Plugin.
Version: 1.0
Author: twoja_stara
Author URI: http://yomama.pro
License: GPL2
*/

// Zapobiegaj bezpośredniemu dostępowi do pliku
if (!defined('ABSPATH')) {
    echo "You came to the wrong neighbourhood!";
    exit;
}

// Rejestruje skrypty i style używane przez wtyczkę
function my_code_compiler_enqueue_scripts() {
    // Rejestruje i dodaje arkusz stylów CSS dla własnych stylów wtyczki
    wp_enqueue_style('my-code-compiler-css', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    // Rejestruje i dodaje skrypt JavaScript, zależny od jQuery, dla własnej logiki wtyczki
    wp_enqueue_script('my-code-compiler-js', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), '1.0', true);
    // Rejestruje i dodaje arkusz stylów CSS dla Prism.js (do kolorowania składni)
    wp_enqueue_style('prism-css', 'https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/themes/prism.css');
    // Dodaje skrypt Prism.js do kolorowania składni
    wp_enqueue_script('prism-js', 'https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/prism.js', array(), '9000.0.1', true);
}
add_action('wp_enqueue_scripts', 'my_code_compiler_enqueue_scripts');

// Dołącza plik zawierający kod dla shortcode
require_once plugin_dir_path(__FILE__) . 'shortcodes/compiler_api_shortcode.php';

//
///*
//Plugin Name: Compiler API
//Plugin URI: http://youwishtherewasone.joke
//Description: A brief description of the Plugin.
//Version: 1.0
//Author: twoja_stara
//Author URI: http://yomama.pro
//License: GPL2
//*/
//
//// Zapobiegaj bezpośredniemu dostępowi do pliku
//if (!defined('ABSPATH')) {
//    echo "You came to the wrong neighbourhood!";
//    exit;
//}
//
//// Rejestruje skrypty i style używane przez wtyczkę
//function my_code_compiler_enqueue_scripts() {
//    // Rejestruje i dodaje arkusz stylów CSS dla własnych stylów wtyczki
//    wp_enqueue_style('my-code-compiler-css', plugin_dir_url(__FILE__) . 'assets/css/style.css');
//    // Rejestruje i dodaje skrypt JavaScript, zależny od jQuery, dla własnej logiki wtyczki
//    wp_enqueue_script('my-code-compiler-js', plugin_dir_url(__FILE__) . 'assets/js/script_old.js', array('jquery'), '1.0', true);
//    // Rejestruje i dodaje arkusz stylów CSS dla Prism.js (do kolorowania składni)
//    wp_enqueue_style('prism-css', 'https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/themes/prism.css');
//    // Dodaje skrypt Prism.js do kolorowania składni
//    wp_enqueue_script('prism-js', 'https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/prism.js', array(), '9000.0.1', true);
//}
//// Hook do wp_enqueue_scripts, aby załadować skrypty i style na stronie
//add_action('wp_enqueue_scripts', 'my_code_compiler_enqueue_scripts');
//
//// Dołącza plik zawierający kod dla shortcode
//require_once plugin_dir_path(__FILE__) . 'shortcodes/compiler_api_shortcode.php';
//
//// Definiuje shortcode, który umożliwia użytkownikom kompilację kodu
//function my_code_compiler_shortcode() {
//    ob_start();
//    ?>
<!--    <select id="language-select">-->
<!--        <option value="java">Java 17</option>-->
<!--        <option value="scala">Scala 2.13</option>-->
<!--        <option value="python3">Python 3</option>-->
<!--    </select>-->
<!---->
<!--    <textarea id="code-input" placeholder="Wpisz swój kod tutaj..." class="language-javascript"></textarea>-->
<!--    <button id="check-code">Sprawdź Kod</button>-->
<!--    <pre id="result"><code class="language-javascript"></code></pre>-->
<!---->
<!--    <script>-->
<!--        jQuery(document).ready(function($) {-->
<!--            $('#check-code').click(function() {-->
<!--                var language = $('#language-select').val();-->
<!--                var code = $('#code-input').val();-->
<!---->
<!--                // Przygotowanie kodu do wyświetlenia-->
<!--                $('#result code').text(code);-->
<!--                // Odświeżenie Prism do kolorowania składni-->
<!--                Prism.highlightAll();-->
<!---->
<!--                $.ajax({-->
<!--                    url: ajaxurl,-->
<!--                    type: 'POST',-->
<!--                    data: {-->
<!--                        action: 'compiler_proxy',-->
<!--                        language: language,-->
<!--                        code: code-->
<!--                    },-->
<!--                    success: function(response) {-->
<!--                        $('#result code').text(response);-->
<!--                        // Ponowne zastosowanie Prism do nowej treści-->
<!--                        Prism.highlightAll();-->
<!--                    },-->
<!--                    error: function(error) {-->
<!--                        $('#result code').text('Wystąpił błąd: ' + error.responseText);-->
<!--                        // Ponowne zastosowanie Prism, nawet w przypadku błędu-->
<!--                        Prism.highlightAll();-->
<!--                    }-->
<!--                });-->
<!--            });-->
<!--        });-->
<!--    </script>-->
<!--    --><?php
//    return ob_get_clean();
//}
//
//// Rejestruje shortcode, aby można było go użyć na stronach i postach
//add_shortcode('code_compiler', 'my_code_compiler_shortcode');
