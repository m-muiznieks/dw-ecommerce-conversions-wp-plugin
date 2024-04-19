<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

register_setting( 'dw-google-settings', 'dw_gtm_id' );
register_setting( 'dw-google-settings', 'dw_enable_ecommerce' );
register_setting( 'dw-header-and-footer', 'dw_header_scripts' );
register_setting( 'dw-header-and-footer', 'dw_body_scripts' );
register_setting( 'dw-header-and-footer', 'dw_footer_scripts' );
register_setting( 'dw-facebook-settings', 'dw_fb_pixel' );
register_setting( 'dw-facebook-settings', 'dw_fb_conversion_api' );
register_setting( 'dw-other-settings', 'dw_webhook_url' );
register_setting( 'dw-other-settings', 'dw_activecampaign_api' );
register_setting( 'dw-other-settings', 'dw_activecampaign_url' );

//## OTHER SETTINGS ##
register_setting( 'dw-other-settings', 'dw_when_to_send_purchase_data' );
register_setting('dw-other-settings', 'dw_change_processing_to_completed');
register_setting('dw-other-settings', 'dw_do_not_send_purchase_data_twice');

