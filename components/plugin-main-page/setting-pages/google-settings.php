<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

function dw_google_settings_tab() {
    ob_start(); // Start capturing output into buffer
    ?>
    <h2>Google Settings</h2>
    <form action="options.php" method="post">
        <?php settings_fields('digiezi-google-settings'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Google Tag Manager ID (GTM-....)</th>
                <td><input type="text" name="dw_gtm_id" value="<?php echo esc_attr(get_option('dw_gtm_id')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Enable GA4 Ecommerce</th>
                <td>
                    <?php 
                    // Check if WooCommerce is active
                    if ( is_plugin_active('woocommerce/woocommerce.php') ) {
                        // Get the current setting with a default of 'FALSE' if not set
                        $ecommerce_enabled = get_option('dw_enable_ecommerce', 'FALSE');
                        ?>
                        <select name="dw_enable_ecommerce">
                            <option value="TRUE" <?php selected($ecommerce_enabled, 'TRUE'); ?>>ENABLED</option>
                            <option value="FALSE" <?php selected($ecommerce_enabled, 'FALSE'); ?>>DISABLED</option>
                        </select>
                    <?php 
                    } else {
                        // If WooCommerce is not active, ensure the setting is disabled and set to 'FALSE'
                        update_option('dw_enable_ecommerce', 'FALSE');
                    ?>
                        <select name="dw_enable_ecommerce" disabled>
                            <option value="TRUE">ENABLED</option>
                            <option value="FALSE" selected>DISABLED</option>
                        </select>
                        <br><span class="description">Woocommerce is not installed. You should install it first!</span>
                    <?php } ?>
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
    <?php
    $content = ob_get_clean(); // Capture the buffer and clear it
    return $content;
}



