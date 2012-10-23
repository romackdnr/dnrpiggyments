<?
if(isset($_SESSION['client_id'])) {
	$client_id = $_SESSION['client_id'];
} else {
	$client_id = session_id();
}

//delete the shopping cart
if(isset($_REQUEST['delete']))
{
	$delete = $_REQUEST['delete'];
	Tempcart::deleteTempcart($delete);
}

if(isset($_POST['update']))
{
	if(isset($_POST['qty']))
	{
		foreach($_POST['qty'] as $qty)
		{
			if($qty == 0){$qty=1;}
			list ($key,$cartid) = each ($_POST['cartId']);
			Tempcart::updateTempcart($qty,$cartid);
		}
	}
}

if(isset($_POST['continue']))
{
	$links = $ROOT_URL . 'products-all.html';
	header("Location: $links");
	exit();
}

if(isset($_POST['checkout']))
{
	$links = $ROOT_URL . 'login.html';
	header("Location: $links");
	exit();
}

if(isset($_REQUEST['id']))
{ //Add to cart from product category page
	$product_id = $_REQUEST['id'];
	$qty = 1;
	
	//get the products information
	$products = Products::findProducts($product_id);

	$condition = "fldTempCartClientID='$client_id' AND fldTempCartProductID='$product_id'";

	// if(Tempcart::countTempcartbyCondition($condition)==1) {
	// 	//update the quantiy of the products
	// 	$temp_cart = Tempcart::displayTempcart($condition);
	// 	$qty = $qty + $temp_cart->fldTempCartQuantity;
	// 	Tempcart::updateTempcart($qty,$temp_cart->fldTempCartID);
	// } else {			
		//save the products to tempporary cart
		$_POST = sanitize($_POST);
		$tempcart = $_POST;
		settype($tempcart,'object');
		$tempcart->product_id  = $product_id;
		$tempcart->product_name = $products->fldProductsName;
		$tempcart->price = $products->fldProductsPrice;
		$tempcart->client_id = $client_id;		
		$tempcart->quantity = $qty;
		
		//$tempcart->options = $options;
		Tempcart::addTempcart($tempcart); 
	//  }	
			
}

if(isset($_POST['product_id']))
{ //Add to cart from product details page		
	$product_id = $_POST['product_id'];
	if($_POST['quantity'] >= 1) {
		$qty = $_POST['quantity'];
	} else {
		$qty = 1;
	}
	
	//get the products information
	$products = Products::findProducts($product_id);
	
	///code for options
	//$option =  var_dump($_POST['options']);
	if(isset($_POST['options']))
	{
		foreach($_POST['options'] as $option1)
		{
			$array = array_values($option1);
			$options .= $array[0] . ', ';
		}	
	}
	

	$options = substr($options,0,strlen($options)-2);
 	//end code for options	
		 
	$condition = "fldTempCartClientID='$client_id' AND fldTempCartProductID='$product_id'";
	
	// if(Tempcart::countTempcartbyCondition($condition)==1) {
	// 	//update the quantiy of the products
	// 	$temp_cart = Tempcart::displayTempcart($condition);
	// 	$qty = $qty + $temp_cart->fldTempCartQuantity;
	// 	Tempcart::updateTempcart($qty,$temp_cart->fldTempCartID);
	// } else {			
		//save the products to tempporary cart
		$_POST = sanitize($_POST);
		$tempcart = $_POST;
		settype($tempcart,'object');
		$tempcart->product_id  = $product_id;
		$tempcart->product_name = $products->fldProductsName;
		$tempcart->price = $products->fldProductsPrice;
		$tempcart->client_id = $client_id;
		$tempcart->options = $options;
		$tempcart->quantity = $qty;

		//$tempcart->options = $options;
		Tempcart::addTempcart($tempcart); 
	//  }	
}

?>