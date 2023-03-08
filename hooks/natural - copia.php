<?php

	/**
	 * @file
	 * This file contains hook functions that get called when data operations are performed on 'natural' table. 
	 * For example, when a new record is added, when a record is edited, when a record is deleted, � etc.
	*/

	/**
	 * Called before rendering the page. This is a very powerful hook that allows you to control all aspects of how the page is rendered.
	 * 
	 * @param $options
	 * (passed by reference) a DataList object that sets options for rendering the page.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/DataList
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * True to render the page. False to cancel the operation (which could be useful for error handling to display 
	 * an error message to the user and stop displaying any data).
	*/

	function natural_init(&$options, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called before displaying page content. Can be used to return a customized header template for the table.
	 * 
	 * @param $contentType
	 * specifies the type of view that will be displayed. Takes one the following values: 
	 * 'tableview', 'detailview', 'tableview+detailview', 'print-tableview', 'print-detailview', 'filters'
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * String containing the HTML header code. If empty, the default 'header.php' is used. If you want to include
	 * the default header besides your customized header, include the <%%HEADER%%> placeholder in the returned string.
	*/

	function natural_header($contentType, $memberInfo, &$args) {
		$header='';

		switch($contentType) {
			case 'tableview':
				$header='';
				break;

			case 'detailview':
				$header='';
				break;

			case 'tableview+detailview':
				$header='';
				break;

			case 'print-tableview':
				$header='';
				break;

			case 'print-detailview':
				$header='';
				break;

			case 'filters':
				$header='';
				break;
		}

		return $header;
	}

	/**
	 * Called after displaying page content. Can be used to return a customized footer template for the table.
	 * 
	 * @param $contentType
	 * specifies the type of view that will be displayed. Takes one the following values: 
	 * 'tableview', 'detailview', 'tableview+detailview', 'print-tableview', 'print-detailview', 'filters'
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * String containing the HTML footer code. If empty, the default 'footer.php' is used. If you want to include 
	 * the default footer besides your customized footer, include the <%%FOOTER%%> placeholder in the returned string.
	*/

	function natural_footer($contentType, $memberInfo, &$args) {
		$footer='';

		switch($contentType) {
			case 'tableview':
				$footer='';
				break;

			case 'detailview':
				$footer='';
				break;

			case 'tableview+detailview':
				$footer='';
				break;

			case 'print-tableview':
				$footer='';
				break;

			case 'print-detailview':
				$footer='';
				break;

			case 'filters':
				$footer='';
				break;
		}

		return $footer;
	}

	/**
	 * Called before executing the insert query.
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values to be inserted into the new record.
	 * Note: if a field is set as read-only or hidden in detail view, it can't be modified through $data. You should use a direct SQL statement instead.
	 * For this table, the array items are: 
	 *     $data['VcrCodForm'], $data['VcrIdSol'], $data['VcrFecVis'], $data['VcrNomAti'], $data['VcrIdTip'], $data['VcrNoIde'], $data['VcrCel'], $data['VcrCorEle'], $data['VcrIdMot'], $data['VcrRadSol'], $data['VcrFecSol'], $data['VcrObsDat'], $data['VcrIdUbi'], $data['VcrDir'], $data['VcrIdBarVe'], $data['VcrIdCorr'], $data['VcrIdCom'], $data['VcrLat'], $data['VcrLon'], $data['VcrObsUbi'], $data['VcrIdFen'], $data['VcrDet'], $data['VcrIdCar'], $data['VcrOtr'], $data['VcrDesEve'], $data['VcrIdEdi'], $data['VcrNoPis'], $data['VcrObrCiv'], $data['VcrEstEdi'], $data['VcrIdAfe'], $data['VcrObsEst'], $data['VcrDanGrav'], $data['VcrAnoCon'], $data['VcrIdMat'], $data['VcrIdLes'], $data['VcrAyuHum'], $data['VcrConAyu'], $data['VcrObs'], $data['VcrCapRed'], $data['VcrIdCap'], $data['VcrOtrCap'], $data['VcrInf0a5F'], $data['VcrInf0a5M'], $data['VcrInf5a12F'], $data['VcrInf5a12M'], $data['VcrAd12a18F'], $data['VcrAd12a18M'], $data['VcrAd18a28F'], $data['VcrAd18a28M'], $data['VcrAd28a60F'], $data['VcrAd28a60M'], $data['VcrAdMay60F'], $data['VcrAdMay60M'], $data['VcrAfr'], $data['VcrPal'], $data['VcrInd'], $data['VcrCau'], $data['VcrGit'], $data['VcrMes'], $data['VcrOtrPer'], $data['VcrPerNsNr'], $data['VcrTraCas'], $data['VcrIdTra1'], $data['VcrdTra2'], $data['VcrIdTra3'], $data['VcrIdTra4'], $data['VcrRecLin'], $data['VcrRecLey'], $data['VcrRecPre'], $data['VcrRecAut'], $data['VcrDatPer'], $data['VcrUsoIma'], $data['VcrUsoDat'], $data['VcrAutCor'], $data['VcrNomAtVis'], $data['VcrNumIde'], $data['VcrIdSerP']
	 * $data array is passed by reference so that modifications to it apply to the insert query.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * A boolean TRUE to perform the insert operation, or FALSE to cancel it.
	*/
		
	
	/**
	 * Called after executing the insert query (but before executing the ownership insert query).
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values that were inserted into the new record.
	 * For this table, the array items are: 
	 *     $data['VcrCodForm'], $data['VcrIdSol'], $data['VcrFecVis'], $data['VcrNomAti'], $data['VcrIdTip'], $data['VcrNoIde'], $data['VcrCel'], $data['VcrCorEle'], $data['VcrIdMot'], $data['VcrRadSol'], $data['VcrFecSol'], $data['VcrObsDat'], $data['VcrIdUbi'], $data['VcrDir'], $data['VcrIdBarVe'], $data['VcrIdCorr'], $data['VcrIdCom'], $data['VcrLat'], $data['VcrLon'], $data['VcrObsUbi'], $data['VcrIdFen'], $data['VcrDet'], $data['VcrIdCar'], $data['VcrOtr'], $data['VcrDesEve'], $data['VcrIdEdi'], $data['VcrNoPis'], $data['VcrObrCiv'], $data['VcrEstEdi'], $data['VcrIdAfe'], $data['VcrObsEst'], $data['VcrDanGrav'], $data['VcrAnoCon'], $data['VcrIdMat'], $data['VcrIdLes'], $data['VcrAyuHum'], $data['VcrConAyu'], $data['VcrObs'], $data['VcrCapRed'], $data['VcrIdCap'], $data['VcrOtrCap'], $data['VcrInf0a5F'], $data['VcrInf0a5M'], $data['VcrInf5a12F'], $data['VcrInf5a12M'], $data['VcrAd12a18F'], $data['VcrAd12a18M'], $data['VcrAd18a28F'], $data['VcrAd18a28M'], $data['VcrAd28a60F'], $data['VcrAd28a60M'], $data['VcrAdMay60F'], $data['VcrAdMay60M'], $data['VcrAfr'], $data['VcrPal'], $data['VcrInd'], $data['VcrCau'], $data['VcrGit'], $data['VcrMes'], $data['VcrOtrPer'], $data['VcrPerNsNr'], $data['VcrTraCas'], $data['VcrIdTra1'], $data['VcrdTra2'], $data['VcrIdTra3'], $data['VcrIdTra4'], $data['VcrRecLin'], $data['VcrRecLey'], $data['VcrRecPre'], $data['VcrRecAut'], $data['VcrDatPer'], $data['VcrUsoIma'], $data['VcrUsoDat'], $data['VcrAutCor'], $data['VcrNomAtVis'], $data['VcrNumIde'], $data['VcrIdSerP']
	 * Also includes the item $data['selectedID'] which stores the value of the primary key for the new record.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * A boolean TRUE to perform the ownership insert operation or FALSE to cancel it.
	 * Warning: if a FALSE is returned, the new record will have no ownership info.
	*/function natural_before_insert(&$data, $memberInfo, &$args) {

		$prefix = '41630101424-01-';
		$table = `natural`;
		$VcrId = sqlValue("SELECT MAX(VcrId) FROM `natural`") + 1; // obtener el siguiente valor de VcrId
		$Vcrcodform = $prefix . $VcrId; // concatenar la cadena constante y el valor del campo VcrId
    	$data['Vcrcodform'] = $Vcrcodform; // actualizar el valor del campo Vcrcodform en $args

    
    return TRUE;
}


	function natural_after_insert($data, $memberInfo, &$args) {
   
		return TRUE;
	}

	/**
	 * Called before executing the update query.
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values.
	 * Note: if a field is set as read-only or hidden in detail view, it can't be modified through $data. You should use a direct SQL statement instead.
	 * For this table, the array items are: 
	 *     $data['VcrCodForm'], $data['VcrIdSol'], $data['VcrFecVis'], $data['VcrNomAti'], $data['VcrIdTip'], $data['VcrNoIde'], $data['VcrCel'], $data['VcrCorEle'], $data['VcrIdMot'], $data['VcrRadSol'], $data['VcrFecSol'], $data['VcrObsDat'], $data['VcrIdUbi'], $data['VcrDir'], $data['VcrIdBarVe'], $data['VcrIdCorr'], $data['VcrIdCom'], $data['VcrLat'], $data['VcrLon'], $data['VcrObsUbi'], $data['VcrIdFen'], $data['VcrDet'], $data['VcrIdCar'], $data['VcrOtr'], $data['VcrDesEve'], $data['VcrIdEdi'], $data['VcrNoPis'], $data['VcrObrCiv'], $data['VcrEstEdi'], $data['VcrIdAfe'], $data['VcrObsEst'], $data['VcrDanGrav'], $data['VcrAnoCon'], $data['VcrIdMat'], $data['VcrIdLes'], $data['VcrAyuHum'], $data['VcrConAyu'], $data['VcrObs'], $data['VcrCapRed'], $data['VcrIdCap'], $data['VcrOtrCap'], $data['VcrInf0a5F'], $data['VcrInf0a5M'], $data['VcrInf5a12F'], $data['VcrInf5a12M'], $data['VcrAd12a18F'], $data['VcrAd12a18M'], $data['VcrAd18a28F'], $data['VcrAd18a28M'], $data['VcrAd28a60F'], $data['VcrAd28a60M'], $data['VcrAdMay60F'], $data['VcrAdMay60M'], $data['VcrAfr'], $data['VcrPal'], $data['VcrInd'], $data['VcrCau'], $data['VcrGit'], $data['VcrMes'], $data['VcrOtrPer'], $data['VcrPerNsNr'], $data['VcrTraCas'], $data['VcrIdTra1'], $data['VcrdTra2'], $data['VcrIdTra3'], $data['VcrIdTra4'], $data['VcrRecLin'], $data['VcrRecLey'], $data['VcrRecPre'], $data['VcrRecAut'], $data['VcrDatPer'], $data['VcrUsoIma'], $data['VcrUsoDat'], $data['VcrAutCor'], $data['VcrNomAtVis'], $data['VcrNumIde'], $data['VcrIdSerP']
	 * Also includes the item $data['selectedID'] which stores the value of the primary key for the record to be updated.
	 * $data array is passed by reference so that modifications to it apply to the update query.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * True to perform the update operation or false to cancel it.
	*/

	function natural_before_update(&$data, $memberInfo, &$args) {

			return TRUE;
		}

	/**
	 * Called after executing the update query and before executing the ownership update query.
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values.
	 * For this table, the array items are: 
	 *     $data['VcrId'], $data['VcrCodForm'], $data['VcrIdSol'], $data['VcrFecVis'], $data['VcrNomAti'], $data['VcrIdTip'], $data['VcrNoIde'], $data['VcrCel'], $data['VcrCorEle'], $data['VcrIdMot'], $data['VcrRadSol'], $data['VcrFecSol'], $data['VcrObsDat'], $data['VcrIdUbi'], $data['VcrDir'], $data['VcrIdBarVe'], $data['VcrIdCorr'], $data['VcrIdCom'], $data['VcrLat'], $data['VcrLon'], $data['VcrObsUbi'], $data['VcrIdFen'], $data['VcrDet'], $data['VcrIdCar'], $data['VcrOtr'], $data['VcrDesEve'], $data['VcrIdEdi'], $data['VcrNoPis'], $data['VcrObrCiv'], $data['VcrEstEdi'], $data['VcrIdAfe'], $data['VcrObsEst'], $data['VcrDanGrav'], $data['VcrAnoCon'], $data['VcrIdMat'], $data['VcrIdLes'], $data['VcrAyuHum'], $data['VcrConAyu'], $data['VcrObs'], $data['VcrCapRed'], $data['VcrIdCap'], $data['VcrOtrCap'], $data['VcrInf0a5F'], $data['VcrInf0a5M'], $data['VcrInf5a12F'], $data['VcrInf5a12M'], $data['VcrAd12a18F'], $data['VcrAd12a18M'], $data['VcrAd18a28F'], $data['VcrAd18a28M'], $data['VcrAd28a60F'], $data['VcrAd28a60M'], $data['VcrAdMay60F'], $data['VcrAdMay60M'], $data['VcrAfr'], $data['VcrPal'], $data['VcrInd'], $data['VcrCau'], $data['VcrGit'], $data['VcrMes'], $data['VcrOtrPer'], $data['VcrPerNsNr'], $data['VcrTraCas'], $data['VcrIdTra1'], $data['VcrdTra2'], $data['VcrIdTra3'], $data['VcrIdTra4'], $data['VcrRecLin'], $data['VcrRecLey'], $data['VcrRecPre'], $data['VcrRecAut'], $data['VcrDatPer'], $data['VcrUsoIma'], $data['VcrUsoDat'], $data['VcrAutCor'], $data['VcrNomAtVis'], $data['VcrNumIde'], $data['VcrIdSerP']
	 * Also includes the item $data['selectedID'] which stores the value of the primary key for the record.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * True to perform the ownership update operation or false to cancel it. 
	*/

	function natural_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called before deleting a record (and before performing child records check).
	 * 
	 * @param $selectedID
	 * The primary key value of the record to be deleted.
	 * 
	 * @param $skipChecks
	 * A flag passed by reference that determines whether child records check should be performed or not.
	 * If you set $skipChecks to TRUE, no child records check will be made. If you set it to FALSE, the check will be performed.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * True to perform the delete operation or false to cancel it.
	*/

	function natural_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called after deleting a record.
	 * 
	 * @param $selectedID
	 * The primary key value of the record to be deleted.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * None.
	*/

	function natural_after_delete($selectedID, $memberInfo, &$args) {

	}

	/**
	 * Called when a user requests to view the detail view (before displaying the detail view).
	 * 
	 * @param $selectedID
	 * The primary key value of the record selected. False if no record is selected (i.e. the detail view will be 
	 * displayed to enter a new record).
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $html
	 * (passed by reference) the HTML code of the form ready to be displayed. This could be useful for manipulating 
	 * the code before displaying it using regular expressions, � etc.
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * None.
	*/

	function natural_dv($selectedID, $memberInfo, &$html, &$args) {

	}

	/**
	 * Called when a user requests to download table data as a CSV file (by clicking on the SAVE CSV button)
	 * 
	 * @param $query
	 * Contains the query that will be executed to return the data in the CSV file.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * A string containing the query to use for fetching the CSV data. If FALSE or empty is returned, the default query is used.
	*/

	function natural_csv($query, $memberInfo, &$args) {

		return $query;
	}
	/**
	 * Called when displaying the table view to retrieve custom record actions
	 * 
	 * @return
	 * A 2D array describing custom record actions. The format of the array is:
	 *   [
	 *      [
	 *         'title' => 'Title', // the title/label of the custom action as displayed to users
	 *         'function' => 'js_function_name', // the name of a javascript function to be executed when user selects this action
	 *         'class' => 'CSS class(es) to apply to the action title', // optional, refer to Bootstrap documentation for CSS classes
	 *         'icon' => 'icon name' // optional, refer to Bootstrap glyphicons for supported names
	 *      ], ...
	 *   ]
	*/

	function natural_batch_actions(&$args) {

		return [];
	}
