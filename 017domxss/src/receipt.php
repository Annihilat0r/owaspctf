<!-- Esta página es el return URL de paypal a donde se redigirán los usuarios una vez hagan su compra -->
<?php
$pageTitle = "Thank you for your order!";
$section = "none";
include("inc/header.php"); ?>

	<div class="section page">

		<div class="wrapper">

			<h1>Thank You!</h1>

			<p>Thank you for your payment. Your transaction has been completed, and a receipt for your purchase has been emailed to you. You may log into your account at <a href="http://www.paypal.com/us">www.paypal.com/us</a> to view details of this transaction.</p>

			<p>Need another shirt already? Visit the <a href="shirts.php">Shirts Listing</a> page again.</p>

		</div>

	</div>

<?php include("inc/footer.php"); ?>