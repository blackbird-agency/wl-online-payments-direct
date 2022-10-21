# Worldline Online Payments

The package includes the following payment methods:
- credit card
- hosted checkout
- redirect payment (single payment buttons)

Change log:

2.1.1
- Hide the checkbox "save card" for iFrame checkout (Credit Card payment method) for guests and when the vault is disabled
- Support version 4.3.3 of Worldline SDK
- PWA improvements and support
- Bug fixes and general code improvements

2.1.0
- New Redirect payments: integrate single payment buttons directly on Magento checkout
- Waiting page has been added after payment is done to correctly process webhooks and create the order
- Asyncronic order creation through get calls when webhooks suffer delay
- Refund flow is improved for multi-website instances
- Bancontact payment method implementation has been improved
- General improvements and bug fixes

2.0.0
- module segregation
- bug fix and general improvements

1.3.1
- graphQL bug fix

1.3.0
- credit card payment method improvements
- new flow for the refunds: pending, refunded statuses for the refund items
- support Sepa methods for the hosted checkout payment method
- bug fix and general improvements

1.2.0
- hosted checkout payment method improvements
- show Worldline information in order overview pages: frontend and backend
- add the Worldline request logs grid
- compatibility with Magento 2.3.7
- bug fix and general improvements

1.1.0
- PWA support
- log Worldline requests feature
- support of new version of the SDK
- compatibility with Magento 2.4.4
- bug fix

1.0.0
- Initial MVP version 
