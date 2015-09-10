<?php 
require('core/init.php');
$response = array();

if(isset($_POST['username']) && isset($_POST['gcmid']) && isset($_POST['ad_id']) && isset($_POST['action_id'])){
	$roll_no = $_POST['username'];
	$Gcm_id = $_POST['gcmid'];
	$Ad_id = $_POST['adid'];
	$actionid = $_POST['actionid'];

	$array_coll = array("1"=>"Btech","2"=>"Mtech","3"=>"Archi","4"=>"Mca","5"=>"IIM");
	$array_dept = array("06" => "Cse" ,"07" =>"ECE","08"=>"EEE","09"=>"MECH","10"=>"PROD");
	$college_ = substr($roll_no,0,1);
	$dept = substr($roll_no,1, 2);
	$year = substr($roll_no,4);
	foreach($array_coll as $x => $x_val){
		if(strcmp($x, $college_) == 0){
			$GLOBALS['coll_'] = $x_val;
		}
	}
	foreach($array_dept as $y=>$y_val){
		if(strcmp($y, $dept) == 0){
			$GLOBALS['dept_'] = $y_val;
		}
	}

	$path = $coll_."/".$dept_."/".$year;
	$checkrollno = $users->checkrollnofunc($roll_no);
	if(!($checkrollno)){
	$insertrow = $users->insertnewrecord($roll_no,$Gcm_id,$Ad_id,1,1,$path);
	$userid = $users->getid($roll_no,$Ad_id,$Gcm_id);
	if($insertrow){
		$response['status'] = "0";
		
		$response['userid'] = $userid; // have problem if there are many id for same rollno person then?
		echo json_encode($response);
	}

	}
	else {
		$userid = $users->getid($roll_no,$Ad_id,$Gcm_id);
		$devcount = $users->getdevcount($roll_no);
		$checkadid = $users->checkadidfunc($roll_no,$Ad_id);
		if($checkadid){
			$checkgcmid = $users->checkgcmidfunc($roll_no,$Gcm_id,$Ad_id);
			if($checkgcmid){
				$response['status'] = "3";
				$response['userid'] = $userid;
				echo json_encode($response);
			}
			else{ // its not same different gcmid
				$updategcmid = $users->updategcmidfunc($roll_no,$Gcm_id,$Ad_id);
				$response['status'] = "2";
				$response['userid'] = $userid;
				echo json_encode($response);
			}
		}
		else{ //if its not equal to Ad_id meaning different device
			$insertnew = $users->insertnewrecord($roll_no,$Gcm_id,$Ad_id,1,$devcount+1,$path);
			$newuserid = $users->getid($roll_no,$Gcm_id,$Ad_id);
			if($insertnew){
				$response['status'] = "1";
				$response['userid'] = $newuserid;
				echo json_encode($response);
			}
		}
	}
}
?>