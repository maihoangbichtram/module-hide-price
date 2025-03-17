/**
 * Copyright © Panca, Inc. All rights reserved.
 */
define([
    'underscore',
    'jquery',
], function (_, $) {
    'use strict';

    return function (widget) {

        $.widget('mage.productValidate', widget, {
            /** @inheritdoc */
            _create: function () {
                if (window.hideprice.hideAddToCart) {
                    this.element.validation({
                        radioCheckboxClosest: this.options.radioCheckboxClosest,
                    });
                    $(this.options.addToCartButtonSelector).attr('disabled', true);
                } else {
                    this._super();
                }
            }
        });

        return $.mage.productValidate;
    };
});
