<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/barrios.php');
	include_once(__DIR__ . '/barrios_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('barrios');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'barrios';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`barrios`.`VcrIdBarVe`" => "VcrIdBarVe",
		"`barrios`.`VcrBarVer`" => "VcrBarVer",
		"IF(    CHAR_LENGTH(`comunas1`.`VcrCom`), CONCAT_WS('',   `comunas1`.`VcrCom`), '') /* COMUNA: */" => "VcrIdCom",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => 1,
		2 => 2,
		3 => '`comunas1`.`VcrCom`',
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`barrios`.`VcrIdBarVe`" => "VcrIdBarVe",
		"`barrios`.`VcrBarVer`" => "VcrBarVer",
		"IF(    CHAR_LENGTH(`comunas1`.`VcrCom`), CONCAT_WS('',   `comunas1`.`VcrCom`), '') /* COMUNA: */" => "VcrIdCom",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`barrios`.`VcrIdBarVe`" => "CODIGO DEL BARRIO: ",
		"`barrios`.`VcrBarVer`" => "NOMBRE DEL BARRIO:",
		"IF(    CHAR_LENGTH(`comunas1`.`VcrCom`), CONCAT_WS('',   `comunas1`.`VcrCom`), '') /* COMUNA: */" => "COMUNA:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`barrios`.`VcrIdBarVe`" => "VcrIdBarVe",
		"`barrios`.`VcrBarVer`" => "VcrBarVer",
		"IF(    CHAR_LENGTH(`comunas1`.`VcrCom`), CONCAT_WS('',   `comunas1`.`VcrCom`), '') /* COMUNA: */" => "VcrIdCom",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['VcrIdCom' => 'COMUNA:', ];

	$x->QueryFrom = "`barrios` LEFT JOIN `comunas` as comunas1 ON `comunas1`.`VcrIdCom`=`barrios`.`VcrIdCom` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = (getLoggedAdmin() !== false);
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = (getLoggedAdmin() !== false);
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'barrios_view.php';
	$x->TableTitle = 'Barrios';
	$x->TableIcon = 'table.gif';
	$x->PrimaryKey = '`barrios`.`VcrIdBarVe`';

	$x->ColWidth = [150, 150, 150, ];
	$x->ColCaption = ['CODIGO DEL BARRIO: ', 'NOMBRE DEL BARRIO:', 'COMUNA:', ];
	$x->ColFieldName = ['VcrIdBarVe', 'VcrBarVer', 'VcrIdCom', ];
	$x->ColNumber  = [1, 2, 3, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/barrios_templateTV.html';
	$x->SelectedTemplate = 'templates/barrios_templateTVS.html';
	$x->TemplateDV = 'templates/barrios_templateDV.html';
	$x->TemplateDVP = 'templates/barrios_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: barrios_init
	$render = true;
	if(function_exists('barrios_init')) {
		$args = [];
		$render = barrios_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: barrios_header
	$headerCode = '';
	if(function_exists('barrios_header')) {
		$args = [];
		$headerCode = barrios_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: barrios_footer
	$footerCode = '';
	if(function_exists('barrios_footer')) {
		$args = [];
		$footerCode = barrios_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
