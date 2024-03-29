<?php

/*
Plugin Name: Compiler API
Plugin URI: http://youwishtherewasone.joke
Description: Compile and run your code on remote servers. Available support for Java 17, Scala 2.13, and Python 3.
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
    // Przekazanie ajaxurl i nonce do skryptu JavaScript
    wp_localize_script('my-code-compiler-js', 'myCodeCompiler', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('my_code_compiler_nonce'), // Tworzenie i przekazywanie nonce
    ));
}
add_action('wp_enqueue_scripts', 'my_code_compiler_enqueue_scripts');

// Dołącza plik zawierający kod dla shortcode
require_once plugin_dir_path(__FILE__) . 'shortcodes/compiler_api_shortcode.php';
// W Twoim głównym pliku wtyczki (np. compiler-api.php)
require_once plugin_dir_path(__FILE__) . 'ajax-handlers.php';

// Rejestruje handleRequest w WordPress