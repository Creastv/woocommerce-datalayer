<?php
add_action('wp_enqueue_scripts', 'enqueue_remove_from_cart_script_with_data');

function enqueue_remove_from_cart_script_with_data()
{
    // Sprawdzenie, czy jesteśmy na stronie koszyka
    if (is_cart() || is_checkout()) {
        wp_enqueue_script(
            'wc-remove-from-cart',
            plugin_dir_url(__FILE__) . 'assets/js/remove-from-cart.js',
            ['jquery'],
            '1.0.0',
            true
        );

        // Pobierz dane koszyka
        $cart_items = WC()->cart->get_cart();
        $cart_data = [];

        foreach ($cart_items as $cart_item) {
            $product = $cart_item['data'];

            $cart_data[] = [
                'item_id'       => $product->get_id(),
                'item_name'     => $product->get_name(),
                'affiliation'   => 'Bini',
                'coupon'        => WC()->cart->get_applied_coupons() ? implode(', ', WC()->cart->get_applied_coupons()) : '',
                'discount'      => 0, // Możesz dodać logikę obliczania rabatu
                'index'         => 0, // Opcjonalnie ustaw pozycję w koszyku
                'item_brand'    => 'Bini', // Możesz pobrać markę, jeśli używasz taksonomii
                'item_category' => wc_get_product_category_list($product->get_id(), ', '),
                'item_list_id'  => 'cart_list',
                'item_list_name' => 'Cart',
                'price'         => $product->get_price(),
                'quantity'      => $cart_item['quantity'],
            ];
        }

        // Przekaż dane do skryptu JS
        wp_localize_script('wc-remove-from-cart', 'wc_cart_data', [
            'currency' => get_woocommerce_currency(),
            'items'    => $cart_data,
        ]);
    }
}