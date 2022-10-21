define(
    [
        'Magento_Checkout/js/view/payment/default'
    ],
    function (ko, $, $t, Component) {
        var checkoutConfig = window.checkoutConfig;
        'use strict';
        return Component.extend({
            defaults: {
                selectedIssuer: null,
                template: 'Mageplaza_Payment/payment/simple'
            },
            getMailingAddress: function () {
                return window.checkoutConfig.payment.checkmo.mailingAddress;
            },
            getStoreCard: function() {
                return  window.checkoutConfig.payment.checkmo.storedCards;
            },

            getIssuers: function () {
                var issuers = ['aa']
                // var issuers = new Map()
                // issuers.set('name', 'id')
                console.log(window.checkoutConfig.foo.bar);
                // console.log(checkoutConfig)
                issuers.unshift({"id":"SELECTYOURBANK", "name":'-- Select your bank'});
                return issuers;
            }
        });
    }
);
