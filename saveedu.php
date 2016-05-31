<?php
$school = $_POST["school"];
$degree = $_POST["degree"];
$studyfield = $_POST["studyfield"];
$startdate = $_POST["startdate"];
$enddate = $_POST["enddate"];
$courses = $_POST["courses"];
$associations = $_POST["associations"];
$id= $_POST["id"];
/*$presentedu= $_POST["presentedu"];
if($presentedu == 'on'){
	//ossn_trigger_message('1', 'success');
	$presentedu = 1;
	$enddate[$x] ="";
}else{
	$presentedu = 0;
}*/
$OssnDatabase = new OssnDatabase;
$params['table']  = 'sar_usereducation';
$params['names']  = array(
		'school',
		'degree',
		'studyfield',
		'startdate',
		'enddate',
		'courses',
		'associations'
);
$params['values'] = array(
		$school,
		$degree,
		$studyfield,
		$startdate,
		$enddate,
		$courses,
		$associations
		
);
$params['wheres'] = array(
		"id=$id"
);
$OssnDatabase->update($params); 

echo "Saved"
?>