<?php
class Image {
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
	
	public function selectImages(){

		
		$sqlQuery = "SELECT * FROM images";

      	return  $this->getData($sqlQuery);
	}	
	
	public function order($order_id,$order_date,$customer_id,$cost_total){

		$sqlQuery = "INSERT INTO orders(order_id, order_date, user_id, cost_total) VALUE('".$order_id."','".$order_date."','".$customer_id."','".$cost_total."')";

      	$statement = $this->dbConnect->prepare($sqlQuery);

		$statement->execute();
	}
	
	public function orderDetails($order_id,$quantity,$img_id){

		$sqlQuery = "INSERT INTO order_details(order_id, quantity, img_id) VALUE('".$order_id."','".$quantity."','".$img_id."')";

      	$statement = $this->dbConnect->prepare($sqlQuery);

		$statement->execute();
	}
	
	public function getOrderedProduct($customer_id){

			$sqlQuery = "SELECT images.img_id,images.img_name,images.img_price,images.img_url,orders.order_date,orders.cost_total FROM images JOIN order_details ON order_details.img_id = images.img_id JOIN  orders ON  order_details.order_id = orders.order_id WHERE orders.user_id = '".$customer_id."' ";

      	return  $this->getData($sqlQuery);
	}
	
	
	
}
?>