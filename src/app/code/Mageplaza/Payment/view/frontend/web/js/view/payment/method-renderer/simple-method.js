define(
    [
        'uiComponent',
        'jquery',
        'mage/url',
        'Magento_Checkout/js/view/payment/default',
    ],
    function (comp, $,url,Component) {
        'use strict';
        return Component.extend({
            defaults: {
                redirectAfterPlaceOrder: false,
                template: 'Mageplaza_Payment/payment/simple'
            },
            getMailingAddress: function () {
                return window.checkoutConfig.payment.checkmo.mailingAddress;
            },
            afterPlaceOrder: function () {
                window.location.replace(url.build('mageplaza/index/config/'));
            },
        });
    }
);
