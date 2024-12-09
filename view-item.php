<?php
if (!defined('ABSPATH')) {
    exit; // Bezpośredni dostęp zabroniony
}

function wc_datalayer_view_item()
{
    if (!is_product()) {
        return;
    }

    global $product;

    if (!$product instanceof WC_Product) {
        return;
    }

    // Pobranie danych produktu
    $product_data = [
        'event' => 'view_item',
        'ecommerce' => [
            'currency' => get_woocommerce_currency(),
            'items' => [
                [
                    'item_name' => $product->get_name(),
                    'item_id' => $product->get_sku() ?: $product->get_id(),
                    'price' => $product->get_price(),
                    'item_brand' => 'Bini', // Domyślna marka
                    'item_category' => wc_get_product_category_list($product->get_id(), ', '),
                    'item_variant' => '',
                    'quantity' => 1, // Domyślnie 1 dla view_item
                ],
            ],
        ],
    ];

    // Wygenerowanie skryptu Data Layer
    echo '<script>';
    echo 'window.dataLayer = window.dataLayer || [];';
    echo 'window.dataLayer.push(' . json_encode($product_data) . ');';
    echo '</script>';
}