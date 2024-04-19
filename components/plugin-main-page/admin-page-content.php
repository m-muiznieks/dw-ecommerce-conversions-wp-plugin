<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

//IMPORT TAB CONTENT
include_once(plugin_dir_path(__FILE__) . 'setting-pages/facebook-settings.php');
include_once(plugin_dir_path(__FILE__) . 'setting-pages/google-settings.php');
include_once(plugin_dir_path(__FILE__) . 'setting-pages/headers-footers.php');
include_once(plugin_dir_path(__FILE__) . 'setting-pages/conversion-api-settings.php');

function dw_plugin_content() {
    $default_tab = null;
    $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <nav class="nav-tab-wrapper">
            <a href="?page=dw-ecom-conversions" class="nav-tab <?php echo ($tab === null) ? 'nav-tab-active' : ''; ?>">Google Settings</a>
            <a href="?page=dw-ecom-conversions&tab=facebook" class="nav-tab <?php echo ($tab === 'facebook') ? 'nav-tab-active' : ''; ?>">Facebook Settings</a>
            <a href="?page=dw-ecom-conversions&tab=haf" class="nav-tab <?php echo ($tab === 'haf') ? 'nav-tab-active' : ''; ?>">Headers And Footers</a>
            <a href="?page=dw-ecom-conversions&tab=capi" class="nav-tab <?php echo ($tab === 'capi') ? 'nav-tab-active' : ''; ?>">Conversion API</a>
        </nav>
        <?php dw_render_tab_content($tab); ?>
    </div>
    <?php
}

function dw_render_tab_content($tab) {
    ob_start(); 
    switch ($tab) {
        case 'facebook':
            echo dw_facebook_settings_tab(); // Echo because it returns content
            break;
        case 'haf':
            echo dw_headers_footers_settings_tab();
            break;
        case 'capi':
            echo dw_conversion_api_settings_tab();
            break;
        default:
            echo dw_google_settings_tab();
    }
    $content = ob_get_clean(); // End output buffering and get the contents
    echo $content; // Output the content
}

