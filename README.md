This plugin implements the Giropay Payment API for the Pegasus Commerce framework.

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

## Tests

There are live tests included in the test suites. They're simulating a browser and doing a full giropay checkout.
You might want to disable them during local development. Use the `--exclude-group liveTest` option to phpunit to do that.

