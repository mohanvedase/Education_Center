<?php

// Data functions (insert, update, delete, form) for table labs

// This script and data application were generated by AppGini 5.62
// Download AppGini for free from https://bigprof.com/appgini/download/

function labs_insert(){
	global $Translation;

	// mm: can member insert record?
	$arrPerm=getTablePermissions('labs');
	if(!$arrPerm[1]){
		return false;
	}

	$data['lab_code'] = makeSafe($_REQUEST['lab_code']);
		if($data['lab_code'] == empty_lookup_value){ $data['lab_code'] = ''; }
	$data['capacity'] = makeSafe($_REQUEST['capacity']);
		if($data['capacity'] == empty_lookup_value){ $data['capacity'] = ''; }
	$data['notes'] = makeSafe($_REQUEST['notes']);
		if($data['notes'] == empty_lookup_value){ $data['notes'] = ''; }

	// hook: labs_before_insert
	if(function_exists('labs_before_insert')){
		$args=array();
		if(!labs_before_insert($data, getMemberInfo(), $args)){ return false; }
	}

	$o = array('silentErrors' => true);
	sql('insert into `labs` set       `lab_code`=' . (($data['lab_code'] !== '' && $data['lab_code'] !== NULL) ? "'{$data['lab_code']}'" : 'NULL') . ', `capacity`=' . (($data['capacity'] !== '' && $data['capacity'] !== NULL) ? "'{$data['capacity']}'" : 'NULL') . ', `notes`=' . (($data['notes'] !== '' && $data['notes'] !== NULL) ? "'{$data['notes']}'" : 'NULL'), $o);
	if($o['error']!=''){
		echo $o['error'];
		echo "<a href=\"labs_view.php?addNew_x=1\">{$Translation['< back']}</a>";
		exit;
	}

	$recID = db_insert_id(db_link());

	// hook: labs_after_insert
	if(function_exists('labs_after_insert')){
		$res = sql("select * from `labs` where `lab_id`='" . makeSafe($recID, false) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=array();
		if(!labs_after_insert($data, getMemberInfo(), $args)){ return $recID; }
	}

	// mm: save ownership data
	sql("insert ignore into membership_userrecords set tableName='labs', pkValue='" . makeSafe($recID, false) . "', memberID='" . makeSafe(getLoggedMemberID(), false) . "', dateAdded='" . time() . "', dateUpdated='" . time() . "', groupID='" . getLoggedGroupID() . "'", $eo);

	return $recID;
}

function labs_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false){
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('labs');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='labs' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='labs' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: labs_before_delete
	if(function_exists('labs_before_delete')){
		$args=array();
		if(!labs_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	// child table: courses
	$res = sql("select `lab_id` from `labs` where `lab_id`='$selected_id'", $eo);
	$lab_id = db_fetch_row($res);
	$rires = sql("select count(1) from `courses` where `lab_id`='".addslashes($lab_id[0])."'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks){
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace("<RelatedRecords>", $rirow[0], $RetMsg);
		$RetMsg = str_replace("<TableName>", "courses", $RetMsg);
		return $RetMsg;
	}elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks){
		$RetMsg = $Translation["confirm delete"];
		$RetMsg = str_replace("<RelatedRecords>", $rirow[0], $RetMsg);
		$RetMsg = str_replace("<TableName>", "courses", $RetMsg);
		$RetMsg = str_replace("<Delete>", "<input type=\"button\" class=\"button\" value=\"".$Translation['yes']."\" onClick=\"window.location='labs_view.php?SelectedID=".urlencode($selected_id)."&delete_x=1&confirmed=1';\">", $RetMsg);
		$RetMsg = str_replace("<Cancel>", "<input type=\"button\" class=\"button\" value=\"".$Translation['no']."\" onClick=\"window.location='labs_view.php?SelectedID=".urlencode($selected_id)."';\">", $RetMsg);
		return $RetMsg;
	}

	sql("delete from `labs` where `lab_id`='$selected_id'", $eo);

	// hook: labs_after_delete
	if(function_exists('labs_after_delete')){
		$args=array();
		labs_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='labs' and pkValue='$selected_id'", $eo);
}

function labs_update($selected_id){
	global $Translation;

	// mm: can member edit record?
	$arrPerm=getTablePermissions('labs');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='labs' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='labs' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){ // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['lab_code'] = makeSafe($_REQUEST['lab_code']);
		if($data['lab_code'] == empty_lookup_value){ $data['lab_code'] = ''; }
	$data['capacity'] = makeSafe($_REQUEST['capacity']);
		if($data['capacity'] == empty_lookup_value){ $data['capacity'] = ''; }
	$data['notes'] = makeSafe($_REQUEST['notes']);
		if($data['notes'] == empty_lookup_value){ $data['notes'] = ''; }
	$data['selectedID']=makeSafe($selected_id);

	// hook: labs_before_update
	if(function_exists('labs_before_update')){
		$args=array();
		if(!labs_before_update($data, getMemberInfo(), $args)){ return false; }
	}

	$o=array('silentErrors' => true);
	sql('update `labs` set       `lab_code`=' . (($data['lab_code'] !== '' && $data['lab_code'] !== NULL) ? "'{$data['lab_code']}'" : 'NULL') . ', `capacity`=' . (($data['capacity'] !== '' && $data['capacity'] !== NULL) ? "'{$data['capacity']}'" : 'NULL') . ', `notes`=' . (($data['notes'] !== '' && $data['notes'] !== NULL) ? "'{$data['notes']}'" : 'NULL') . " where `lab_id`='".makeSafe($selected_id)."'", $o);
	if($o['error']!=''){
		echo $o['error'];
		echo '<a href="labs_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}


	// hook: labs_after_update
	if(function_exists('labs_after_update')){
		$res = sql("SELECT * FROM `labs` WHERE `lab_id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['lab_id'];
		$args = array();
		if(!labs_after_update($data, getMemberInfo(), $args)){ return; }
	}

	// mm: update ownership data
	sql("update membership_userrecords set dateUpdated='".time()."' where tableName='labs' and pkValue='".makeSafe($selected_id)."'", $eo);

}

function labs_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = ''){
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('labs');
	if(!$arrPerm[1] && $selected_id==''){ return ''; }
	$AllowInsert = ($arrPerm[1] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != ''){
		$dvprint = true;
	}


	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');

	if($selected_id){
		// mm: check member permissions
		if(!$arrPerm[2]){
			return "";
		}
		// mm: who is the owner?
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='labs' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='labs' and pkValue='".makeSafe($selected_id)."'");
		if($arrPerm[2]==1 && getLoggedMemberID()!=$ownerMemberID){
			return "";
		}
		if($arrPerm[2]==2 && getLoggedGroupID()!=$ownerGroupID){
			return "";
		}

		// can edit?
		if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){
			$AllowUpdate=1;
		}else{
			$AllowUpdate=0;
		}

		$res = sql("select * from `labs` where `lab_id`='".makeSafe($selected_id)."'", $eo);
		if(!($row = db_fetch_array($res))){
			return error_message($Translation['No records found'], 'labs_view.php', false);
		}
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
	}else{
	}

	ob_start();
	?>

	<script>
		// initial lookup values

		jQuery(function() {
			setTimeout(function(){
			}, 10); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_contents());
	ob_end_clean();


	// code for template based detail view forms

	// open the detail view template
	if($dvprint){
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/labs_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	}else{
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/labs_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Detail View', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert){
		if(!$selected_id) $templateCode=str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return labs_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode=str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return labs_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	}else{
		$templateCode=str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']){
		$backAction = 'window.parent.jQuery(\'.modal\').modal(\'hide\'); return false;';
	}else{
		$backAction = '$$(\'form\')[0].writeAttribute(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id){
		if(!$_REQUEST['Embedded']) $templateCode=str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="dvprint" name="dvprint_x" value="1" onclick="$$(\'form\')[0].writeAttribute(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;" title="' . html_attr($Translation['Print Preview']) . '"><i class="glyphicon glyphicon-print"></i> ' . $Translation['Print Preview'] . '</button>', $templateCode);
		if($AllowUpdate){
			$templateCode=str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return labs_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		}else{
			$templateCode=str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
			$templateCode=str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');" title="' . html_attr($Translation['Delete']) . '"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		}else{
			$templateCode=str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode=str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	}else{
		$templateCode=str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode=str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		$templateCode=str_replace('<%%DESELECT_BUTTON%%>', ($ShowCancel ? '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>' : ''), $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate && !$AllowInsert) || (!$selected_id && !$AllowInsert)){
		$jsReadOnly .= "\tjQuery('#lab_code').replaceWith('<div class=\"form-control-static\" id=\"lab_code\">' + (jQuery('#lab_code').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#capacity').replaceWith('<div class=\"form-control-static\" id=\"capacity\">' + (jQuery('#capacity').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif($AllowInsert){
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array();
	foreach($lookup_fields as $luf => $ptfc){
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']){
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent hspacer-md" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] && !$_REQUEST['Embedded']){
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-success add_new_parent hspacer-md" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus-sign"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode=str_replace('<%%UPLOADFILE(lab_id)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(lab_code)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(capacity)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(notes)%%>', '', $templateCode);

	// process values
	if($selected_id){
		$templateCode=str_replace('<%%VALUE(lab_id)%%>', html_attr($row['lab_id']), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(lab_id)%%>', urlencode($urow['lab_id']), $templateCode);
		$templateCode=str_replace('<%%VALUE(lab_code)%%>', html_attr($row['lab_code']), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(lab_code)%%>', urlencode($urow['lab_code']), $templateCode);
		$templateCode=str_replace('<%%VALUE(capacity)%%>', html_attr($row['capacity']), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(capacity)%%>', urlencode($urow['capacity']), $templateCode);
		if($AllowUpdate || $AllowInsert){
			$templateCode = str_replace('<%%HTMLAREA(notes)%%>', '<textarea name="notes" id="notes" rows="5">' . html_attr($row['notes']) . '</textarea>', $templateCode);
		}else{
			$templateCode = str_replace('<%%HTMLAREA(notes)%%>', '<div id="notes" class="form-control-static">' . $row['notes'] . '</div>', $templateCode);
		}
		$templateCode=str_replace('<%%VALUE(notes)%%>', nl2br($row['notes']), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(notes)%%>', urlencode($urow['notes']), $templateCode);
	}else{
		$templateCode=str_replace('<%%VALUE(lab_id)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(lab_id)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(lab_code)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(lab_code)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(capacity)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(capacity)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%HTMLAREA(notes)%%>', '<textarea name="notes" id="notes" rows="5"></textarea>', $templateCode);
	}

	// process translations
	foreach($Translation as $symbol=>$trans){
		$templateCode=str_replace("<%%TRANSLATION($symbol)%%>", $trans, $templateCode);
	}

	// clear scrap
	$templateCode=str_replace('<%%', '<!-- ', $templateCode);
	$templateCode=str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_REQUEST['dvprint_x'] == ''){
		$templateCode .= "\n\n<script>\$j(function(){\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption){
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id){
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('labs');
	if($selected_id){
		$jdata = get_joined_record('labs', $selected_id);
		$rdata = $row;
	}
	$cache_data = array(
		'rdata' => array_map('nl2br', array_map('addslashes', $rdata)),
		'jdata' => array_map('nl2br', array_map('addslashes', $jdata)),
	);
	$templateCode .= loadView('labs-ajax-cache', $cache_data);

	// hook: labs_dv
	if(function_exists('labs_dv')){
		$args=array();
		labs_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>