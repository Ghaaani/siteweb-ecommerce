/*!
 * E-commerce Website – shared shop interactions
 * Powers add-to-cart, buy-now, cart badge and the toast notifications.
 */
(function (window, $) {
    'use strict';

    var Ecom = window.Ecom || {};

    /* ---------------- Toast ---------------- */
    Ecom.toast = function (message, type) {
        var $container = $('#ecom-toast-container');
        if (!$container.length) {
            $container = $('<div id="ecom-toast-container"></div>').appendTo('body');
        }

        var icon = type === 'error' ? 'zmdi-alert-circle' : 'zmdi-check-circle';
        var $toast = $(
            '<div class="ecom-toast ecom-toast--' + (type || 'success') + '">' +
                '<i class="zmdi ' + icon + '"></i>' +
                '<span>' + message + '</span>' +
            '</div>'
        );

        $container.append($toast);

        window.setTimeout(function () {
            $toast.addClass('is-leaving');
            window.setTimeout(function () { $toast.remove(); }, 300);
        }, 2600);
    };

    /* ---------------- Cart badge ---------------- */
    Ecom.updateCartBadge = function () {
        $.ajax({
            url: '/cart',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                var count = response.products ? response.products.length : 0;
                var $el = $('.cart-quantity');
                if (!$el.length) { return; }
                $el.text(count);
                $el.removeClass('bump');
                void $el[0].offsetWidth;
                $el.addClass('bump');
            },
            error: function (error) {
                console.error('Error updating cart badge:', error);
            }
        });
    };

    /* ---------------- Add to cart ---------------- */
    Ecom.addToCart = function (productId, onDone) {
        $.ajax({
            url: '/insert-Poduct/' + productId,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                Ecom.updateCartBadge();
                Ecom.toast('Added to your cart', 'success');
                if (typeof onDone === 'function') { onDone(response); }
            },
            error: function (error) {
                console.error('Error adding product to cart:', error);
                Ecom.toast('Could not add this product to your cart', 'error');
            }
        });
    };

    /* ---------------- Buy now ---------------- */
    Ecom.buyNow = function (productId) {
        Ecom.addToCart(productId, function () {
            window.location.href = '/checkout';
        });
    };

    /* ---------------- Remove from cart ---------------- */
    Ecom.removeFromCart = function (itemId, onDone) {
        $.ajax({
            url: '/remove-product/' + itemId,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                Ecom.updateCartBadge();
                Ecom.toast('Removed from your cart', 'success');
                if (typeof onDone === 'function') { onDone(response); }
            },
            error: function (error) {
                console.error('Error removing product from cart:', error);
            }
        });
    };

    /* ---------------- Wish list ---------------- */
    Ecom.toggleWishlist = function (productId, button) {
        $.ajax({
            url: '/wishlist/toggle/' + productId,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': ($('meta[name="csrf-token"]').attr('content') || '') },
            success: function (response) {
                if (!response.success) { return; }

                var $buttons = $('.ecom-wish[data-product-id="' + productId + '"]');
                if (button) { $buttons = $buttons.add(button); }
                $buttons.toggleClass('is-active', !!response.added);
                $buttons.find('i').attr('class', response.added ? 'zmdi zmdi-favorite' : 'zmdi zmdi-favorite-outline');

                Ecom.toast(response.message, 'success');
            },
            error: function (error) {
                console.error('Error updating wish list:', error);
                Ecom.toast('Could not update your wish list', 'error');
            }
        });
    };

    /* ---------------- Expose globally ---------------- */
    window.Ecom = Ecom;
    window.ecomAddToCart = Ecom.addToCart;
    window.ecomBuyNow = Ecom.buyNow;
    window.ecomRemoveFromCart = Ecom.removeFromCart;
    window.ecomUpdateCartBadge = Ecom.updateCartBadge;
    window.ecomToast = Ecom.toast;
    window.ecomToggleWishlist = Ecom.toggleWishlist;

    /* Keep the legacy helper working (header mini-cart). */
    window.Remove = function (id) {
        Ecom.removeFromCart(id);
    };
})(window, jQuery);
