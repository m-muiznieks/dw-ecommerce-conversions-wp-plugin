<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

// Define the path to the log file
define('PLUGIN_LOG_DIR', plugin_dir_path(__FILE__) . 'logs/');
define('PLUGIN_LOG_FILE', PLUGIN_LOG_DIR . 'plugin-error.log');

if (!file_exists(PLUGIN_LOG_DIR)) {
    wp_mkdir_p(PLUGIN_LOG_FILE); 
}

function dw_ecom_log_error($message) {
    if (defined('PLUGIN_LOG_FILE')) {
        // Get the timezone from WordPress settings
        $timezone_string = get_option('timezone_string');
        
        // Create a DateTime object with the correct timezone
        $date = new DateTime('now', new DateTimeZone($timezone_string ?: 'UTC'));
        
        // Format the date with the timezone adjusted time
        $timestamp = $date->format('d-m-Y H:i:s');
        
        // Write the message with the timestamp to the log file
        file_put_contents(PLUGIN_LOG_FILE, "[$timestamp] $message" . PHP_EOL, FILE_APPEND);
    }
}
