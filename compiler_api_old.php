<?php

/*
Plugin Name: Compiler API
Plugin URI: http://youwishtherewasone.joke
Description: A brief description of the Plugin.
Version: 1.0
Author: twoja_stara
Author URI: http://yomama.pro
License: A "Slug" license name e.g. GPL2
*/

// Exit if accessed directly
if(!defined('ABSPATH'))
{
    // to ponizej to AI zrobil, pozwolilem mu i sobie zostawic to na pamiatke
//    echo 'Juz kurwa nie!'; // Wypierdalaj
    echo "You came to the wrong neighbourhood!";
    exit;
}


// Rejestrowanie skryptów i stylów
function my_code_compiler_enqueue_scripts() {
    wp_enqueue_style('my-code-compiler-css', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_script('my-code-compiler-js', plugin_dir_url(__FILE__) . 'assets/js/script_old.js', array('jquery'), '1.0', true);
    wp_enqueue_style('prism-css', 'https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/themes/prism.css');
}
add_action('wp_enqueue_scripts', 'my_code_compiler_enqueue_scripts');  // Załączanie pliku skryptu

// Załączanie pliku shortcode
require_once plugin_dir_path(__FILE__) . 'shortcodes/compiler_api_shortcode.php';

function my_code_compiler_shortcode() {
    ob_start();
    ?>
    <select id="language-select">
        <option value="java">Java 17</option>
        <option value="scala">Scala 2.13</option>
        <option value="python3">Python 3</option>
    </select>

    <textarea id="code-input" placeholder="Wpisz swój kod tutaj..."></textarea>
    <button id="check-code">Sprawdź Kod</button>
    <div id="result"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/prism.js"></script>
    <script>
        // Tutaj umieść JavaScript z Twojego poprzedniego kodu
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode('code_compiler', 'my_code_compiler_shortcode');
