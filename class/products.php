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
	
	private function executeAction($sqlQuery, $params = []) {
        $statement = $this->dbConnect->prepare($sqlQuery);
        try {
            $statement->execute($params);
            return $statement->rowCount();
        } catch (PDOException $e) {
            // Optionally log this error to a file or a logging system
            die('Database error: ' . $e->getMessage());
        }
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
							categories.name,
							products.created_at,
						   images.img_url
								FROM products
								JOIN images
								ON images.product_id = products.product_id
								JOIN categories
								ON categories.category_id = products.category_id";

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

			$sqlQuery = "SELECT products.product_id,products.name,products.product_price,images.img_url,orders.order_date,orders.cost_total,order_details.quantity,order_details.order_details_id,orders.order_date FROM products JOIN images ON images.product_id = products.product_id JOIN order_details ON order_details.product_id = products.product_id JOIN orders ON  order_details.order_id = orders.order_id WHERE orders.user_id = '".$customer_id."' ";

      	return  $this->getData($sqlQuery);
	}
	
	public function getOders(){

			$sqlQuery = "SELECT products.product_id,products.name,products.product_price,images.img_url,orders.order_date,orders.cost_total,order_details.quantity,order_details.order_details_id,orders.order_date FROM products JOIN images ON images.product_id = products.product_id JOIN order_details ON order_details.product_id = products.product_id JOIN orders ON  order_details.order_id = orders.order_id ORDER BY orders.order_date DESC ";

      	return  $this->getData($sqlQuery);
	}
	
	
	public function addProduct($product_id, $business_id, $category_id, $product_name, $product_price, $description) {
		
		
		$sqlQuery = "INSERT INTO products(product_id , name, description, product_price, business_id , category_id ) VALUE(?,?,?,?,?,?)";

      	$this->executeAction($sqlQuery, [$product_id, $product_name, $description, $product_price, $business_id , $category_id ]);
		
	}
	
	public function reviewProduct($product_id, $user_id, $rate, $comment){
	
		$sqlQuery = "INSERT INTO reviews(user_id, product_id, rating, comment) VALUE(?,?,?,?)";

      	$this->executeAction($sqlQuery, [$user_id, $product_id, $rate, $comment]);
		
	}	
		
		
	public function addImage($product_id, $path_filename_ext) {
		
		
		$sqlQuery = "INSERT INTO images(product_id , img_ur ) VALUE(?,?)";

      	$this->executeAction($sqlQuery, [$product_id, $path_filename_ext ]);
		
	}	
	
	
	public function removeProductImage($product_id){
		
		// Insert into the database
		$sqlQuery = "DELETE FROM images WHERE product_id = ?";
    
		$this->executeAction($sqlQuery, [$product_id]);
	
	}
	
	public function removeProduct($product_id){
		
		// Insert into the database
		$sqlQuery = "DELETE FROM products WHERE product_id = ?";
    
		$this->executeAction($sqlQuery, [$product_id]);
	
	}


	public function checkIfReviewed($product_id,$user_id){

			$sqlQuery = "SELECT review_id FROM reviews WHERE user_id = '".$user_id."' AND product_id = '".$product_id."'";

      	return  $this->getRecords($sqlQuery);
	}
	
	public function getRatings($product_id){

			$sqlQuery = "SELECT rating, comment, created_at FROM reviews WHERE product_id = '".$product_id."' GROUP BY product_id";

      	return  $this->getData($sqlQuery);
	}
}
?>