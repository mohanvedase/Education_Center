<?php
// This script and data application were generated by AppGini 5.62
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/students.php");
	include("$currDir/students_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('students');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "students";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`students`.`student_id`" => "student_id",
		"`students`.`student_name`" => "student_name",
		"IF(    CHAR_LENGTH(`companies1`.`company`), CONCAT_WS('',   `companies1`.`company`), '') /* Company */" => "company",
		"`students`.`email`" => "email",
		"`students`.`phone`" => "phone",
		"if(`students`.`reg_date`,date_format(`students`.`reg_date`,'%d.%m.%Y'),'')" => "reg_date",
		"`students`.`photo`" => "photo",
		"`students`.`notes`" => "notes"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`students`.`student_id`',
		2 => 2,
		3 => '`companies1`.`company`',
		4 => 4,
		5 => 5,
		6 => '`students`.`reg_date`',
		7 => 7,
		8 => 8
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`students`.`student_id`" => "student_id",
		"`students`.`student_name`" => "student_name",
		"IF(    CHAR_LENGTH(`companies1`.`company`), CONCAT_WS('',   `companies1`.`company`), '') /* Company */" => "company",
		"`students`.`email`" => "email",
		"`students`.`phone`" => "phone",
		"if(`students`.`reg_date`,date_format(`students`.`reg_date`,'%d.%m.%Y'),'')" => "reg_date",
		"`students`.`photo`" => "photo",
		"`students`.`notes`" => "notes"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`students`.`student_id`" => "Student ID",
		"`students`.`student_name`" => "Student Name",
		"IF(    CHAR_LENGTH(`companies1`.`company`), CONCAT_WS('',   `companies1`.`company`), '') /* Company */" => "Company",
		"`students`.`email`" => "email",
		"`students`.`phone`" => "Phone",
		"`students`.`reg_date`" => "Registration Date",
		"`students`.`notes`" => "Notes"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`students`.`student_id`" => "student_id",
		"`students`.`student_name`" => "student_name",
		"IF(    CHAR_LENGTH(`companies1`.`company`), CONCAT_WS('',   `companies1`.`company`), '') /* Company */" => "company",
		"`students`.`email`" => "email",
		"`students`.`phone`" => "phone",
		"if(`students`.`reg_date`,date_format(`students`.`reg_date`,'%d.%m.%Y'),'')" => "reg_date",
		"`students`.`notes`" => "notes"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'company' => 'Company');

	$x->QueryFrom = "`students` LEFT JOIN `companies` as companies1 ON `companies1`.`company_id`=`students`.`company` ";
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
	$x->ScriptFileName = "students_view.php";
	$x->RedirectAfterInsert = "students_view.php";
	$x->TableTitle = "Students Data";
	$x->TableIcon = "resources/table_icons/angel.png";
	$x->PrimaryKey = "`students`.`student_id`";

	$x->ColWidth   = array(  80, 50, 80, 80);
	$x->ColCaption = array("Student Name", "email", "Phone", "Registration Date");
	$x->ColFieldName = array('student_name', 'email', 'phone', 'reg_date');
	$x->ColNumber  = array(2, 4, 5, 6);

	// template paths below are based on the app main directory
	$x->Template = 'templates/students_templateTV.html';
	$x->SelectedTemplate = 'templates/students_templateTVS.html';
	$x->TemplateDV = 'templates/students_templateDV.html';
	$x->TemplateDVP = 'templates/students_templateDVP.html';

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
		$x->QueryWhere="where `students`.`student_id`=membership_userrecords.pkValue and membership_userrecords.tableName='students' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `students`.`student_id`=membership_userrecords.pkValue and membership_userrecords.tableName='students' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`students`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: students_init
	$render=TRUE;
	if(function_exists('students_init')){
		$args=array();
		$render=students_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: students_header
	$headerCode='';
	if(function_exists('students_header')){
		$args=array();
		$headerCode=students_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: students_footer
	$footerCode='';
	if(function_exists('students_footer')){
		$args=array();
		$footerCode=students_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>