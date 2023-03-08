<?php
	define('PREPEND_PATH', '');
	include_once(__DIR__ . '/lib.php');

	// accept a record as an assoc array, return transformed row ready to insert to table
	$transformFunctions = [
		'natural' => function($data, $options = []) {
			if(isset($data['VcrIdSol'])) $data['VcrIdSol'] = pkGivenLookupText($data['VcrIdSol'], 'natural', 'VcrIdSol');
			if(isset($data['VcrFecVis'])) $data['VcrFecVis'] = guessMySQLDateTime($data['VcrFecVis']);
			if(isset($data['VcrIdTip'])) $data['VcrIdTip'] = pkGivenLookupText($data['VcrIdTip'], 'natural', 'VcrIdTip');
			if(isset($data['VcrCel'])) $data['VcrCel'] = str_replace('-', '', $data['VcrCel']);
			if(isset($data['VcrIdMot'])) $data['VcrIdMot'] = pkGivenLookupText($data['VcrIdMot'], 'natural', 'VcrIdMot');
			if(isset($data['VcrFecSol'])) $data['VcrFecSol'] = guessMySQLDateTime($data['VcrFecSol']);
			if(isset($data['VcrIdUbi'])) $data['VcrIdUbi'] = pkGivenLookupText($data['VcrIdUbi'], 'natural', 'VcrIdUbi');
			if(isset($data['VcrIdBarVe'])) $data['VcrIdBarVe'] = pkGivenLookupText($data['VcrIdBarVe'], 'natural', 'VcrIdBarVe');
			if(isset($data['VcrIdCorr'])) $data['VcrIdCorr'] = pkGivenLookupText($data['VcrIdCorr'], 'natural', 'VcrIdCorr');
			if(isset($data['VcrIdCom'])) $data['VcrIdCom'] = pkGivenLookupText($data['VcrIdCom'], 'natural', 'VcrIdCom');
			if(isset($data['VcrIdFen'])) $data['VcrIdFen'] = pkGivenLookupText($data['VcrIdFen'], 'natural', 'VcrIdFen');
			if(isset($data['VcrIdCar'])) $data['VcrIdCar'] = pkGivenLookupText($data['VcrIdCar'], 'natural', 'VcrIdCar');
			if(isset($data['VcrIdEdi'])) $data['VcrIdEdi'] = pkGivenLookupText($data['VcrIdEdi'], 'natural', 'VcrIdEdi');
			if(isset($data['VcrIdAfe'])) $data['VcrIdAfe'] = pkGivenLookupText($data['VcrIdAfe'], 'natural', 'VcrIdAfe');
			if(isset($data['VcrIdMat'])) $data['VcrIdMat'] = pkGivenLookupText($data['VcrIdMat'], 'natural', 'VcrIdMat');
			if(isset($data['VcrIdLes'])) $data['VcrIdLes'] = pkGivenLookupText($data['VcrIdLes'], 'natural', 'VcrIdLes');
			if(isset($data['VcrIdCap'])) $data['VcrIdCap'] = pkGivenLookupText($data['VcrIdCap'], 'natural', 'VcrIdCap');
			if(isset($data['VcrIdTra1'])) $data['VcrIdTra1'] = pkGivenLookupText($data['VcrIdTra1'], 'natural', 'VcrIdTra1');
			if(isset($data['VcrdTra2'])) $data['VcrdTra2'] = pkGivenLookupText($data['VcrdTra2'], 'natural', 'VcrdTra2');
			if(isset($data['VcrIdTra3'])) $data['VcrIdTra3'] = pkGivenLookupText($data['VcrIdTra3'], 'natural', 'VcrIdTra3');
			if(isset($data['VcrIdTra4'])) $data['VcrIdTra4'] = pkGivenLookupText($data['VcrIdTra4'], 'natural', 'VcrIdTra4');
			if(isset($data['VcrIdSerP'])) $data['VcrIdSerP'] = pkGivenLookupText($data['VcrIdSerP'], 'natural', 'VcrIdSerP');

			return $data;
		},
		'tipo_documento' => function($data, $options = []) {

			return $data;
		},
		'motivo_visita' => function($data, $options = []) {

			return $data;
		},
		'barrios' => function($data, $options = []) {
			if(isset($data['VcrIdCom'])) $data['VcrIdCom'] = pkGivenLookupText($data['VcrIdCom'], 'barrios', 'VcrIdCom');

			return $data;
		},
		'comunas' => function($data, $options = []) {

			return $data;
		},
		'fenomenos' => function($data, $options = []) {

			return $data;
		},
		'caracteristicas_evento' => function($data, $options = []) {

			return $data;
		},
		'tipo_material' => function($data, $options = []) {

			return $data;
		},
		'lesiones' => function($data, $options = []) {

			return $data;
		},
		'capacidad_reducida' => function($data, $options = []) {

			return $data;
		},
		'servidor_publico' => function($data, $options = []) {
			if(isset($data['VcrIdProc'])) $data['VcrIdProc'] = pkGivenLookupText($data['VcrIdProc'], 'servidor_publico', 'VcrIdProc');

			return $data;
		},
		'fuente_riesgo' => function($data, $options = []) {

			return $data;
		},
		'corregimientos' => function($data, $options = []) {

			return $data;
		},
		'dependencias' => function($data, $options = []) {

			return $data;
		},
		'solicitudes' => function($data, $options = []) {

			return $data;
		},
		'municipios' => function($data, $options = []) {

			return $data;
		},
		'afectacion' => function($data, $options = []) {

			return $data;
		},
		'edificacion' => function($data, $options = []) {

			return $data;
		},
		'tipo_combustible' => function($data, $options = []) {

			return $data;
		},
		'ubicacion' => function($data, $options = []) {

			return $data;
		},
		'tipo_evento' => function($data, $options = []) {

			return $data;
		},
		'actividad_economica' => function($data, $options = []) {

			return $data;
		},
		'usuarios' => function($data, $options = []) {

			return $data;
		},
		'procesos' => function($data, $options = []) {

			return $data;
		},
	];

	// accept a record as an assoc array, return a boolean indicating whether to import or skip record
	$filterFunctions = [
		'natural' => function($data, $options = []) { return true; },
		'tipo_documento' => function($data, $options = []) { return true; },
		'motivo_visita' => function($data, $options = []) { return true; },
		'barrios' => function($data, $options = []) { return true; },
		'comunas' => function($data, $options = []) { return true; },
		'fenomenos' => function($data, $options = []) { return true; },
		'caracteristicas_evento' => function($data, $options = []) { return true; },
		'tipo_material' => function($data, $options = []) { return true; },
		'lesiones' => function($data, $options = []) { return true; },
		'capacidad_reducida' => function($data, $options = []) { return true; },
		'servidor_publico' => function($data, $options = []) { return true; },
		'fuente_riesgo' => function($data, $options = []) { return true; },
		'corregimientos' => function($data, $options = []) { return true; },
		'dependencias' => function($data, $options = []) { return true; },
		'solicitudes' => function($data, $options = []) { return true; },
		'municipios' => function($data, $options = []) { return true; },
		'afectacion' => function($data, $options = []) { return true; },
		'edificacion' => function($data, $options = []) { return true; },
		'tipo_combustible' => function($data, $options = []) { return true; },
		'ubicacion' => function($data, $options = []) { return true; },
		'tipo_evento' => function($data, $options = []) { return true; },
		'actividad_economica' => function($data, $options = []) { return true; },
		'usuarios' => function($data, $options = []) { return true; },
		'procesos' => function($data, $options = []) { return true; },
	];

	/*
	Hook file for overwriting/amending $transformFunctions and $filterFunctions:
	hooks/import-csv.php
	If found, it's included below

	The way this works is by either completely overwriting any of the above 2 arrays,
	or, more commonly, overwriting a single function, for example:
		$transformFunctions['tablename'] = function($data, $options = []) {
			// new definition here
			// then you must return transformed data
			return $data;
		};

	Another scenario is transforming a specific field and leaving other fields to the default
	transformation. One possible way of doing this is to store the original transformation function
	in GLOBALS array, calling it inside the custom transformation function, then modifying the
	specific field:
		$GLOBALS['originalTransformationFunction'] = $transformFunctions['tablename'];
		$transformFunctions['tablename'] = function($data, $options = []) {
			$data = call_user_func_array($GLOBALS['originalTransformationFunction'], [$data, $options]);
			$data['fieldname'] = 'transformed value';
			return $data;
		};
	*/

	@include(__DIR__ . '/hooks/import-csv.php');

	$ui = new CSVImportUI($transformFunctions, $filterFunctions);
