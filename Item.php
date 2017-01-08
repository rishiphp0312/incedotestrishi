<?php # Item.php

class Item {
	
	// Item attributes are all protected:
	protected $code;
	protected $name;
	protected $unitprice;
	protected $noOfItemsPacket;
	protected $packetPrice;
	
	// Constructor populates the attributes:
	public function __construct($code, $name, $unitprice=0,$noOfItemsPacket=0,$packetPrice=0)	{
		$this->code = $code;
		$this->name = $name;
		$this->unitprice = $unitprice;
		$this->noOfItemsPacket = $noOfItemsPacket;
		$this->packetPrice = $packetPrice;
	}
	
	// Method that returns the Code:
	public function getCode()	{
		return $this->code;
	}

	// Method that returns the name:
	public function getName() {
		return $this->name;
	}

	// Method that returns the unit specifc  price and packet price :
	public function getPriceDetails() {
		return ['uprice'=>$this->unitprice,'packetPr'=>$this->packetPrice,'noOfItmsPck'=>$this->noOfItemsPacket];
	}

} // End of Item class.