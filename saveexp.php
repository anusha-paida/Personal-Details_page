<?php
$companyname = $_POST["companyname"];
$title = $_POST["title"];
$location = $_POST["location"];
$startdate = $_POST["startdate"];
$enddate = $_POST["enddate"];
$position = $_POST["position"];
$description = $_POST["description"];
$id= $_POST["id"];

/*if($presentexp == 'on'){
	//ossn_trigger_message('1', 'success');
	$presentexp = 1;
	$enddate[$x] ="";
}else{
	$presentexp = 0;
}*/
$OssnDatabase = new OssnDatabase;
$params['table']  = 'sar_userexperience';
$params['names']  = array(
		'companyname',
		'title',
		'location',
		'startdate',
		'enddate',
		'position',
		'description'

);
$params['values'] = array(
		$companyname,
		$title,
		$location,
		$startdate,
		$enddate,
		$position,
		$description

		
);
$params['wheres'] = array(
		"id=$id"
);
$OssnDatabase->update($params); 

echo "Saved"
?>