<style>
.button {
    background-color: #00ccff;
    border: none;
    color: white;
    padding: 5px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 0px 10px;
    cursor: pointer;
}
</style>
<?php
$user = $params['user'];
$OssnDatabase = new OssnDatabase;
$params['table'] = 'sar_mastermatch';
$params['names'] = array(
		'`id` int AUTO_INCREMENT NOT NULL',
		'`jobid` bigint(20) NOT NULL',
		'`groupid` bigint(20) NOT NULL',
		'`userid` bigint(20) NOT NULL',
		'`status` VARCHAR(100)',
		'`applied_date` DATE',
		'PRIMARY KEY (`id`)',
		'FOREIGN KEY (`jobid`) REFERENCES sarjobpost(`jobid`)',
		'FOREIGN KEY (`groupid`) REFERENCES ossn_object(`guid`)',
		'FOREIGN KEY (`userid`) REFERENCES ossn_users(`guid`)'
);
$OssnDatabase->create($params);
//display jobs connected
$params['from'] = 'sar_mastermatch';
$params['wheres'] = array(
		"userid='{$user->guid}'"
);
$data = $OssnDatabase->select($params, true);

if($data) {

		foreach($data as $row) {
				$user = ossn_user_by_guid($row->userid);
				$group = ossn_get_group_by_guid($row->groupid);
				$job = $group->sar_getJob($row->groupid,$row->jobid);
				//var_dump($job);
				$jobtitle = $job[0][2];
				$grouptitle = $group->title;
				$joblocation = $job[0][8];
				$applied_date = $row->applied_date;
				$status = $row->status;?>
				<div class= "row">
				<div class="col-sm-8">
					<label>Company:</label><?php echo $grouptitle;?><br>
					<label>Job Title:</label><?php echo $jobtitle;?><br>
					<label>Location:</label><?php $joblocation;?><br>
					<label>Applied Date:</label><?php echo $applied_date;?><br></div>
					<div class="col-sm-4">
       				<input type="button" class="button" value="<?php echo $status?>" disabled>
       				</div>
 				</div>
				<hr>	   
		<?php }
} else {
		ossn_print('no:jobmatch');
}
?>
