jQuery(document).ready(function ($) {
    // Dostęp do przekazanych danych koszyka
    const cartItems = wc_cart_data.items;
    const currency = wc_cart_data.currency;

    // Nasłuchiwanie na kliknięcie "Usuń z koszyka"
    $(document).on('click', '.product-remove a', function (e) {
        e.preventDefault();

        // Pobierz ID produktu
        const productId = $(this).data('product_id');
        const removedItem = cartItems.find(item => item.item_id == productId);
        // window.dataLayer.push({ ecommerce: null });
        console.log()
        // window.dataLayer.push({
        //     'event': 'removeFromCart',
        //     'ecommerce': {
        //       'remove': {                               
        //         'products': [{                         
        //             'name': 'Remove Triblend Android T-Shirt',
        //             'id': Producid, // this variable Producid not print value it just showing name of the variable
        //             'price': removedItem.price,
        //             'brand': 'Google',
        //             'category': 'Apparel',
        //             'variant': 'Gray',
        //             'quantity': 1
        //         }]
        //       }
        //     }
        // if (removedItem) {
        //     // Wywołanie zdarzenia gtag z danymi usuwanego produktu
        //     gtag("event", "remove_from_cart", {
        //         currency: currency,
        //         value: removedItem.price * removedItem.quantity,
        //         items: [removedItem],
        //     });
        // }
    });
});
