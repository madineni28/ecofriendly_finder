<?php

class Admin {
	
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
	

	
	public function login($email,$password_hash){

			$sqlQuery = "SELECT admin_id  FROM admins WHERE email = '".$email."' AND password = '".$password_hash."' ";

      	return  $this->getRecords($sqlQuery);
	}

	
	public function getAdminDetails($email){

			$sqlQuery = "SELECT * FROM admins WHERE email = '".$email."' ";

      	return  $this->getData($sqlQuery);
	}


}
?>