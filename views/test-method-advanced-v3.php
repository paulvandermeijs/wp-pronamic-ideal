<h3>
	<?php _e( 'Retrieve Issuers Lists', 'pronamic_ideal' ); ?>
</h3>

<?php

/*
 * 
 * openssl genrsa -aes128 -out test.txt 2048
 * 
 * openssl genrsa -aes128 -out priv.pem -passout pass:testabcd 2048
 * openssl req -x509 -new -key priv.pem -passin pass:testabcd -days 3650 -out cert.cer
 * 
 */

include dirname( __FILE__ ) . '/../includes/xmlseclibs/xmlseclibs.php';

$client = new Pronamic_Gateways_IDealAdvancedV3_Client();
$client->set_acquirer_url( $configuration->getPaymentServerUrl() );
$client->merchant_id          = $configuration->getMerchantId();
$client->sub_id               = $configuration->getSubId();
$client->private_key          = $configuration->privateKey;
$client->private_key_password = $configuration->privateKeyPassword;
$client->private_certificate  = $configuration->privateCertificate;

$directory = $client->get_directory();

$gateway = new Pronamic_Gateways_IDealAdvancedV3_Gateway( $configuration, null );

echo $gateway->get_html_fields();

?>
<pre><?php var_dump( $directory ); ?></pre>
<?php 

$transaction = new Pronamic_Gateways_IDealAdvancedV3_Transaction();
$transaction->setPurchaseId( 'test' );
$transaction->setAmount( 99 );
$transaction->setCurrency( 'EUR' );
$transaction->setExpirationPeriod( 'PT3M30S' );
$transaction->setLanguage( 'nl' );
$transaction->setDescription( 'description' );
$transaction->setEntranceCode( 'bestelling' . time() );

$result = $client->create_transaction( $transaction, 'NLINGB2U152' );

$error = $client->get_error();

if ( $error !== null ) {
	$error = $client->get_error();

	var_dump( $error );
}

?>
<pre><?php var_dump( $result ); ?></pre>