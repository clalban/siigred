<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/fenomenos.php');
	include_once(__DIR__ . '/fenomenos_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('fenomenos');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'fenomenos';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`fenomenos`.`VcrIdFen`" => "VcrIdFen",
		"`fenomenos`.`VcrFen`" => "VcrFen",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => 1,
		2 => 2,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`fenomenos`.`VcrIdFen`" => "VcrIdFen",
		"`fenomenos`.`VcrFen`" => "VcrFen",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`fenomenos`.`VcrIdFen`" => "CODIGO TIPO DE FENOMENO",
		"`fenomenos`.`VcrFen`" => "NOMBRE DEL TIPO DE FENOMENO:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`fenomenos`.`VcrIdFen`" => "VcrIdFen",
		"`fenomenos`.`VcrFen`" => "VcrFen",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`fenomenos` ";
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
	$x->ScriptFileName = 'fenomenos_view.php';
	$x->TableTitle = 'Fenomenos';
	$x->TableIcon = 'table.gif';
	$x->PrimaryKey = '`fenomenos`.`VcrIdFen`';

	$x->ColWidth = [150, 150, ];
	$x->ColCaption = ['CODIGO TIPO DE FENOMENO', 'NOMBRE DEL TIPO DE FENOMENO:', ];
	$x->ColFieldName = ['VcrIdFen', 'VcrFen', ];
	$x->ColNumber  = [1, 2, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/fenomenos_templateTV.html';
	$x->SelectedTemplate = 'templates/fenomenos_templateTVS.html';
	$x->TemplateDV = 'templates/fenomenos_templateDV.html';
	$x->TemplateDVP = 'templates/fenomenos_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: fenomenos_init
	$render = true;
	if(function_exists('fenomenos_init')) {
		$args = [];
		$render = fenomenos_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: fenomenos_header
	$headerCode = '';
	if(function_exists('fenomenos_header')) {
		$args = [];
		$headerCode = fenomenos_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: fenomenos_footer
	$footerCode = '';
	if(function_exists('fenomenos_footer')) {
		$args = [];
		$footerCode = fenomenos_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
