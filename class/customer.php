<?php
class Customer {
	
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
	
	public function register($user_id,$c_fname,$c_lname,$c_address,$c_state_country,$c_postal_zip,$c_email_address,$c_phone,$c_account_password){

		$sqlQuery = "INSERT INTO users(user_id,first_name, last_name, address,state,zip_code,email,phone_number,password_hash) VALUE('".$user_id."','".$c_fname."','".$c_lname."','".$c_address."','".$c_state_country."','".$c_postal_zip."','".$c_email_address."','".$c_phone."','".$c_account_password."')";

      	$statement = $this->dbConnect->prepare($sqlQuery);

		$statement->execute();
	}

	public function emailExists($email){

			$sqlQuery = "SELECT user_id  FROM users WHERE email = '".$email."' ";

      	return  $this->getRecords($sqlQuery);
	}
	
	public function login($email,$password_hash){

			$sqlQuery = "SELECT user_id  FROM users WHERE email = '".$email."' AND password_hash = '".$password_hash."' ";

      	return  $this->getRecords($sqlQuery);
	}
	
	public function getCustomersDetails($email){

			$sqlQuery = "SELECT * FROM users WHERE email = '".$email."' ";

      	return  $this->getData($sqlQuery);
	}


}
?>