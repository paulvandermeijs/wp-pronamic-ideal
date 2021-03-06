<?php 

$gateway = new Pronamic_Gateways_TargetPay_Gateway( $configuration );

?>

<h3>
	<?php _e( 'Test', 'pronamic_ideal' ); ?>
</h3>

<form method="post" action="" target="_blank">
	<?php wp_nonce_field( 'test_ideal_targetpay', 'pronamic_ideal_nonce' ); ?>

	<div style="margin: 6px 0 4px;">
		<?php echo $gateway->get_input_html(); ?>
	</div>

	<?php 

	if ( $gateway->has_error() ) {
		$pronamic_ideal_errors[] = $gateway->get_error();
	}

	include 'errors.php';

	?>

	<p>
		<label for="test_amount">&euro;</label>
		<input name="test_amount" id="test_amount" value="" class="small-text" type="text" />

		<?php
	
		$name = sprintf( __( 'Test', 'pronamic_ideal' ) );

		submit_button( $name, 'secondary', 'test_ideal_targetpay', false ); 

		?>
	</p>
</form>