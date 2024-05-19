<?php
class Business {
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
	
	public function selectBusinesses(){

		
		$sqlQuery = "SELECT businesses.business_id ,
							businesses.name,
							businesses.description,
							businesses.address,
							businesses.latitude,
							businesses.longitude,
							businesses.image_url
								FROM businesses ORDER BY businesses.name ASC";

      	return  $this->getData($sqlQuery);
	}	
	
	public function selectBusinessById($business_id){

		
		$sqlQuery = "SELECT businesses.business_id ,
							businesses.name,
							businesses.description,
							businesses.address,
							businesses.latitude,
							businesses.longitude FROM businesses WHERE business_id = '".$business_id."'";

      	return  $this->getData($sqlQuery);
	}	
	
	public function addBusiness($business_name, $addresss, $business_latitude, $business_longitude, $description, $path_filename_ext) {
		
		
		$sqlQuery = "INSERT INTO businesses(name, description, image_url, address, latitude, longitude) VALUE(?,?,?,?,?,?)";

      	$this->executeAction($sqlQuery, [$business_name, $description, $path_filename_ext, $addresss, $business_latitude, $business_longitude]);
		
	}
	
	
	public function getCategory(){

		
		$sqlQuery = "SELECT name,category_id
								FROM categories ORDER BY name ASC";

      	return  $this->getData($sqlQuery);
	}
	
	
	public function removeProductsByBusinessId($business_id){
		
		// Insert into the database
		$sqlQuery = "DELETE FROM products WHERE business_id = ?";
    
		$this->executeAction($sqlQuery, [$business_id]);
	
	}
	
	public function removeBusiness($business_id){
		
		// Insert into the database
		$sqlQuery = "DELETE FROM businesses WHERE business_id = ?";
    
		$this->executeAction($sqlQuery, [$business_id]);
	
	}
}
?>