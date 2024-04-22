<?php
class Cart {
	
	private $dbConnect;

    public function __construct() {
        $this->dbConnect = new DBConnection();
        $this->dbConnect = $this->dbConnect->getConnection();
    }
	private function getData($sqlQuery) {
		
		$statement = $this->dbConnect->prepare($sqlQuery);
		
		$statement->execute();
	
		$result = $statement->fetchAll();
	
		
		$data= array();
		foreach($result as $row) {
			$data[]=$row;            
		}
		return $data;
	}
	
	private function getRecords($sqlQuery) {
		
		$statement = $this->dbConnect->prepare($sqlQuery);
		
		$statement->execute();
	
		$images = $statement->rowCount();
		
		return $images;
	}
	
	public function add_to_cart($session,$product_id,$qty){

		$sqlQuery = "INSERT INTO temp_cart(session, product_id, qty) VALUE('".$session."','".$product_id."','".$qty."')";

      	$statement = $this->dbConnect->prepare($sqlQuery);

		$statement->execute();
	}
	
	public function remove_from_cart($session,$product_id){

		$sqlQuery = "DELETE FROM temp_cart WHERE session = '".$session."' AND product_id = '".$product_id."'";

      	$statement = $this->dbConnect->prepare($sqlQuery);

		$statement->execute();
	}
	
	public function update_cart($session,$product_id,$qty){

		$sqlQuery = "UPDATE temp_cart SET qty='".$qty."' WHERE session = '".$session."' AND product_id = '".$product_id."'";

      	$statement = $this->dbConnect->prepare($sqlQuery);

		$statement->execute();
	}

	public function productExists($session,$product_id){

			$sqlQuery = "SELECT product_id FROM temp_cart WHERE session = '".$session."' AND product_id = '".$product_id."'";

      	return  $this->getRecords($sqlQuery);
	}

	public function productInCart($session){

			$sqlQuery = "SELECT product_id FROM temp_cart WHERE session = '".$session."' ";

      	return  $this->getRecords($sqlQuery);
	}	
	
	public function getProductInCart($session){

			$sqlQuery = "SELECT products.product_id,products.name,products.product_price,images.img_url,temp_cart.product_id,temp_cart.qty FROM products JOIN images ON products.product_id = images.product_id JOIN temp_cart ON temp_cart.product_id = images.product_id WHERE temp_cart.session = '".$session."' ";

      	return  $this->getData($sqlQuery);
	}
	
	public function subTotal($session){

			$sqlQuery = "SELECT SUM(products.product_price * temp_cart.qty) AS subtotal FROM products JOIN temp_cart ON temp_cart.product_id = products.product_id WHERE temp_cart.session = '".$session."' ";

      	return  $this->getData($sqlQuery);
	}
	
	public function emptyCart($session,$product_id){

		$sqlQuery = "DELETE FROM temp_cart WHERE session = '".$session."' AND product_id = '".$product_id."'";

      	$statement = $this->dbConnect->prepare($sqlQuery);

		$statement->execute();
	}
}
?>