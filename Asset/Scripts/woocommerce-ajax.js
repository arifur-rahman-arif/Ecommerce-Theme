/* global wc_add_to_cart_params */
jQuery(function ($) {
    if (typeof wc_add_to_cart_params === 'undefined') {
        return false;
    }

    /**
     * AddToCartHandler class.
     */
    var AddToCartHandler = function () {
        this.requests = [];
        this.addRequest = this.addRequest.bind(this);
        this.run = this.run.bind(this);

        $(document.body)
            .on('click', '.add_to_cart_button', { addToCartHandler: this }, this.onAddToCart)
            .on('click', '.remove_from_cart_button', { addToCartHandler: this }, this.onRemoveFromCart)
            .on('added_to_cart', this.updateButton)
            .on('ajax_request_not_sent.adding_to_cart', this.updateButton)
            .on('added_to_cart removed_from_cart', { addToCartHandler: this }, this.updateFragments);
    };

    /**
     * Add add to cart event.
     */
    AddToCartHandler.prototype.addRequest = function (request) {
        this.requests.push(request);

        if (1 === this.requests.length) {
            this.run();
        }
    };

    /**
     * Run add to cart events.
     */
    AddToCartHandler.prototype.run = function () {
        var requestManager = this,
            originalCallback = requestManager.requests[0].complete;

        requestManager.requests[0].complete = function () {
            if (typeof originalCallback === 'function') {
                originalCallback();
            }

            requestManager.requests.shift();

            if (requestManager.requests.length > 0) {
                requestManager.run();
            }
        };

        $.ajax(this.requests[0]);
    };

    /**
     * Handle the add to cart event.
     */
    AddToCartHandler.prototype.onAddToCart = function (e) {
        var $thisbutton = $(this);

        if ($thisbutton.is('.ajax_add_to_cart')) {
            if (!$thisbutton.attr('data-product_id')) {
                return true;
            }

            e.preventDefault();

            // $thisbutton.removeClass('added');
            $thisbutton.html(`<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-hourglass-split" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0c0 .701.478 1.236 1.011 1.492A3.5 3.5 0 0 1 11.5 13s-.866-1.299-3-1.48V8.35z"/>
                                            </svg>`)
            // $thisbutton.addClass('loading');

            // Allow 3rd parties to validate and quit early.
            if (false === $(document.body).triggerHandler('should_send_ajax_request.adding_to_cart', [$thisbutton])) {
                $(document.body).trigger('ajax_request_not_sent.adding_to_cart', [false, false, $thisbutton]);
                return true;
            }

            var data = {};

            // Fetch changes that are directly added by calling $thisbutton.data( key, value )
            $.each($thisbutton.data(), function (key, value) {
                data[key] = value;
            });

            // Fetch data attributes in $thisbutton. Give preference to data-attributes because they can be directly modified by javascript
            // while `.data` are jquery specific memory stores.
            $.each($thisbutton[0].dataset, function (key, value) {
                data[key] = value;
            });

            // Trigger event.
            $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

            e.data.addToCartHandler.addRequest({
                type: 'POST',
                url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
                data: data,
                success: function (response) {
                    if (!response) {
                        return;
                    }

                    if (response.error && response.product_url) {
                        window.location = response.product_url;
                        return;
                    }

                    // Redirect to cart option
                    if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
                        window.location = wc_add_to_cart_params.cart_url;
                        return;
                    }

                    // Trigger event so themes can refresh other areas.
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                },
                dataType: 'json'
            });
        }
    };

    /**
     * Update fragments after remove from cart event in mini-cart.
     */
    AddToCartHandler.prototype.onRemoveFromCart = function (e) {
        var $thisbutton = $(this),
            $row = $thisbutton.closest('.woocommerce-mini-cart-item');

        e.preventDefault();

        $row.block({
            message: null,
            overlayCSS: {
                opacity: 0.6
            }
        });

        e.data.addToCartHandler.addRequest({
            type: 'POST',
            url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'remove_from_cart'),
            data: {
                cart_item_key: $thisbutton.data('cart_item_key')
            },
            success: function (response) {
                if (!response || !response.fragments) {
                    window.location = $thisbutton.attr('href');
                    return;
                }

                $(document.body).trigger('removed_from_cart', [response.fragments, response.cart_hash, $thisbutton]);
            },
            error: function () {
                window.location = $thisbutton.attr('href');
                return;
            },
            dataType: 'json'
        });
    };

    /**
     * Update cart page elements after add to cart events.
     */
    AddToCartHandler.prototype.updateButton = function (e, fragments, cart_hash, $button) {
        $button = typeof $button === 'undefined' ? false : $button;

        if ($button) {
            // $button.removeClass('loading');

            // if (fragments) {
            //     $button.addClass('added');
            // }
            $button.html(`<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                                    </svg>`);
            // View cart text.
            // if (fragments && !wc_add_to_cart_params.is_cart && $button.parent().find('.added_to_cart').length === 0) {
            //     $button.after(' <a href="' + wc_add_to_cart_params.cart_url + '" class="added_to_cart wc-forward" title="' +
            //         wc_add_to_cart_params.i18n_view_cart + '">' + wc_add_to_cart_params.i18n_view_cart + '</a>');
            // }

            $(document.body).trigger('wc_cart_button_updated', [$button]);
        }
    };

    /**
     * Update fragments after add to cart events.
     */
    AddToCartHandler.prototype.updateFragments = function (e, fragments) {
        if (fragments) {
            $.each(fragments, function (key) {
                $(key)
                    .addClass('updating')
                    .fadeTo('400', '0.6')
                    .block({
                        message: null,
                        overlayCSS: {
                            opacity: 0.6
                        }
                    });
            });

            $.each(fragments, function (key, value) {
                $(key).replaceWith(value);
                $(key).stop(true).css('opacity', '1').unblock();
            });

            $(document.body).trigger('wc_fragments_loaded');
        }
    };

    /**
     * Init AddToCartHandler.
     */
    new AddToCartHandler();
});
