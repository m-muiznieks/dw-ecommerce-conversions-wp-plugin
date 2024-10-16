<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

//ADD RELATED SCRIPTS FROM THE DIRECTORY
include_once(DW_BASE_DIR . 'tracking/datalayer-events/purchase-event.php');


//INSERT GOOGLE TAG MANAGER
function dw_insert_gtm() {
    $gtm_id = esc_js(get_option('digiezi_gtm_id'));
    if (!$gtm_id) return;

    // Header script
    add_action('wp_head', function() use ($gtm_id) {
        ?>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer', '<?php echo $gtm_id; ?>');</script>
        <!-- End Google Tag Manager -->
        <?php
    }, 1);

    // Body script
    add_action('wp_footer', function() use ($gtm_id) {
        ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr($gtm_id); ?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <?php
    }, 1);
}

// Replace the existing GTM activation with this:
if(get_option('digiezi_gtm_id')) { dw_insert_gtm(); }
    
//INSERT HEADER SCRIPTS
function dw_activate_header_script(){
  add_action('wp_head', 'insert_header', 1);
  function insert_header() {
    echo get_option('digiezi_header_scripts'); 
  }
}

//INSERT BODY SCRIPTS
function dw_activate_body_script(){
  add_action('wp_body_open', 'insert_body', 2);
  function insert_body() {
    echo get_option('digiezi_body_scripts'); 
  }
}

//INSERT FOOTER SCRIPTS
function dw_activate_footer_script() {
  add_action('wp_footer', 'insert_footer', 9999);
  function insert_footer() {
    echo get_option('digiezi_footer_scripts'); 
  }
}

//GOOGLE TAG MANAGER
if(get_option('digiezi_gtm_id')) { dw_insert_gtm(); }
    
//HEADER SCRIPT
if(get_option('digiezi_header_scripts')) { dw_activate_header_script(); }
    
//BODY SCRIPT
if(get_option('digiezi_body_scripts')) { dw_activate_body_script(); }
    
//FOOTER SCRIPT
if(get_option('digiezi_footer_scripts')) { dw_activate_footer_script(); }