<?php

$a = "106113404";
$c = substr($a,0,1);
$array_coll = array("1"=>"Btech",""=>"Mtech",""=>"Archi");
foreach($array_coll as $x => $x_val){
	if(strcmp($x,$c) == 0)
	{
		$GLOBALS['co'] = $x_val;
	}
}
echo $co;

?>