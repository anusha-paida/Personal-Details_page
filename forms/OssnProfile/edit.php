<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
// added by anusha

$user = $params['user'];
//var_dump($params['user']);
$OssnDatabase = new OssnDatabase;
/**
 * Create a table sar_userexperience
 *
 */
$params['table'] = 'sar_userexperience';
$params['names'] = array(
		'`id` int AUTO_INCREMENT NOT NULL',
		'`guid` bigint(20) NOT NULL',
		'`companyname` VARCHAR(100)',
		'`title` VARCHAR(100)',
		'`location` VARCHAR(100)',
		'`position` VARCHAR(100)',
		'`salary` int',
		'`description` VARCHAR(400)',
		'`startdate` DATE',
		'`enddate` DATE',
		'`private` int',
		'`presentexp` int',
		'PRIMARY KEY (`id`)',
		'FOREIGN KEY (`guid`) REFERENCES ossn_users(`guid`)'
);
$OssnDatabase->create($params);

/**
 * Create a table sar_usereducation
 *
 */
$params['table'] = 'sar_usereducation';
$params['names'] = array(
		'`id` int AUTO_INCREMENT NOT NULL',
		'`guid` bigint(20) NOT NULL',
		'`school` VARCHAR(100)',
		'`degree` VARCHAR(100)',
		'`studyfield` VARCHAR(100)',
		'`startdate` DATE',
		'`enddate` DATE',
		'`courses` VARCHAR(400)',
		'`associations` VARCHAR(400)',
		'`private` int',
		'`presentedu` int',
		'PRIMARY KEY (`id`)',
		'FOREIGN KEY (`guid`) REFERENCES ossn_users(`guid`)'
);
$OssnDatabase->create($params);
?>


<div>
	<input type="hidden" id="expcount" name="expcount"/>
    <input type="hidden" id="educount" name="educount"/>
    <input type="hidden" name="exp" id ="exp"/>
    <input type="hidden" name="edu" id ="edu"/>
	<label> <?php echo ossn_print('first:name'); ?> </label>
	<input type='text' name="firstname" value="<?php echo $user->first_name; ?>"/>
</div>
<div>
	<label> <?php echo ossn_print('last:name'); ?> </label>
	<input type='text' name="lastname" value="<?php echo $user->last_name; ?>"/>
</div>
<div>
	<label> <?php echo ossn_print('username'); ?>  </label>
	<input type='text' name="username" value="<?php echo $user->username; ?>" style="background:#E8E9EA;" readonly="readonly"/>
</div>
<div>
	<label> <?php echo ossn_print('email'); ?> </label>
	<input type='text' name="email" value="<?php echo $user->email; ?>"/>
</div>
<div>
	<label> <?php echo ossn_print('password'); ?>  </label>
	<input type='password' name="password" value=""/>
	
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
$userid = $user->guid;
$params['from'] = 'sar_userexperience';
$params['wheres'] = array(
		"guid = '{$userid}'"
	);
//var_dump($params['where']);

$data = $OssnDatabase->select($params, true);
foreach($data as $row){
	//ossn_trigger_message($row->id, 'success');?>
	
	<div class="panel panel-default" id="experience_display">
	<div>
        <input class="editable<?php echo $row->id?>" type="text" name="title" value="<?php echo $row->title; ?>" style="background:#f2f2f3; font-weight: bold" readonly="readonly" />
        <input class="editable<?php echo $row->id?>" type="text" id="title<?php echo $row->id?>" name="title" value="<?php echo $row->title; ?>" placeholder="Title" style="display:none"/>
    </div>
    <div class="panel-body">
    <div>
        <label class="editable<?php echo $row->id?>">Company:</label>
        <input class="editable<?php echo $row->id?>" type="text" name="company" value="<?php echo $row->companyname?>" readonly="readonly"/>
        <input class="editable<?php echo $row->id?>" type="text" id="company<?php echo $row->id?>" name="company" value="<?php echo $row->companyname?>" placeholder="Company Name" style="display:none"/>
    </div>
	<div>
        <label class="editable<?php echo $row->id?>">Location:</label>
        <input class="editable<?php echo $row->id?>" type="text" name="location" value="<?php echo $row->location?>" readonly="readonly"/>
        <input class="editable<?php echo $row->id?>" type="text" id="location<?php echo $row->id?>"name="location" value="<?php echo $row->location?>" placeholder="Company Location" style="display:none"/>
    </div>
    <div>
        <label class="editable<?php echo $row->id?>">Job Level:</label>
        <input class="editable<?php echo $row->id?>" type="text" name="position" value="<?php echo $row->position?>" readonly="readonly"/>
        <input class="editable<?php echo $row->id?>" type="text" id="position<?php echo $row->id?>"name="position" value="<?php echo $row->position?>" placeholder="Position" style="display:none"/>
    </div>
    <div>
        <label class="editable<?php echo $row->id?>">Duties/Description:</label>
        <input class="editable<?php echo $row->id?>" type="text" name="description" value="<?php echo $row->description?>" readonly="readonly"/>
        <input class="editable<?php echo $row->id?>" type="text" id="description<?php echo $row->id?>" name="description" value="<?php echo $row->description?>" placeholder="Job Duties" style="display:none"/>
    </div>
<?php if (($row-> presentexp) == 0){?>   
	<div>
	 <label class="editable<?php echo $row->id?>">Time period:</label>
        <input class="editable<?php echo $row->id?>" type="date" name="startdate" value="<?php echo $row->startdate?>" disabled/>
        <input class="editable<?php echo $row->id?>" type="date" name="enddate" value="<?php echo $row->enddate?>" disabled/>
        <input class="editable<?php echo $row->id?>" type="text" id="startdate<?php echo $row->id?>" name="startdate" value="<?php echo $row->startdate?>" placeholder="Start Date" style="display:none"/>
        <input class="editable<?php echo $row->id?>" type="text" id="enddate<?php echo $row->id?>" name="enddate" value="<?php echo $row->enddate?>" placeholder="End date" style="display:none"/>
    </div>
<?php }
else{?>
	<div>
	 <label class="editable<?php echo $row->id?>">Time period:</label>
        <input class="editable<?php echo $row->id?>" type="date" name="startdate" value="<?php echo $row->startdate?>" disabled/>
        <label class="editable<?php echo $row->id?>"> - Present</label>
        <input class="editable<?php echo $row->id?>" type="text" id="startdate<?php echo $row->id?>" name="startdate" value="<?php echo $row->startdate?>" placeholder="Start Date" style="display:none"/>
        <input class="editable<?php echo $row->id?>" type="text" id="enddate<?php echo $row->id?>" name="enddate" value="<?php echo $row->enddate?>" placeholder="End date" style="display:none"/>
        <input class="editable<?php echo $row->id?>" type="checkbox" id="presentexp<?php echo $row->id?>" name="presentexp" style="display:none" checked/>
        <label class="editable<?php echo $row->id?>" style="display:none">Present</label>
    </div>
    <?php }?>    
    <input type="button" name= "edit" class="btn btn-primary edit editable<?php echo $row->id?>" value="<?php echo "Edit"; ?>" onclick="setValueexp(<?php echo $row->id?>)"/>
    <input type="button" name= "cancel" class="btn btn-primary editable<?php echo $row->id?>" id = "cancel" value="<?php echo "Cancel"; ?>" style="display:none" onclick="cancelValueExp('<?php echo $row->id?>')" />
	 <input type="button" name= "save" class="btn btn-primary editable<?php echo $row->id?>" id = "save" value="<?php echo "Save"; ?>" style="display:none" onclick="saveValueExp('<?php echo $row->id?>')" />
    <input type="button" name= "delete" class="btn btn-primary editable<?php echo $row->id?>" value="<?php echo "Delete"; ?>" onclick="deleteValueExp('<?php echo $row->id?>')"/>
	</div>
	</div>
<?php }?>
<div>
<div id="experience_form" class="ossn-border" style="display:none">
<div class="form-group row">
	<label class="col-sm-2 form-control-label"><b>Company Name</b></label> 
	<div class="col-sm-10">
	<input type="text" name="companyname"></div>
</div>

<div class="form-group row">
	<label class="col-sm-2 form-control-label"><b> Job Title</b></label> 
	<div class="col-sm-10">
	<input type="text" name="title"></div>
</div>
<div class="form-group row">
	<label class="col-sm-2 form-control-label"><b>Location</b></label> 
	<div class="col-sm-10">
	<input  type="text" name="location" placeholder="<?php echo ossn_print('enter:location'); ?>" id="ossn-wall-location-input"></div>
</div>

<div class= "row ">
	<label class="col-sm-2 form-control-label"><b>Job Level</b></label> 
	<div class="col-sm-10"> <input  type="text" name="position"></div>
  </div>
  
<label><?php echo ossn_print('duties:description'); ?></label>
<textarea name="description"> </textarea>

<div class= "row ">
	<label class="col-sm-2 form-control-label"><b>Start Date</b></label> 
	<div class="col-sm-2"> <input  type="date" name="startdate"></div>
	<label class="col-sm-2 form-control-label"><b>End date</b></label> 
	<div class="col-sm-2"> <input  type="date" id = "enddate" name="enddate"></div>
	 <div class="col-sm-2"><label><input  id ="presentexp" type="checkbox" name="presentexp" onclick="presentCheckexp()"><b>Present</b></label></div>
  </div>
  <hr>
<div class= "row ">
<a class="col-sm-2 form-control-label" data-toggle="tooltip" title="not visible to anyone"><b>Salary</b></a> 
<div class="col-sm-4"> <input  type="text" name="salary"></div>
<div class="dropdown col-sm-3">
 <select name ="sal_type">
  <option value="hr">Hourly</option>
  <option value="ann">Annually</option>
</select>
  </div>
 
</div>
  <div class= "row ">
	<input type="radio" name="privacy1" value="0" checked="checked"/>
                <span><?php echo ossn_print('public'); ?></span>
                <span> </span>
	<input type="radio" name="privacy1" value="1"/>
                <span><?php echo ossn_print('close'); ?></span>
  </div>
  <p><b><font color="red" size = "2">*Salary fields are not visible to anyone.</font></b></p>
 <br> 

 <input type="button" class="btn btn-primary" value="<?php echo ossn_print('remove:experience'); ?>" id="remove_experience"/>
</div>
<input type="button" class="btn btn-primary-outline btn-lg btn-block" value="<?php echo ossn_print('add:experience'); ?>" id="add_experience"/>
</div>

<label> <?php echo ossn_print('education'); ?>  </label>
<?php 
//display education
$params['from'] = 'sar_usereducation';
$params['wheres'] = array(
		"guid='{$user->guid}'"
	);
$data = $OssnDatabase->select($params, true);
foreach($data as $row){
	//ossn_trigger_message($row->id, 'success');?>
	<div class="panel panel-default" id="experience_display">
	<div>
        <input class="editable<?php echo $row->id?>" type="text" name="school" value="<?php echo $row->school; ?>" style="background:#f2f2f3; font-weight: bold" readonly="readonly" />
        <input class="editable<?php echo $row->id?>" type="text" id="school<?php echo $row->id?>" name="school" value="<?php echo $row->school; ?>" placeholder="School" style="display:none"/>
    </div>
    <div class="panel-body">
    <div>
        <label class="editable<?php echo $row->id?>">Degree:</label>
        <input class="editable<?php echo $row->id?>" type="text" name="degree" value="<?php echo $row->degree?>" readonly="readonly"/>
        <input class="editable<?php echo $row->id?>" type="text" id="degree<?php echo $row->id?>" name="degree" value="<?php echo $row->degree?>" placeholder="Degree" style="display:none"/>
    </div>
    <div>
        <label class="editable<?php echo $row->id?>">Field:</label>
        <input class="editable<?php echo $row->id?>" type="text" name="studyfield" value="<?php echo $row->studyfield?>" readonly="readonly"/>
        <input class="editable<?php echo $row->id?>" type="text" id="studyfield<?php echo $row->id?>" name="studyfield" value="<?php echo $row->studyfield?>" placeholder="Field" style="display:none"/>
    </div>
    <div>
        <label class="editable<?php echo $row->id?>">Courses:</label>
        <input class="editable<?php echo $row->id?>" type="text" name="courses" value="<?php echo $row->courses?>" readonly="readonly"/>
        <input class="editable<?php echo $row->id?>" type="text" id="courses<?php echo $row->id?>" name="courses" value="<?php echo $row->courses?>" placeholder="Courses" style="display:none"/>
    </div>
    <div>
        <label class="editable<?php echo $row->id?>">Associations:</label>
        <input class="editable<?php echo $row->id?>" type="text" name="associations" value="<?php echo $row->associations?>" readonly="readonly"/>
        <input class="editable<?php echo $row->id?>" type="text" id="associations<?php echo $row->id?>" name="associations" value="<?php echo $row->associations?>" placeholder="Associations" style="display:none"/>
    </div>
<?php if (($row-> presentedu) == 0){?>   
	<div>
	 <label class="editable<?php echo $row->id?>">Time period:</label>
        <input class="editable<?php echo $row->id?>" type="date" name="startdate" value="<?php echo $row->startdate?>" disabled/>
        <input class="editable<?php echo $row->id?>" type="date" name="enddate" value="<?php echo $row->enddate?>" disabled/>
        <input class="editable<?php echo $row->id?>" type="text" id="startdate<?php echo $row->id?>" name="startdate" value="<?php echo $row->startdate?>" placeholder="Start Date" style="display:none"/>
        <input class="editable<?php echo $row->id?>" type="text" id="enddate<?php echo $row->id?>" name="enddate" value="<?php echo $row->enddate?>" placeholder="End date" style="display:none"/>
    </div>
<?php }
else{?>
	<div>
	 <label class="editable<?php echo $row->id?>">Time period:</label>
        <input class="editable<?php echo $row->id?>" type="date" name="startdate" value="<?php echo $row->startdate?>" disabled/>
        <label class="editable<?php echo $row->id?>"> - Present</label>
        <input class="editable<?php echo $row->id?>" type="text" id="startdate<?php echo $row->id?>" name="startdate" value="<?php echo $row->startdate?>" placeholder="Start Date" style="display:none"/>
        <input class="editable<?php echo $row->id?>" type="text" id="enddate<?php echo $row->id?>" name="enddate" value="<?php echo $row->enddate?>" placeholder="End date" style="display:none"/>
        <input class="editable<?php echo $row->id?>" type="checkbox" id="presentedu<?php echo $row->id?>" name="presentedu" style="display:none" checked/>
        <label class="editable<?php echo $row->id?>" style="display:none">Present</label>
    </div>
    <?php }?>
    <input type="button" name= "edit" class="btn btn-primary edit editable<?php echo $row->id?>" value="<?php echo "Edit"; ?>" onclick="setValueedu(<?php echo $row->id?>)"/>
    <input type="button" name= "cancel" class="btn btn-primary editable<?php echo $row->id?>" id = "cancel" value="<?php echo "Cancel"; ?>" style="display:none" onclick="cancelValueEdu('<?php echo $row->id?>')" />
	 <input type="button" name= "save" class="btn btn-primary editable<?php echo $row->id?>" id = "save" value="<?php echo "Save"; ?>" style="display:none" onclick="saveValueEdu('<?php echo $row->id?>')" />
    <input type="button" name= "delete" class="btn btn-primary editable<?php echo $row->id?>" value="<?php echo "Delete"; ?>" onclick="deleteValueEdu('<?php echo $row->id?>')"/>
	</div>
	</div>
<?php }?>
<div>
<div id="education_form" class="ossn-border" style="display:none">
<div class="form-group row">
	<label class="col-sm-2 form-control-label"><b>School</b></label> 
	<div class="col-sm-10">
	<input  type="text" name="school"></div>
</div>

<div class="form-group row">
	<label class="col-sm-2 form-control-label"><b>Degree/Certification</b></label> 
	<div class="col-sm-10">
	<input  type="text" name="degree"></div>
</div>

<div class="form-group row">
	<label class="col-sm-2 form-control-label"><b>Field of Study</b></label> 
	<div class="col-sm-10">
	<input  type="text" name="studyfield"></div>
</div>

 <div class= "row ">
	<label class="col-sm-2 form-control-label"><b>Start Date</b></label> 
	<div class="col-sm-2"> <input  type="date" name="startdate"></div>
	<label class="col-sm-2 form-control-label"><b>End date</b></label> 
	<div class="col-sm-2"> <input  type="date" name="enddate"></div>
	<div class="col-sm-2"><label><input  id ="presentedu" type="checkbox" name="presentedu" onclick="presentCheckedu()"><b>Present</b></label></div>
  </div>
  
<label><b>Courses Taken</b></label>
<textarea name="courses"> </textarea>

<div class="form-group row">
	<label class="col-sm-2 form-control-label"><b>Associations</b></label> 
	<div class="col-sm-10">
	<input  type="text" name="associations"></div>
</div>

 <div class= "row ">
	<input type="radio" name="privacy" value="0" checked="checked"/>
                <span><?php echo ossn_print('public'); ?></span>
                <span> </span>
	<input type="radio" name="privacy" value="1"/>
                <span><?php echo ossn_print('close'); ?></span>
  </div>
 <br> 

 <input type="button" class="btn btn-primary" value="<?php echo ossn_print('remove:education'); ?>" id="remove_education"/>
</div>
<input type="button" class="btn btn-primary-outline btn-lg btn-block" value="<?php echo ossn_print('add:education'); ?>" id="add_education"/>
</div>
<br>
<label><?php echo ossn_print('add:skills')?></label>
<br>
<?php echo ossn_print('job:general')?>
<textarea name="generalskills"><?php echo $user->generalskills; ?></textarea>

<?php echo ossn_print('job:computer')?>
<textarea name="computerskills"><?php echo $user->computerskills; ?></textarea>

<?php echo ossn_print('job:verbal')?>
<input type ="text" name="verbalskills" value = "<?php echo $user->verbalskills; ?>" placeholder = "Example: French, Spanish, English">

<input type="hidden" value="<?php echo $user->username; ?>" name="username"/>
<input type="submit" name= "submit" class="btn btn-primary" value="<?php echo ossn_print('save'); ?>"/>
