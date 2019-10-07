<?php include("inc/products.php"); ?><?php
$pageTitle = "Mike's Full Catalog of Shirts";
$section = "shirts";
include('inc/header.php');
?>

		<div class="section shirts page">

			<div class="wrapper">

				<h1>Search results for <span id="current_search"></span></h1>

				<ul class="products">
					<?php foreach($products as $product_id => $product) {

						if(stripos($product["name"],$_GET["searchinput"])!== false){
							echo get_list_view_html($product_id,$product);
						}}
					?>
				</ul>

			</div>

		</div>
		<script>
		$(document).ready(function() {
			$(".ui-loader").hide();
		});

		function getURLParameter(sParam) {
		    var sPageURL = window.location.search.substring(1);
		    var sURLVariables = sPageURL.split('&');
		    for (var i = 0; i < sURLVariables.length; ++i) {
		        var sParameterName = sURLVariables[i].split('=');
		        if (sParameterName[0] == sParam) {
		            return decodeURIComponent(sParameterName[1].replace(/\+/g,' '));
		        }
		    }
		    return null;
		};

			var searchinput = getURLParameter('searchinput');
			// If we have search query
			if (searchinput != null && searchinput != "") {

				// You shall not pass
				var clean = DOMPurify.sanitize(searchinput);
				$("#current_search").html(clean);
				//alert(searchinput);
				//alert(clean);

			}
		</script>
<?php include('inc/footer.php') ?>
