<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

function dw_conversion_api_settings_tab() {
    ob_start(); // Start output buffering to capture output

    ?>
    <h2>Conversion API Settings</h2>
    <form action="options.php" method="post">
        <?php settings_fields('dw-other-settings'); ?>
        <div style="display: flex; flex-direction: row;">
            <div style="width: 50%;">
                <?php 
                    echo dw_div_purchase_event_settings_tab();
                ?>
            </div>
            
            <div style="width: 50%;">
                <h3>Datalayer Settings</h3>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Enable Datalayer</th>
                        <td>
                            <?php 
                            // Fetch the option value, ensure that the option name matches what you register
                            $enable_datalayer = get_option('dw_enable_datalayer', 'FALSE'); // Default to 'FALSE'
                            ?>
                            <select name="dw_enable_datalayer">
                                <option value="TRUE" <?php selected($enable_datalayer, 'TRUE'); ?>>Yes</option>
                                <option value="FALSE" <?php selected($enable_datalayer, 'FALSE'); ?>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Datalayer ID</th>
                        <td><input type="text" name="dw_datalayer_id" value="<?php echo esc_attr(get_option('dw_datalayer_id')); ?>" /></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php submit_button(); ?>
    </form>
    <?php

    $content = ob_get_clean(); // End output buffering and get the contents
    return $content;
}

function dw_div_purchase_event_settings_tab() {
    ob_start(); // Start output buffering to capture output
    ?>
    <h3>Purchase Event Settings</h3>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Webhook URL</th>
            <td><input type="url" name="dw_webhook_url" value="<?php echo esc_attr(get_option('dw_webhook_url')); ?>" /></td>
        </tr>
        <tr valign="top">
            <th scope="row">When to send purchase data</th>
            <td>
                <?php 
                // Check if WooCommerce is active
                if (dw_is_woocommerce_active()) {
                    // Get the current setting with a default of 'do_not_send_purchase_data' if not set
                    $when_to_send_purchase_data = get_option('dw_when_to_send_purchase_data', 'do_not_send_purchase_data');
                    ?>
                    <select name="dw_when_to_send_purchase_data">
                        <option value="woocommerce_thankyou" <?php selected($when_to_send_purchase_data, 'woocommerce_thankyou'); ?>>On Thank You Page View</option>
                        <option value="woocommerce_order_status_completed" <?php selected($when_to_send_purchase_data, 'woocommerce_order_status_completed'); ?>>On Completed Order Status</option>
                        <option value="woocommerce_order_status_processing" <?php selected($when_to_send_purchase_data, 'woocommerce_order_status_processing'); ?>>On Processing Order Status</option>
                        <option value="do_not_send_purchase_data" <?php selected($when_to_send_purchase_data, 'do_not_send_purchase_data'); ?>>Do Not Send Purchase Data</option>
                    </select>
                <?php 
                } else {
                    // If WooCommerce is not active, ensure the setting is disabled and set to 'do_not_send_purchase_data'
                    update_option('dw_when_to_send_purchase_data', 'do_not_send_purchase_data');
                    ?>
                        <select name="dw_when_to_send_purchase_data" disabled>
                            <option value="do_not_send_purchase_data" selected>Do Not Send Purchase Data</option>
                        </select>
                        <br><span class="description">WooCommerce is not active. You must activate it first!</span>
                    <?php 
                } ?>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Auto Change Processing Status To Completed</th>
            <td>
                <?php // Fetch the option value, ensure that the option name matches what you register
                    $change_processing_status = get_option('dw_change_processing_to_completed', 'FALSE'); // Default to 'FALSE'
                ?>
                <select name="dw_change_processing_to_completed">
                    <option value="TRUE" <?php selected($change_processing_status, 'TRUE'); ?>>Yes</option>
                    <option value="FALSE" <?php selected($change_processing_status, 'FALSE'); ?>>No</option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Do Not Send Purchase Data Twice</th>
            <td>
                <?php // Fetch the option value, ensure that the option name matches what you register
                    $do_not_send_twice = get_option('dw_do_not_send_purchase_data_twice', 'TRUE'); // Default to 'FALSE'
                ?>
                <select name="dw_do_not_send_purchase_data_twice">
                    <option value="TRUE" <?php selected($do_not_send_twice, 'TRUE'); ?>>Yes</option>
                    <option value="FALSE" <?php selected($do_not_send_twice, 'FALSE'); ?>>No</option>
                </select>
            </td>
        </tr>
    </table>

    <?php
    $content = ob_get_clean(); // End output buffering and get the contents
    return $content;
}