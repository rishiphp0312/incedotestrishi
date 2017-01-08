<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title>Testing the Shopping Cart</title>
</head>
<body>
<?php 
// This script uses the Terminal and Item classes.

// Create the scan object:
try {
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$costarr =[];
//terminal class is used to calculate the scanned items using item class also to get the item details 
$scanObj = new Terminal();
// Create some items using item class :
$itemA = new Item('ITM001', 'A', 2,4,7);//set price for items unit specific and and packet specific  
$itemB = new Item('ITM002', 'B', 12);
$itemC = new Item('ITM003', 'C', 1.25,6,6);
$itemD = new Item('ITM004', 'D', 0.15);
// Add the items to the cart:
if(isset($_POST['scan']) && isset($_POST['orderstring']) && !empty($_POST['orderstring'])){
	//echo strlen($_POST['orderstring']);
	for($i=0;$i<strlen($_POST['orderstring']);$i++){
		 $itemId = $_POST['orderstring'][$i];
		 
		if($itemId=='A')
			 	$scanObj->addItem($itemA);
		if($itemId=='B')
			 	$scanObj->addItem($itemB);
		if($itemId=='C')
			 	$scanObj->addItem($itemC);
		if($itemId=='D')
			 	$scanObj->addItem($itemD);


	}


if (!$scanObj->isEmpty()) {

	foreach ($scanObj as $arr) {

		// Get the item object:
		$item      = $arr['item'];
		$priceInfo = $item->getPriceDetails();
		//print_r($priceInfo );die;
		// Print the item:
		printf('<p><strong>%s</strong>:$%0.2f each. and packet price is $%0.2f and Units in packet %d<p>', $item->getName(), 
		$priceInfo['uprice'],$priceInfo['packetPr'],
		$priceInfo['noOfItmsPck']);
		$id = $item->getCode();
		$cntval= $scanObj->getItmQty($id);//total qty of each item 
		$itmSpecifictotalValue =0;
		echo 'Total Quantity is:'.$cntval;
		$getMod =0;
		$getpckcnt =0;//get total no of packets
		$costarr[]=$itmSpecifictotalValue =  
		$scanObj->calculateTotal($priceInfo['noOfItmsPck'],$cntval,$priceInfo['uprice'],$priceInfo['packetPr']);
		
		echo '<br/>';
	    echo '<br/>';
		echo  'Total cost is $'.$itmSpecifictotalValue;
		//$itmSpecifictotalValue++;
		
	echo '<br/>';
	echo '<br/>';

	} // End of foreach loop!
	echo '<br/>';
} // End of IF.

	}
} catch (Exception $e) {
// Handle the exception.
}
?>


<form method="post" action="">

<h1>Your answer can use the form below</h1>

		    <div>Enter the string like : CCCCCC or ABABAC
<input type="text" name="orderstring" id="orderstring" value="<?php echo (isset($_POST['orderstring']))?$_POST['orderstring']:'';?>" />
  <button type="submit" name="scan" id="scan">Scan the given list of Items  </button>

</div>
<?php 			
if(isset($_POST['orderstring']) && !empty($_POST['orderstring'])){
echo  '<b>Total Cost of order '.$_POST['orderstring'].' is $'.array_sum($costarr).'</b>';	
}
?>

</form>

</body>
</html>