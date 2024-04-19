<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

// Define the function to return the HTML for the Facebook settings tab
function dw_facebook_settings_tab() {
    ob_start(); // Start output buffering to capture output
    ?>
    <h2>Facebook Settings</h2>
    <form action="options.php" method="post">
        <?php settings_fields('dw-facebook-settings'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">FB Pixel</th>
                <td><input type="text" name="dw_fb_pixel" value="<?php echo esc_attr(get_option('dw_fb_pixel')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">FB Conversion API</th>
                <td><input type="text" name="dw_fb_conversion_api" value="<?php echo esc_attr(get_option('dw_fb_conversion_api')); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
    <?php
    $content = ob_get_clean(); // End output buffering and get the contents
    return $content;
}


