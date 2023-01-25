
(function ($) {

    $(document).on('click', '.add-to-cart', function (e) {
        e.preventDefault();

        let thisbutton = $(this);

        let id = thisbutton.val();
        let product_qty = document.querySelector('.add-to-cart').getAttribute('data-quantity') || 1;
        let product_id = thisbutton.data('product_id');

        let data = {
            action: 'woocommerce_ajax_add_to_cart',
            product_id: product_id,
            product_sku: '',
            quantity: product_qty,
            // variation_id: variation_id,
        };

        $(document.body).trigger('adding_to_cart', [data]);

        $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {
                thisbutton.removeClass('added').addClass('loading');
            },
            complete: function (response) {
                thisbutton.addClass('added').removeClass('loading');
            },
            success: function (response) {
                $( ".cart-wrapper" ).empty();
                $( ".cart-wrapper" ).append(response);
            },
        });
    });


})(jQuery);