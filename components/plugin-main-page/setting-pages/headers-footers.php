<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }


function dw_headers_footers_settings_tab() {
    ob_start(); // Start output buffering to capture output

    ?>
    <h2>Headers and Footers</h2>
    <form action="options.php" method="post">
        <?php settings_fields('dw-header-and-footer'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Header Scripts</th>
                <td><textarea name="dw_header_scripts" rows="5" cols="50"><?php echo esc_textarea(get_option('dw_header_scripts')); ?></textarea></td>
            </tr>
            <tr valign="top">
                <th scope="row">Body Scripts</th>
                <td><textarea name="dw_body_scripts" rows="5" cols="50"><?php echo esc_textarea(get_option('dw_body_scripts')); ?></textarea></td>
            </tr>
            <tr valign="top">
                <th scope="row">Footer Scripts</th>
                <td><textarea name="dw_footer_scripts" rows="5" cols="50"><?php echo esc_textarea(get_option('dw_footer_scripts')); ?></textarea></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
    <?php

    $content = ob_get_clean(); // End output buffering and get the contents
    return $content;
}
