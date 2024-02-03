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

if (!defined('ABSPATH')) {
    exit; // Zapobiegaj bezpośredniemu dostępowi do pliku
}

function my_code_compiler_enqueue_scripts()
{
    wp_enqueue_style('my-code-compiler-css', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_script('my-code-compiler-js', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), '1.0', true);
    wp_enqueue_style('prism-css', 'https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/themes/prism.css');
    wp_enqueue_script('prism-js', 'https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/prism.js', array(), '9000.0.1', true);

    // Przekazanie ajaxurl i nonce do skryptu JavaScript
    wp_localize_script('my-code-compiler-js', 'myCodeCompiler', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('my_code_compiler_nonce'), // Tworzenie i przekazywanie nonce
    ));
}

add_action('wp_enqueue_scripts', 'my_code_compiler_enqueue_scripts');

// Dołączenie plików z logiką shortcode i obsługą AJAX
require_once plugin_dir_path(__FILE__) . 'shortcodes/compiler_api_shortcode.php';
require_once plugin_dir_path(__FILE__) . 'ajax-handlers.php';



