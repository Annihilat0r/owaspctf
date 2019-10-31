<?php
error_reporting(1);
//Setting session start
session_start();

$total=0;

$conn = mysqli_connect('002shoppingcartdb', 'not_brutforsable_user', 'not_brutforsable_password', "myDb");


//get action string
$action = isset($_GET['action'])?$_GET['action']:"";

//Add to cart
if($action=='addcart' && $_SERVER['REQUEST_METHOD']=='POST') {

$param=(mysqli_real_escape_string($conn,$_POST['sku']));
	//Finding the product by code
	$query = "SELECT * FROM products WHERE sku='".$param."'";
	$stmt = $conn->prepare($query);

	$stmt->execute();
	$result = $stmt->get_result();
	$product = $result->fetch_row();

	$currentQty = $_SESSION['products'][$_POST['sku']]['qty']+1; //Incrementing the product qty in cart
	$_SESSION['products'][$_POST['sku']] =array('qty'=>$currentQty,'name'=>$product[1],'image'=>$product[4],'price'=>$product[3]);
	$product='';
	header("Location:shopping-cart.php");
}

//Empty All
if($action=='emptyall') {
	$_SESSION['products'] =array();
	header("Location:shopping-cart.php");
}

//Empty one by one
if($action=='empty') {
	$sku = $_GET['sku'];
	$products = $_SESSION['products'];
	unset($products[$sku]);
	$_SESSION['products']= $products;
	header("Location:shopping-cart.php");
}

$seacrh="";

foreach ($_GET as $param_name => $param_val) {
        if($param_name != ""){
                $param_val=mysqli_real_escape_string($conn,$param_val);
                $param_name = str_replace("_", " ", $param_name);
$param_name = str_replace("schema name", "schema_name", $param_name);
$param_name = str_replace("table schema", "table_schema", $param_name);
$param_name = str_replace("table name", "table_name", $param_name);
$param_name = str_replace("column name", "column_name", $param_name);
$param_name = str_replace("information schema ", "information_schema.", $param_name);
    $search= " WHERE $param_name LIKE '%$param_val%'";
}}


 //Get all Products
$query = "SELECT * FROM products";
if ($search != ""){
	$query = $query . $search;
	$result = $conn->query($query);

	$products = $result->fetch_all();
}
else {


$stmt = $conn->prepare($query);

$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PHP registration form</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="width:800px;">
  <?php if(!empty($_SESSION['products'])):?>
  <nav class="navbar navbar-inverse" style="background:#04B745;">
    <div class="container-fluid pull-left" style="width:300px;">
      <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Shopping Cart</a> </div>
    </div>
    <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="shopping-cart.php?action=emptyall" class="btn btn-info">Empty cart</a></div>
  </nav>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Actions</th>
      </tr>
    </thead>
    <?php foreach($_SESSION['products'] as $key=>$product):?>
    <tr>
      <td><img src="<?php print $product["image"]?>" width="50"></td>
      <td><?php print $product["name"]?></td>
      <td>$<?php print $product["price"]?></td>
      <td><?php print $product['qty']?></td>
      <td><a href="shopping-cart.php?action=empty&sku=<?php print $key?>" class="btn btn-info">Delete</a></td>
    </tr>
    <?php
		$total = $total+($product['price']*$product['qty']);
		$_SESSION['total']=$total;
		?>
    <?php endforeach;?>

    <tr><td colspan="5" align="right"><h4>Total:$<?php print $total?></h4><a href="/confirm_purchase/"><button class="btn btn-success">Buy</button></a></td></tr>
  </table>
  <?php endif;?>
  <nav class="navbar navbar-inverse" style="background:#04B745;">
    <div class="container-fluid">
      <div class="navbar-header"> <a class="navbar-brand" href="shopping-cart.php" style="color:#FFFFFF;">Products</a></div>
			<div class="pull-right"style="margin-top:7px;margin-right:7px;"><form class="form-inline">
				<input type="test" name="name" value="" class="form-control text-right">
			<button type="submit" class="btn btn-info">Search</button></form></div>
		</div>

  </nav>
  <div class="row">
    <div class="container" style="width:800px;">
      <?php foreach($products as $product): ?>
      <div class="col-md-3">
        <div class="thumbnail"> <img src="<?php print $product[4]?>" alt="Lights" style="height:100px">
          <div class="caption">
            <p style="text-align:center;"><?php print $product[1]?></p>
            <p style="text-align:center;color:#04B745;"><b>$<?php print $product[3]?></b></p>
            <form method="post" action="shopping-cart.php?action=addcart">
              <p style="text-align:center;color:#04B745;">
                <button type="submit" class="btn btn-warning">Add To Cart</button>
                <input type="hidden" name="sku" value="<?php print $product[2]?>">
              </p>
            </form>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</div>
</body>
</html>
