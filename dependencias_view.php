<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/dependencias.php');
	include_once(__DIR__ . '/dependencias_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('dependencias');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'dependencias';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`dependencias`.`VcrId`" => "VcrId",
		"`dependencias`.`VcrIdTra`" => "VcrIdTra",
		"`dependencias`.`VcrTra`" => "VcrTra",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`dependencias`.`VcrId`',
		2 => 2,
		3 => 3,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`dependencias`.`VcrId`" => "VcrId",
		"`dependencias`.`VcrIdTra`" => "VcrIdTra",
		"`dependencias`.`VcrTra`" => "VcrTra",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`dependencias`.`VcrId`" => "VcrId",
		"`dependencias`.`VcrIdTra`" => "NIT DEPENDENCIA",
		"`dependencias`.`VcrTra`" => "NOMBRE DEPENDENCIA",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`dependencias`.`VcrId`" => "VcrId",
		"`dependencias`.`VcrIdTra`" => "VcrIdTra",
		"`dependencias`.`VcrTra`" => "VcrTra",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`dependencias` ";
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
	$x->ScriptFileName = 'dependencias_view.php';
	$x->TableTitle = 'Dependencias';
	$x->TableIcon = 'table.gif';
	$x->PrimaryKey = '`dependencias`.`VcrId`';

	$x->ColWidth = [150, 150, 150, ];
	$x->ColCaption = ['VcrId', 'NIT DEPENDENCIA', 'NOMBRE DEPENDENCIA', ];
	$x->ColFieldName = ['VcrId', 'VcrIdTra', 'VcrTra', ];
	$x->ColNumber  = [1, 2, 3, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/dependencias_templateTV.html';
	$x->SelectedTemplate = 'templates/dependencias_templateTVS.html';
	$x->TemplateDV = 'templates/dependencias_templateDV.html';
	$x->TemplateDVP = 'templates/dependencias_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: dependencias_init
	$render = true;
	if(function_exists('dependencias_init')) {
		$args = [];
		$render = dependencias_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: dependencias_header
	$headerCode = '';
	if(function_exists('dependencias_header')) {
		$args = [];
		$headerCode = dependencias_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: dependencias_footer
	$footerCode = '';
	if(function_exists('dependencias_footer')) {
		$args = [];
		$footerCode = dependencias_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
