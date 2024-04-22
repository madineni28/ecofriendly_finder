<?php
class Product {
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
	
		$products = $statement->rowCount();
		
		return $products;
	}
	
	public function selectProducts(){

		
		$sqlQuery = "SELECT products.product_id,
							products.name,
							products.description,
							products.product_price,
							products.business_id,
							products.category_id,
							products.created_at,
						   images.img_name,
						   images.img_price,
						   images.img_url
								FROM products
								JOIN images
								ON images.product_id = products.product_id";

      	return  $this->getData($sqlQuery);
	}

	public function selectProductsByBusinessID($business_id){

		
		$sqlQuery = "SELECT products.product_id,
							products.name,
							businesses.name,
							products.description,
							products.product_price,
							products.business_id,
							products.category_id,
							products.created_at,
						   images.img_name,
						   images.img_price,
						   images.img_url
								FROM products
								JOIN businesses
								ON businesses.business_id = products.business_id
								JOIN images
								ON images.product_id = products.product_id WHERE businesses.business_id = '".$business_id."'";

      	return  $this->getData($sqlQuery);
	}	
	
	public function order($order_id,$order_date,$customer_id,$cost_total){

		$sqlQuery = "INSERT INTO orders(order_id, order_date, user_id, cost_total) VALUE('".$order_id."','".$order_date."','".$customer_id."','".$cost_total."')";

      	$statement = $this->dbConnect->prepare($sqlQuery);

		$statement->execute();
	}
	
	public function orderDetails($order_id,$quantity,$product_id){

		$sqlQuery = "INSERT INTO order_details(order_id, quantity, product_id) VALUE('".$order_id."','".$quantity."','".$product_id."')";

      	$statement = $this->dbConnect->prepare($sqlQuery);

		$statement->execute();
	}
	
	public function getOrderedProduct($customer_id){

			$sqlQuery = "SELECT products.product_id,products.name,products.product_price,images.img_url,orders.order_date,orders.cost_total FROM products JOIN images ON images.product_id = products.product_id  JOIN order_details ON order_details.product_id = products.product_id JOIN  orders ON  order_details.order_id = orders.order_id WHERE orders.user_id = '".$customer_id."' ";

      	return  $this->getData($sqlQuery);
	}
	
	
	
}
?>