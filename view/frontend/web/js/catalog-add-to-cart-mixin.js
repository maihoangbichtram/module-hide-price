/**
 * Copyright © Panca, Inc. All rights reserved.
 */
define([
    'underscore',
    'jquery',
], function (_, $) {
    'use strict';

    return function (widget) {

        $.widget('mage.catalogAddToCart', widget, {
            /** @inheritdoc */
            _create: function () {
                if (window.hideprice.hideAddToCart) {
                    $(this.options.addToCartButtonSelector).prop('disabled', true);
                } else {
                    this._super();
                }
            },
        });

        return $.mage.catalogAddToCart;
    };
});
