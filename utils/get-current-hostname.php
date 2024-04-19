<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

/**
 * Retrieves the current hostname from the server environment and encodes it for safe use in HTML or JavaScript.
 *
 * This function fetches the hostname using the `HTTP_HOST` server variable, which is then sanitized and encoded based
 * on the specified context. It primarily protects against Cross-Site Scripting (XSS) attacks by encoding special characters
 * into their respective HTML entities for HTML context or into a JavaScript-safe string for JS context.
 *
 * Usage:
 * - Use 'html' context when embedding the hostname into HTML content such as attributes.
 * - Use 'js' (or default context) when passing the hostname into JavaScript code.
 *
 * @param string $context Specifies the encoding context ('html' for HTML entities, 'js' for JavaScript). Default 'js'.
 * @return string The sanitized and encoded hostname ready for safe inclusion in HTML or JavaScript.
 * @example
 * // HTML context usage
 * echo '<div data-host="' . dw_get_current_hostname('html') . '"></div>';
 *
 * // JavaScript context usage
 * echo '<script>var hostname = ' . dw_get_current_hostname() . ';</script>';
 */
function dw_get_current_hostname($context = 'js') {
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'unknown';

    if ($context === 'html') {
        // Encode for HTML context using htmlspecialchars
        return htmlspecialchars($host, ENT_QUOTES, 'UTF-8');
    } else {
        // Default: Encode for JavaScript context using json_encode
        $encoded_host = json_encode($host);
        return trim($encoded_host, '"');  // Remove the enclosing quotes added by json_encode
    }
}


