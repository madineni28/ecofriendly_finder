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
	
	public function selectBusinesses(){

		
		$sqlQuery = "SELECT businesses.business_id ,
							businesses.name,
							businesses.description,
							businesses.category_id,
							businesses.address,
							businesses.latitude,
							businesses.longitude
								FROM businesses ORDER BY businesses.name ASC";

      	return  $this->getData($sqlQuery);
	}	
	
	public function selectBusinessById($business_id){

		
		$sqlQuery = "SELECT businesses.business_id ,
							businesses.name,
							businesses.description,
							businesses.category_id,
							businesses.address,
							businesses.latitude,
							businesses.longitude FROM businesses WHERE business_id = '".$business_id."'";

      	return  $this->getData($sqlQuery);
	}	
	
	
	
}
?>