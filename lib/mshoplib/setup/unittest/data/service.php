<?php
/**
 * @copyright Copyright (c) Metaways Infosystems GmbH, 2012
 * @license LGPLv3, http://www.arcavias.com/en/license
 */

return array (
	'service/type' => array (
		'service/payment' => array(
			'domain' => 'service',
			'code' => 'payment',
			'label' => 'Payment',
			'status' => 1
		),
		'service/delivery' => array(
			'domain' => 'service',
			'code' => 'delivery',
			'label' => 'Delivery',
			'status' => 1
		),
	),

	'service' => array (
		'service/delivery/unitcode' => array (
			'pos' => 0,
			'typeid' => 'service/delivery',
			'code' => 'unitcode',
			'label' => 'unitlabel',
			'provider' => 'Default',
			'config' => array(
				'url' => 'deliveryurl'
			),
			'status' => 1
		),
		'service/payment/unitcode' => array (
			'pos' => 0,
			'typeid' => 'service/payment',
			'code' => 'unitpaymentcode',
			'label' => 'unitpaymentlabel',
			'provider' => 'PrePay',
			'config' => array(
				'payment.url-success' => 'paymenturl'
			),
			'status' => 1
		),
		'service/payment/directdebit' => array (
			'pos' => 1,
			'typeid' => 'service/payment',
			'code' => 'directdebit-test',
			'label' => 'direct debit label',
			'provider' => 'DirectDebit',
			'config' => array(),
			'status' => 1
		),
		'service/payment/paypalexpress' => array (
			'pos' => 2,
			'typeid' => 'service/payment',
			'code' => 'paypalexpress',
			'label' => 'PayPalExpress',
			'provider' => 'PayPalExpress',
			'config' => array(
				'ApiUsername' => 'sellerde_api1.metaways.de',
				'ApiPassword' => '1370351234',
				'ApiSignature' => 'AAZZBfWatx5wyxGsFzOqsM--jPYmApZPsklH4pTAnza8AaIJIyhUd3t.',
				'CancelUrl' => 'http://cancelurl.com',
				'ReturnUrl' => 'http://returnurl.com/updatesync.php',
				'PaymentAction' => 'authorization',
				'PaypalUrl' => 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=',
				'ApiEndpoint' => 'https://api-3t.sandbox.paypal.com/nvp'
			),
			'status' => 1
		),
	)
);