/**
 * Copyright © Panca, Inc. All rights reserved.
 */

var config = {
    config: {
        mixins: {
            'Magento_Catalog/js/catalog-add-to-cart': {
                'Panca_HidePrice/js/catalog-add-to-cart-mixin': true
            },
            'Magento_Catalog/js/validate-product': {
                'Panca_HidePrice/js/validate-product-mixin': true
            }
        }
    }
};
