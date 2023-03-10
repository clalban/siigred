<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/motivo_visita.php');
	include_once(__DIR__ . '/motivo_visita_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('motivo_visita');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'motivo_visita';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`motivo_visita`.`VcrIdMot`" => "VcrIdMot",
		"`motivo_visita`.`VcrMotVis`" => "VcrMotVis",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => 1,
		2 => 2,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`motivo_visita`.`VcrIdMot`" => "VcrIdMot",
		"`motivo_visita`.`VcrMotVis`" => "VcrMotVis",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`motivo_visita`.`VcrIdMot`" => "CODIGO MOTIVO DE VISITA:",
		"`motivo_visita`.`VcrMotVis`" => "NOMBRE DEL MOTIVO DE VISITA:",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`motivo_visita`.`VcrIdMot`" => "VcrIdMot",
		"`motivo_visita`.`VcrMotVis`" => "VcrMotVis",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`motivo_visita` ";
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
	$x->ScriptFileName = 'motivo_visita_view.php';
	$x->TableTitle = 'Motivo visita';
	$x->TableIcon = 'table.gif';
	$x->PrimaryKey = '`motivo_visita`.`VcrIdMot`';

	$x->ColWidth = [150, 150, ];
	$x->ColCaption = ['CODIGO MOTIVO DE VISITA:', 'NOMBRE DEL MOTIVO DE VISITA:', ];
	$x->ColFieldName = ['VcrIdMot', 'VcrMotVis', ];
	$x->ColNumber  = [1, 2, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/motivo_visita_templateTV.html';
	$x->SelectedTemplate = 'templates/motivo_visita_templateTVS.html';
	$x->TemplateDV = 'templates/motivo_visita_templateDV.html';
	$x->TemplateDVP = 'templates/motivo_visita_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: motivo_visita_init
	$render = true;
	if(function_exists('motivo_visita_init')) {
		$args = [];
		$render = motivo_visita_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: motivo_visita_header
	$headerCode = '';
	if(function_exists('motivo_visita_header')) {
		$args = [];
		$headerCode = motivo_visita_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: motivo_visita_footer
	$footerCode = '';
	if(function_exists('motivo_visita_footer')) {
		$args = [];
		$footerCode = motivo_visita_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
