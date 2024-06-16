<?php
// This script and data application were generated by AppGini 5.62
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/attendance.php");
	include("$currDir/attendance_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('attendance');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "attendance";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`attendance`.`attendance_id`" => "attendance_id",
		"IF(    CHAR_LENGTH(`students1`.`student_name`) || CHAR_LENGTH(`courses_catalog1`.`course_name`), CONCAT_WS('',   `students1`.`student_name`, ' / ', `courses_catalog1`.`course_name`, '  '), '') /* Student / Course */" => "student_course",
		"if(`attendance`.`date`,date_format(`attendance`.`date`,'%d.%m.%Y'),'')" => "date",
		"concat('<img src=\"', if(`attendance`.`attended`, 'checked.gif', 'checkednot.gif'), '\" border=\"0\" />')" => "attended",
		"`attendance`.`notes`" => "notes"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`attendance`.`attendance_id`',
		2 => 2,
		3 => '`attendance`.`date`',
		4 => 4,
		5 => 5
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`attendance`.`attendance_id`" => "attendance_id",
		"IF(    CHAR_LENGTH(`students1`.`student_name`) || CHAR_LENGTH(`courses_catalog1`.`course_name`), CONCAT_WS('',   `students1`.`student_name`, ' / ', `courses_catalog1`.`course_name`, '  '), '') /* Student / Course */" => "student_course",
		"if(`attendance`.`date`,date_format(`attendance`.`date`,'%d.%m.%Y'),'')" => "date",
		"`attendance`.`attended`" => "attended",
		"`attendance`.`notes`" => "notes"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`attendance`.`attendance_id`" => "ID",
		"IF(    CHAR_LENGTH(`students1`.`student_name`) || CHAR_LENGTH(`courses_catalog1`.`course_name`), CONCAT_WS('',   `students1`.`student_name`, ' / ', `courses_catalog1`.`course_name`, '  '), '') /* Student / Course */" => "Student / Course",
		"`attendance`.`date`" => "Date",
		"`attendance`.`attended`" => "Attended",
		"`attendance`.`notes`" => "Notes"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`attendance`.`attendance_id`" => "attendance_id",
		"IF(    CHAR_LENGTH(`students1`.`student_name`) || CHAR_LENGTH(`courses_catalog1`.`course_name`), CONCAT_WS('',   `students1`.`student_name`, ' / ', `courses_catalog1`.`course_name`, '  '), '') /* Student / Course */" => "student_course",
		"if(`attendance`.`date`,date_format(`attendance`.`date`,'%d.%m.%Y'),'')" => "date",
		"concat('<img src=\"', if(`attendance`.`attended`, 'checked.gif', 'checkednot.gif'), '\" border=\"0\" />')" => "attended",
		"`attendance`.`notes`" => "notes"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'student_course' => 'Student / Course');

	$x->QueryFrom = "`attendance` LEFT JOIN `enrollment` as enrollment1 ON `enrollment1`.`rec_id`=`attendance`.`student_course` LEFT JOIN `students` as students1 ON `students1`.`student_id`=`enrollment1`.`stud_id` LEFT JOIN `courses` as courses1 ON `courses1`.`course_id`=`enrollment1`.`course_id` LEFT JOIN `courses_catalog` as courses_catalog1 ON `courses_catalog1`.`cat_id`=`courses1`.`course_name` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = false;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 0;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "attendance_view.php";
	$x->RedirectAfterInsert = "attendance_view.php?SelectedID=#ID#";
	$x->TableTitle = "Attendance";
	$x->TableIcon = "resources/table_icons/attributes_display.png";
	$x->PrimaryKey = "`attendance`.`attendance_id`";

	$x->ColWidth   = array(  350, 100, 80);
	$x->ColCaption = array("Student / Course", "Date", "Attended");
	$x->ColFieldName = array('student_course', 'date', 'attended');
	$x->ColNumber  = array(2, 3, 4);

	// template paths below are based on the app main directory
	$x->Template = 'templates/attendance_templateTV.html';
	$x->SelectedTemplate = 'templates/attendance_templateTVS.html';
	$x->TemplateDV = 'templates/attendance_templateDV.html';
	$x->TemplateDVP = 'templates/attendance_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->ShowRecordSlots = 0;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `attendance`.`attendance_id`=membership_userrecords.pkValue and membership_userrecords.tableName='attendance' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `attendance`.`attendance_id`=membership_userrecords.pkValue and membership_userrecords.tableName='attendance' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`attendance`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: attendance_init
	$render=TRUE;
	if(function_exists('attendance_init')){
		$args=array();
		$render=attendance_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: attendance_header
	$headerCode='';
	if(function_exists('attendance_header')){
		$args=array();
		$headerCode=attendance_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: attendance_footer
	$footerCode='';
	if(function_exists('attendance_footer')){
		$args=array();
		$footerCode=attendance_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>