<?php
	// check this file's MD5 to make sure it wasn't called before
	$prevMD5=@implode('', @file(dirname(__FILE__).'/setup.md5'));
	$thisMD5=md5(@implode('', @file("./updateDB.php")));
	if($thisMD5==$prevMD5){
		$setupAlreadyRun=true;
	}else{
		// set up tables
		if(!isset($silent)){
			$silent=true;
		}

		// set up tables
		setupTable('courses', "create table if not exists `courses` (   `course_id` INT not null auto_increment , primary key (`course_id`), `course_name` INT unsigned , `description` INT unsigned , `instructor_id` INT , `lab_id` INT , `start_date` DATE , `end_date` DATE , `start_time` TIME , `end_time` TIME , `mon` CHAR(3) , `tue` CHAR(3) , `wed` CHAR(3) , `thu` CHAR(3) , `fri` CHAR(3) , `sat` CHAR(3) , `sun` CHAR(3) , `fees` DECIMAL(9,2) ) CHARSET utf8", $silent);
		setupIndexes('courses', array('course_name','instructor_id','lab_id'));
		setupTable('enrollment', "create table if not exists `enrollment` (   `rec_id` INT not null auto_increment , primary key (`rec_id`), `stud_id` INT , `course_id` INT , `score` VARCHAR(10) , `notes` TEXT , `certificate_notes` TEXT ) CHARSET utf8", $silent);
		setupIndexes('enrollment', array('stud_id','course_id'));
		setupTable('attendance', "create table if not exists `attendance` (   `attendance_id` INT unsigned not null auto_increment , primary key (`attendance_id`), `student_course` INT , `date` DATE , `attended` CHAR(3) , `notes` TEXT ) CHARSET utf8", $silent);
		setupIndexes('attendance', array('student_course'));
		setupTable('students', "create table if not exists `students` (   `student_id` INT not null auto_increment , primary key (`student_id`), `student_name` VARCHAR(200) , `company` INT unsigned , `email` VARCHAR(80) , `phone` VARCHAR(20) , `reg_date` DATE , `photo` VARCHAR(40) , `notes` TEXT ) CHARSET utf8", $silent);
		setupIndexes('students', array('company'));
		setupTable('instructors', "create table if not exists `instructors` (   `inst_id` INT not null auto_increment , primary key (`inst_id`), `inst_name` VARCHAR(200) , `email` VARCHAR(80) , `phone` VARCHAR(20) , `fulltime` CHAR(3) default 'Yes' , `photo` VARCHAR(40) , `notes` TEXT ) CHARSET utf8", $silent);
		setupTable('labs', "create table if not exists `labs` (   `lab_id` INT not null auto_increment , primary key (`lab_id`), `lab_code` VARCHAR(20) , `capacity` INT unsigned , `notes` TEXT ) CHARSET utf8", $silent);
		setupTable('courses_catalog', "create table if not exists `courses_catalog` (   `cat_id` INT unsigned not null auto_increment , primary key (`cat_id`), `course_code` VARCHAR(40) , `course_name` VARCHAR(200) , `course_summary` TEXT , `course_contents` TEXT , `notes` TEXT ) CHARSET utf8", $silent);
		setupTable('companies', "create table if not exists `companies` (   `company_id` INT unsigned not null auto_increment , primary key (`company_id`), `company` VARCHAR(100) , `notes` TEXT ) CHARSET utf8", $silent);


		// save MD5
		if($fp=@fopen(dirname(__FILE__).'/setup.md5', 'w')){
			fwrite($fp, $thisMD5);
			fclose($fp);
		}
	}


	function setupIndexes($tableName, $arrFields){
		if(!is_array($arrFields)){
			return false;
		}

		foreach($arrFields as $fieldName){
			if(!$res=@db_query("SHOW COLUMNS FROM `$tableName` like '$fieldName'")){
				continue;
			}
			if(!$row=@db_fetch_assoc($res)){
				continue;
			}
			if($row['Key']==''){
				@db_query("ALTER TABLE `$tableName` ADD INDEX `$fieldName` (`$fieldName`)");
			}
		}
	}


	function setupTable($tableName, $createSQL='', $silent=true, $arrAlter=''){
		global $Translation;
		ob_start();

		echo '<div style="padding: 5px; border-bottom:solid 1px silver; font-family: verdana, arial; font-size: 10px;">';

		// is there a table rename query?
		if(is_array($arrAlter)){
			$matches=array();
			if(preg_match("/ALTER TABLE `(.*)` RENAME `$tableName`/", $arrAlter[0], $matches)){
				$oldTableName=$matches[1];
			}
		}

		if($res=@db_query("select count(1) from `$tableName`")){ // table already exists
			if($row = @db_fetch_array($res)){
				echo str_replace("<TableName>", $tableName, str_replace("<NumRecords>", $row[0],$Translation["table exists"]));
				if(is_array($arrAlter)){
					echo '<br>';
					foreach($arrAlter as $alter){
						if($alter!=''){
							echo "$alter ... ";
							if(!@db_query($alter)){
								echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
								echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
							}else{
								echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
							}
						}
					}
				}else{
					echo $Translation["table uptodate"];
				}
			}else{
				echo str_replace("<TableName>", $tableName, $Translation["couldnt count"]);
			}
		}else{ // given tableName doesn't exist

			if($oldTableName!=''){ // if we have a table rename query
				if($ro=@db_query("select count(1) from `$oldTableName`")){ // if old table exists, rename it.
					$renameQuery=array_shift($arrAlter); // get and remove rename query

					echo "$renameQuery ... ";
					if(!@db_query($renameQuery)){
						echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
						echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
					}else{
						echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
					}

					if(is_array($arrAlter)) setupTable($tableName, $createSQL, false, $arrAlter); // execute Alter queries on renamed table ...
				}else{ // if old tableName doesn't exist (nor the new one since we're here), then just create the table.
					setupTable($tableName, $createSQL, false); // no Alter queries passed ...
				}
			}else{ // tableName doesn't exist and no rename, so just create the table
				echo str_replace("<TableName>", $tableName, $Translation["creating table"]);
				if(!@db_query($createSQL)){
					echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
					echo '<div class="text-danger">' . $Translation['mysql said'] . db_error(db_link()) . '</div>';
				}else{
					echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
				}
			}
		}

		echo "</div>";

		$out=ob_get_contents();
		ob_end_clean();
		if(!$silent){
			echo $out;
		}
	}
?>