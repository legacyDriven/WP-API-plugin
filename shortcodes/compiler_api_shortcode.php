<?php


function my_code_compiler_shortcode() {
    ob_start();
    ?>
    <!-- Tutaj wklejasz HTML -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/prism.js"></script>
    <?php
    return ob_get_clean();
}
add_shortcode('code_compiler', 'my_code_compiler_shortcode');
