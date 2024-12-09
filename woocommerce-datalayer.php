<?php
/*
Plugin Name: WooCommerce Data Layer
Plugin URI:  https://roial.pl
Description: Dodaje Data Laye - WooCommerce.
Version:     1.0.0
Author:      Piotr Stefaniak
Author URI:  https://roial.pl
Text Domain: woocommerce-datalayer
*/

if (!defined('ABSPATH')) {
    exit; // Bezpośredni dostęp zabroniony
}

// Wczytanie pliku z kodem Data Layer
require_once plugin_dir_path(__FILE__) . 'view-item.php';
require_once plugin_dir_path(__FILE__) . 'remove_from_cart.php';
require_once plugin_dir_path(__FILE__) . 'begin_checkout.php';

// Hook do WooCommerce
add_action('wp_footer', 'wc_datalayer_view_item');