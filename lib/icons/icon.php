<?php

if (!defined('ABSPATH')) {
    exit;
}

function eabcdev_portfolio_icon(string $name): string {
    // lookup within current directory
    $file = __DIR__ . "/{$name}.php";

    // future check if I can improve the returned here
    if (! file_exists($file)) {
        return '';
    }

    // intercept and capture html output (like echo statements or template files) in server memory instead of sending it directly to the browser
    ob_start();

    require $file;

    return ob_get_clean();
    // ob_start(): This function initiates the buffer. Once called, anything that would normally be displayed on the screen is hidden away in a temporary memory slot.ob_get_clean(): This function extracts the captured content from the temporary memory slot as a string variable and simultaneously closes the buffer.
    // WordPress requires shortcode functions to return content as a string rather than echo it. If you use raw HTML or echo inside a shortcode, the content will break layout structures and float to the absolute top of the page. Output buffering solves this problem seamlessly.
}