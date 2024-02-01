<?php

/*
Plugin Name: API Code Runner
Plugin URI: http://youwishtherewasone.joke
Description: A brief description of the Plugin.
Version: 1.0
Author: twoja_stara
Author URI: http://yomama.pro
License: A "Slug" license name e.g. GPL2
*/

// Rejestrowanie skryptów i stylów
function my_code_compiler_enqueue_scripts() {
    wp_enqueue_style('my-code-compiler-css', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_script('my-code-compiler-js', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'my_code_compiler_enqueue_scripts');

// Załączanie pliku shortcode
require_once plugin_dir_path(__FILE__) . 'shortcodes/code_compiler_shortcode.php';