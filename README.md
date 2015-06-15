[![Build Status](https://travis-ci.org/phpcommerce/payment-giropay.svg)](https://travis-ci.org/phpcommerce/payment-giropay) [![Coverage Status](https://coveralls.io/repos/phpcommerce/payment-giropay/badge.svg)](https://coveralls.io/r/phpcommerce/payment-giropay)

This plugin implements the Giropay Payment API for the PHPCommerce framework.

The following giropay services are supported:

  * giropay bankstatus
  * giropay checkout (transaction start, transaction status, transaction notifies)
  
The following giropay services are *NOT* implemented yet:

  * giropay AVS
  * eps
  * credit card
  * direct debit
  * PayPal
  * iDEAL

For more information about the api specification visit http://api.girocheckout.de/

## Configuration

In order to use this Bundle you need to define the following configuration in your parameters.yml

  * `phpcommerce.payment.gateway.giropay.configuration.merchantId`
  * `phpcommerce.payment.gateway.giropay.configuration.projectId`
  * `phpcommerce.payment.gateway.giropay.configuration.secret`


## Tests

There are live tests included in the test suites. They're simulating a browser and doing a full giropay checkout.
You might want to disable them during local development. Use the `--exclude-group liveTest` option to phpunit to do that.

