<?php
$id= $_POST["id"];
$OssnDatabase = new OssnDatabase;
$params['from'] = 'sar_usereducation';
$params['wheres'] = array(
		"id=$id"
);
$OssnDatabase->delete($params);
?>