<?php

class Users{
 
 private $db;

 public function __construct($database){
  
   $this->db=$database;

}

public function checkrollnofunc($rollno)
{	
	$query = $this->db->prepare("SELECT * from register where Roll_no = '$rollno'");
	try{
		
		$query->execute();
		$data = $query->fetchAll();
		$row_count = count($data);
		//$stored_accesskey = $data['AccessKey'];
		//$id = $data['Id'];
		echo $row_count;
		if($row_count)
		return 1;
		else
		return 0;
		}catch(PDOException $e){
 
		die($e->getMessage());
	}
}
public function getdevcount($rollno)
{	
	$query = $this->db->prepare("SELECT devcount from register where Roll_no = '$rollno'");
	try{
		
		$query->execute();
		$data = $query->fetch();
		//$stored_accesskey = $data['AccessKey'];
		//$id = $data['Id'];
		return $data;
		}catch(PDOException $e){
 
		die($e->getMessage());
	}
}
public function insertnewrecord($rollno,$gcmid,$adid,$devcount,$active,$path)
{	
	$query = $this->db->prepare(
		"INSERT INTO `register`(`active_id`, `Gcm_id`, `Roll_no`, `Ad_id`, `Timestamp`, `devcount`, `path`) VALUES ('$active','$gcmid', '$rollno', '$adid', 'now()','$devcount', '$path');"
	);
	try{
		
		$query->execute();
		//$data = $query->fetch();
		//$stored_accesskey = $data['AccessKey'];
		//$id = $data['Id'];
		return $query;
		}catch(PDOException $e){
 
		die($e->getMessage());
	}
}

public function getid($rollno,$adid,$gcmid)
{	
	$query = $this->db->prepare("SELECT Id from register where Roll_no = '$rollno' && Ad_id = '$adid' && Gcm_id = '$gcmid'");
	try{
		
		$query->execute();
		//$data = $query->fetch();
		//$stored_accesskey = $data['AccessKey'];
		//$id = $data['Id'];
		$data = $query->fetch();
		return $data;
		}catch(PDOException $e){
 
		die($e->getMessage());
	}
}
public function checkadidfunc($rollno,$adid)
{	
	$query = $this->db->prepare("SELECT * from register where Roll_no = '$rollno' && Ad_id = '$adid'");
	try{
		
		$query->execute();
		//$data = $query->fetch();
		//$stored_accesskey = $data['AccessKey'];
		//$id = $data['Id'];
		if($query)
			return 1;
		else
			return 0;
		}catch(PDOException $e){
 
		die($e->getMessage());
	}
}
public function checkgcmidfunc($rollno,$gcmid,$adid)
{	
	$query = $this->db->prepare("SELECT * from register where Roll_no = '$rollno' && Ad_id = '$adid' && Gcm_id = '$gcmid'");
	try{
		
		$query->execute();
		//$data = $query->fetch();
		//$stored_accesskey = $data['AccessKey'];
		//$id = $data['Id'];
		if($query)
			return 1;
		else
			return 0;
		}catch(PDOException $e){
 
		die($e->getMessage());
	}
}

public function updategcmidfunc($rollno , $gcmid ,$adid)
{
	$query = $this->db->prepare("UPDATE `register` SET `Gcm_id`='$gcmid' WHERE `Roll_no`='$rollno' && `Ad_id`='$adid'");
	try{
		return $query->execute();
	}catch(PDOException $e){
		die($e->getMessage());
		}
}


}
?>
