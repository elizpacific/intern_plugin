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
                issuers: [
                    {
                        id: 'ewl_Issuer_Simulation',
                        name: 'ewl Issuer Simulation',
                    },
                    {
                        id: 'TEST_iDEAL_issuer',
                        name: 'TEST iDEAL issuer',
                    }
                ],
                selectedIssuer: '',
                tracks: {
                    selectedIssuer: true
                },
                listens: {
                    selectedIssuer: 'onIssuerChange'
                },
                redirectAfterPlaceOrder: false,
                template: 'Mageplaza_Payment/payment/simple'
            },
            getMailingAddress: function () {
                return window.checkoutConfig.payment.checkmo.mailingAddress;
            },
            afterPlaceOrder: function () {
                window.location.replace(url.build('mageplaza/index/config/'));
            },

            onIssuerChange(issuer) {
                console.log(issuer)
            }
        });
    }
);
