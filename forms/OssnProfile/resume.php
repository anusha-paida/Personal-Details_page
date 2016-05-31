<?php
$user = $params['user'];
$OssnDatabase = new OssnDatabase;
?>
<div>
<label> <?php echo ossn_print('first:name'); ?> </label>
 <input type='text' name="firstname" value="<?php echo $user->first_name; ?>" readonly="readonly"/>
   </div>
   <div>
       <label> <?php echo ossn_print('last:name'); ?> </label>
       <input type='text' name="lastname" value="<?php echo $user->last_name; ?>" readonly="readonly"/>
   </div>
   <div>
       <label> <?php echo ossn_print('email'); ?> </label>
       <input type='text' name="email" value="<?php echo $user->email; ?>" readonly="readonly"/>
   </div>
   <?php
$fields = ossn_prepare_user_fields($user);
if($fields){
			$vars	= array();
			$vars['items'] = $fields;
			$vars['label'] = true;
			echo ossn_plugin_view('user/fields/item', $vars);
}
?>
<div>
<label><?php echo ossn_print('language');?></label>
<?php
	//profile edit form shows wrong default language #546
	$userlanguage = ossn_site_settings('language');
	echo ossn_plugin_view('input/dropdown', array(
				'name' => 'language',
				'value' => $userlanguage,
				'options' => ossn_get_installed_translations(false),
	));
?>
</div>
   <label> <?php echo ossn_print('experience'); ?>  </label>
   <?php 
   //display experience
   $params['from'] = 'sar_userexperience';
   $params['wheres'] = array(
           "guid='{$user->guid}'"
       );
   $data = $OssnDatabase->select($params, true);
   if($data){
   foreach($data as $row){
   	if ($row->private == 0){
       //ossn_trigger_message($row->id, 'success');?>
       <div class="panel panel-default">
       <div class="panel-heading"><b><?php echo $row->title?></b></div>
        <div class="panel-body"><div><b>Company:</b>&nbsp<?php echo $row->companyname?></div>
       <div><b>Location:</b>&nbsp<?php echo $row->location?></div>
       <div><?php echo $row->startdate?> <b>to</b> <?php echo $row->enddate?></div>
       <div><b>Job Level:</b>&nbsp<?php echo $row->position?></div>
       <div><b>Duties/Description:</b>&nbsp<?php echo $row->description?></div>
       </div>
       </div>
   <?php }}}
   else 
   { ?>
   <div class="panel panel-default">
   <div class="panel-body"><?php echo "Please update Experience."?></div>
   </div>
   <?php } ?>
   <label> <?php echo ossn_print('education'); ?>  </label>
   <?php 
   //display education
   $params['from'] = 'sar_usereducation';
   $params['wheres'] = array(
           "guid='{$user->guid}'"
       );
   $data = $OssnDatabase->select($params, true);
   if($data){
   foreach($data as $row){
   	if ($row->private == 0){
       //ossn_trigger_message($row->id, 'success');?>
       <div class="panel panel-default">
       <div class="panel-heading"><b><?php echo $row->school?></b></div>
        <div class="panel-body"><div><b>Degree:</b>&nbsp<?php echo $row->degree?></div>
       <div><b>Field:</b>&nbsp<?php echo $row->studyfield?></div>
       <div><?php echo $row->startdate?> <b>to</b> <?php echo $row->enddate?></div>
       <div><b>Courses:</b>&nbsp<?php echo $row->courses?></div>
       <div><b>Associations:</b>&nbsp<?php echo $row->associations?></div>
       </div>
       </div>
   <?php }}}
   else 
   { ?>
   <div class="panel panel-default">
   <div class="panel-body"><?php echo "Please update Education."?></div>
   </div>
   <?php } ?>
<label><?php echo ossn_print('add:skills')?></label>
<br>
<?php echo ossn_print('job:general')?>
<textarea name="generalskills"><?php echo $user->generalskills; ?></textarea>

<?php echo ossn_print('job:computer')?>
<textarea name="computerskills"><?php echo $user->computerskills; ?></textarea>

<?php echo ossn_print('job:verbal')?>
<input type ="text" name="verbalskills" value = "<?php echo $user->verbalskills; ?>" placeholder = "Example: French, Spanish, English">