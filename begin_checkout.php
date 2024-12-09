<?php
add_action('wp_footer', 'wc_datalayer_begin_checkout');

function wc_datalayer_begin_checkout()
{
    // Sprawdź, czy to strona realizacji zamówienia
    if (!is_checkout() || is_order_received_page()) {
        return;
    }

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
            'item_brand'    => 'Bini', // Możesz pobrać markę, jeśli używasz taksonomii
            'item_category' => wc_get_product_category_list($product->get_id(), ', '),
            'price'         => $product->get_price(),
            'quantity'      => $cart_item['quantity'],
        ];
    }

    // Wygenerowanie skryptu Data Layer
?>
<script>
window.dataLayer = window.dataLayer || [];
window.dataLayer.push({
    event: "begin_checkout",
    ecommerce: {
        currency: "<?php echo get_woocommerce_currency(); ?>",
        value: <?php echo WC()->cart->get_total('raw'); ?>,
        items: <?php echo json_encode($cart_data); ?>
    }
});
</script>
<?php
}