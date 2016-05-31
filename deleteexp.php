<?php
$id= $_POST["id"];
$OssnDatabase = new OssnDatabase;
$params['from'] = 'sar_userexperience';
$params['wheres'] = array(
		"id=$id"
);
$OssnDatabase->delete($params);
?>