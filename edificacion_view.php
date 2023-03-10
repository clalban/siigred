<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/edificacion.php');
	include_once(__DIR__ . '/edificacion_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('edificacion');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'edificacion';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`edificacion`.`VcrIdEdi`" => "VcrIdEdi",
		"`edificacion`.`VcrEdi`" => "VcrEdi",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => 1,
		2 => 2,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`edificacion`.`VcrIdEdi`" => "VcrIdEdi",
		"`edificacion`.`VcrEdi`" => "VcrEdi",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`edificacion`.`VcrIdEdi`" => "CODIGO TIPO EDIFICACION",
		"`edificacion`.`VcrEdi`" => "NOMBRE TIPO EDIFICACION",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`edificacion`.`VcrIdEdi`" => "VcrIdEdi",
		"`edificacion`.`VcrEdi`" => "VcrEdi",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`edificacion` ";
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
	$x->ScriptFileName = 'edificacion_view.php';
	$x->TableTitle = 'Edificacion';
	$x->TableIcon = 'table.gif';
	$x->PrimaryKey = '`edificacion`.`VcrIdEdi`';

	$x->ColWidth = [150, 150, ];
	$x->ColCaption = ['CODIGO TIPO EDIFICACION', 'NOMBRE TIPO EDIFICACION', ];
	$x->ColFieldName = ['VcrIdEdi', 'VcrEdi', ];
	$x->ColNumber  = [1, 2, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/edificacion_templateTV.html';
	$x->SelectedTemplate = 'templates/edificacion_templateTVS.html';
	$x->TemplateDV = 'templates/edificacion_templateDV.html';
	$x->TemplateDVP = 'templates/edificacion_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: edificacion_init
	$render = true;
	if(function_exists('edificacion_init')) {
		$args = [];
		$render = edificacion_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: edificacion_header
	$headerCode = '';
	if(function_exists('edificacion_header')) {
		$args = [];
		$headerCode = edificacion_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: edificacion_footer
	$footerCode = '';
	if(function_exists('edificacion_footer')) {
		$args = [];
		$footerCode = edificacion_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
