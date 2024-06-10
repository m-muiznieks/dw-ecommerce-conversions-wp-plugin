# Ecommerce Tracking Plugin
This plugin is intended to be used for events and ecommerce tracking in Wordpress and WooCommerce. Even though most of its functionilities is for Woocommerce, you can benefit also from it for using the Google Tag manager implementation, as well as various other scripts in your website `<head>`, `<body>` and `<footer>` tags.

## Installation
As plugin is not yet available in the official Wordpress plugin repository, you have to install it manually by downloading it from the [Github repository](https://github.com/m-muiznieks/dw-ecommerce-conversions-wp-plugin).
1. Download the file.
2. Manually upload the file to your Wordpress plugin directory.
3. Enjoy!

## Usage

### Google Tag Manager
The plugin comes with a Google Tag Manager implementation. You have to add a GTM Id (including the `GTM-` prefix) to the plugin settings.

### Header and Footer Scripts
Your theme must have the `<head>`, `<body>` and `<footer>` tags. Otherwise it wont work. 
Add any scripts you want to be executed. 

### Woocommerce Purchase Tracking And Conversion API
For this funcitonality to work, you have to activate Woocommerce in your Wordpress admin panel.

1. You can set whether or not the order status automatically changes to `completed`. If so - you can add set the status from when to change it (i.e. once the order status is `processing` it will set it to `completed`).
2. If GA4 Ecommerce settins is enabled, it will send the event purchase event to GTM script once the event is triggered by visiting the thank you page.
3. You can choose when to send a purchase data event - `processing` or `completed`. If you choose `processing`, the event will be sent when the order status changes to `processing` and same for `completed`. 
4. Additionally you can set not to send the purchase data event twice. This is useful so not to create event duplications. 

### Conversion API
For now it the only events that are sent to webhooks are the `purchase` event.

In the `Conversion API` settings you can set the webhook URL where to send the data.

### Facebook Settings
This section is under development for now.