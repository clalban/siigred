<?php
// This script and data application were generated by AppGini 22.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	/* Configuration */
	/*************************************/

		$pcConfig = [
			'natural' => [
			],
			'tipo_documento' => [
			],
			'motivo_visita' => [
			],
			'barrios' => [
			],
			'comunas' => [
			],
			'fenomenos' => [
			],
			'caracteristicas_evento' => [
			],
			'tipo_material' => [
			],
			'lesiones' => [
			],
			'capacidad_reducida' => [
			],
			'servidor_publico' => [
			],
			'fuente_riesgo' => [
			],
			'corregimientos' => [
			],
			'dependencias' => [
			],
			'solicitudes' => [
			],
			'municipios' => [
			],
			'afectacion' => [
			],
			'edificacion' => [
			],
			'tipo_combustible' => [
			],
			'ubicacion' => [
			],
			'tipo_evento' => [
			],
			'actividad_economica' => [
			],
			'usuarios' => [
			],
			'procesos' => [
			],
		];

	/*************************************/
	/* End of configuration */


	include_once(__DIR__ . '/lib.php');
	@header('Content-Type: text/html; charset=' . datalist_db_encoding);

	handle_maintenance();

	/**
	* dynamic configuration based on current user's permissions
	* $userPCConfig array is populated only with parent tables where the user has access to
	* at least one child table
	*/
	$userPCConfig = [];
	foreach($pcConfig as $pcChildTable => $ChildrenLookups) {
		$permChild = getTablePermissions($pcChildTable);
		if(!$permChild['view']) continue;

		foreach($ChildrenLookups as $ChildLookupField => $ChildConfig) {
			$permParent = getTablePermissions($ChildConfig['parent-table']);
			if(!$permParent['view']) continue;

			$userPCConfig[$pcChildTable][$ChildLookupField] = $pcConfig[$pcChildTable][$ChildLookupField];
			// show add new only if configured above AND the user has insert permission
			$userPCConfig[$pcChildTable][$ChildLookupField]['display-add-new'] = ($permChild['insert'] && $pcConfig[$pcChildTable][$ChildLookupField]['display-add-new']);
		}
	}

	/* Receive, UTF-convert, and validate parameters */
	$ParentTable = Request::val('ParentTable'); // needed only with operation=show-children, will be validated in the processing code
	$ChildTable = Request::val('ChildTable');
		if(!in_array($ChildTable, array_keys($userPCConfig))) {
			/* defaults to first child table in config array if not provided */
			$ChildTable = current(array_keys($userPCConfig));
		}
		if(!$ChildTable) { die('<!-- No tables accessible to current user -->'); }
	$SelectedID = strip_tags(Request::val('SelectedID'));
	$ChildLookupField = Request::val('ChildLookupField');
		if(!in_array($ChildLookupField, array_keys($userPCConfig[$ChildTable]))) {
			/* defaults to first lookup in current child config array if not provided */
			$ChildLookupField = current(array_keys($userPCConfig[$ChildTable]));
		}
	$Page = intval(Request::val('Page'));
		if($Page < 1) $Page = 1;
	$SortBy = (Request::val('SortBy') != '' ? abs(intval(Request::val('SortBy'))) : false);
		if(!in_array($SortBy, array_keys($userPCConfig[$ChildTable][$ChildLookupField]['sortable-fields']), true))
			$SortBy = $userPCConfig[$ChildTable][$ChildLookupField]['default-sort-by'];
	$SortDirection = strtolower(Request::val('SortDirection'));
		if(!in_array($SortDirection, ['asc', 'desc']))
			$SortDirection = $userPCConfig[$ChildTable][$ChildLookupField]['default-sort-direction'];
	$Operation = strtolower(Request::val('Operation'));
		if(!in_array($Operation, ['get-records', 'show-children', 'get-records-printable', 'show-children-printable']))
			$Operation = 'get-records';

	/* process requested operation */
	switch($Operation) {
		/************************************************/
		case 'show-children':
			/* populate HTML and JS content with children tabs */
			$tabLabels = $tabPanels = $tabLoaders = '';
			foreach($userPCConfig as $ChildTable => $childLookups) {
				foreach($childLookups as $ChildLookupField => $childConfig) {
					if($childConfig['parent-table'] != $ParentTable) continue;

					$TableIcon = ($childConfig['table-icon'] ? "<img src=\"{$childConfig['table-icon']}\" border=\"0\">" : '');

					$tabLabels .= "<li class=\"child-tab-label child-table-{$ChildTable} lookup-field-{$ChildLookupField} " . ($tabLabels ? '' : 'active') . "\">" .
							"<a href=\"#panel_{$ChildTable}-{$ChildLookupField}\" id=\"tab_{$ChildTable}-{$ChildLookupField}\" data-toggle=\"tab\">" .
								$TableIcon . $childConfig['tab-label'] .
								"<span class=\"badge child-count child-count-{$ChildTable}-{$ChildLookupField}\"></span>" .
							"</a>" .
						"</li>\n\t\t\t\t";

					$tabPanels .= "<div id=\"panel_{$ChildTable}-{$ChildLookupField}\" class=\"tab-pane" . ($tabPanels ? '' : ' active') . "\">" .
							"<i class=\"glyphicon glyphicon-refresh loop-rotate\"></i> " .
							"{$Translation['Loading ...']}" .
						"</div>\n\t\t\t\t";

					$tabLoaders .= "post('parent-children.php', " . json_encode([
							'ChildTable' => $ChildTable,
							'ChildLookupField' => $ChildLookupField,
							'SelectedID' => $SelectedID,
							'Page' => 1,
							'SortBy' => '',
							'SortDirection' => '',
							'Operation' => 'get-records'
						]) . ", 'panel_{$ChildTable}-{$ChildLookupField}');\n\t\t\t\t";
				}
			}

			if(!$tabLabels) { die('<!-- no children of current parent table are accessible to current user -->'); }
			?>
			<div id="children-tabs">
				<ul class="nav nav-tabs">
					<?php echo $tabLabels; ?>
				</ul>
				<span id="pc-loading"></span>
			</div>
			<div class="tab-content"><?php echo $tabPanels; ?></div>

			<script>
				$j(function() {
					/* for iOS, avoid loading child tabs in modals */
					var iOS = /(iPad|iPhone|iPod)/g.test(navigator.userAgent);
					var embedded = ($j('.navbar').length == 0);
					if(iOS && embedded) {
						$j('#children-tabs').next('.tab-content').remove();
						$j('#children-tabs').remove();
						return;
					}

					/* ajax loading of each tab's contents */
					<?php echo $tabLoaders; ?>

					/* show child field caption on tab title in case the same child table appears more than once */
					$j('.child-field-caption').each(function() {
						var clss = $j(this).attr('class').split(/\s+/).reduce(function(rc, cc) {
							return (cc.match(/child-label-.*/) ? '.' + cc : rc);
						}, '');

						// if class occurs more than once, remove .hidden
						if($j(clss).length > 1) $j(clss).removeClass('hidden');
					})
				})
			</script>
			<?php
			break;

		/************************************************/
		case 'show-children-printable':
			/* populate HTML and JS content with children buttons */
			$tabLabels = $tabPanels = $tabLoaders = '';
			foreach($userPCConfig as $ChildTable => $childLookups) {
				foreach($childLookups as $ChildLookupField => $childConfig) {
					if($childConfig['parent-table'] != $ParentTable) continue;

					$TableIcon = ($childConfig['table-icon'] ? "<img src=\"{$childConfig['table-icon']}\" border=\"0\">" : '');

					$tabLabels .= "<button type=\"button\" class=\"btn btn-default child-tab-print-toggler\" data-target=\"#panel_{$ChildTable}-{$ChildLookupField}\" id=\"tab_{$ChildTable}-{$ChildLookupField}\" data-toggle=\"collapse\">" .
							"{$TableIcon} {$childConfig['tab-label']}" .
							"<span class=\"badge child-count child-count-{$ChildTable}-{$ChildLookupField}\"></span>" .
						"</button>\n\t\t\t\t\t";

					$tabPanels .= "<div id=\"panel_{$ChildTable}-{$ChildLookupField}\" class=\"collapse child-panel-print\">" .
							"<i class=\"glyphicon glyphicon-refresh loop-rotate\"></i> " .
							$Translation['Loading ...'] .
						"</div>\n\t\t\t\t";

					$tabLoaders .= "post('parent-children.php', " . json_encode([
							'ChildTable' => $ChildTable,
							'ChildLookupField' => $ChildLookupField,
							'SelectedID' => $SelectedID,
							'Page' => 1,
							'SortBy' => '',
							'SortDirection' => '',
							'Operation' => 'get-records-printable'
						]) . ", 'panel_{$ChildTable}-{$ChildLookupField}');\n\t\t\t\t";
				}
			}

			if(!$tabLabels) { die('<!-- no children of current parent table are accessible to current user -->'); }
			?>
			<div id="children-tabs" class="hidden-print">
				<div class="btn-group btn-group-lg">
					<?php echo $tabLabels; ?>
				</div>
				<span id="pc-loading"></span>
			</div>
			<div class="vspacer-lg"><?php echo $tabPanels; ?></div>

			<script>
				$j(function() {
					/* for iOS, avoid loading child tabs in modals */
					var iOS = /(iPad|iPhone|iPod)/g.test(navigator.userAgent);
					var embedded = ($j('.navbar').length == 0);
					if(iOS && embedded) {
						$j('#children-tabs').next('.tab-content').remove();
						$j('#children-tabs').remove();
						return;
					}

					/* ajax loading of each tab's contents */
					<?php echo $tabLoaders; ?>
				})
			</script>
			<?php
			break;

		/************************************************/
		case 'get-records-printable':
		default: /* default is 'get-records' */

			if($Operation == 'get-records-printable') {
				$userPCConfig[$ChildTable][$ChildLookupField]['records-per-page'] = 2000;
			}

			// build the user permissions limiter
			$permissionsWhere = $permissionsJoin = '';
			$permChild = getTablePermissions($ChildTable);
			if($permChild['view'] == 1) { // user can view only his own records
				$permissionsWhere = "`$ChildTable`.`{$userPCConfig[$ChildTable][$ChildLookupField]['child-primary-key']}`=`membership_userrecords`.`pkValue` AND `membership_userrecords`.`tableName`='$ChildTable' AND LCASE(`membership_userrecords`.`memberID`)='" . getLoggedMemberID() . "'";
			} elseif($permChild['view'] == 2) { // user can view only his group's records
				$permissionsWhere = "`$ChildTable`.`{$userPCConfig[$ChildTable][$ChildLookupField]['child-primary-key']}`=`membership_userrecords`.`pkValue` AND `membership_userrecords`.`tableName`='$ChildTable' AND `membership_userrecords`.`groupID`='" . getLoggedGroupID() . "'";
			} elseif($permChild['view'] == 3) { // user can view all records
				/* that's the only case remaining ... no need to modify the query in this case */
			}
			$permissionsJoin = ($permissionsWhere ? ", `membership_userrecords`" : '');

			// build the count query
			$forcedWhere = $userPCConfig[$ChildTable][$ChildLookupField]['forced-where'];
			$query = 
				preg_replace('/^select .* from /i', 'SELECT count(1) FROM ', $userPCConfig[$ChildTable][$ChildLookupField]['query']) .
				$permissionsJoin . " WHERE " .
				($permissionsWhere ? "( $permissionsWhere )" : "( 1=1 )") . " AND " .
				($forcedWhere ? "( $forcedWhere )" : "( 2=2 )") . " AND " .
				"`$ChildTable`.`$ChildLookupField`='" . makeSafe($SelectedID) . "'";
			$totalMatches = sqlValue($query);

			// make sure $Page is <= max pages
			$maxPage = ceil($totalMatches / $userPCConfig[$ChildTable][$ChildLookupField]['records-per-page']);
			if($Page > $maxPage) { $Page = $maxPage; }

			// initiate output data array
			$data = [
				'config' => $userPCConfig[$ChildTable][$ChildLookupField],
				'parameters' => [
					'ChildTable' => $ChildTable,
					'ChildLookupField' => $ChildLookupField,
					'SelectedID' => $SelectedID,
					'Page' => $Page,
					'SortBy' => $SortBy,
					'SortDirection' => $SortDirection,
					'Operation' => $Operation,
				],
				'records' => [],
				'totalMatches' => $totalMatches
			];

			// build the data query
			if($totalMatches) { // if we have at least one record, proceed with fetching data
				$startRecord = $userPCConfig[$ChildTable][$ChildLookupField]['records-per-page'] * ($Page - 1);
				$data['query'] = 
					$userPCConfig[$ChildTable][$ChildLookupField]['query'] .
					$permissionsJoin . " WHERE " .
					($permissionsWhere ? "( $permissionsWhere )" : "( 1=1 )") . " AND " .
					($forcedWhere ? "( $forcedWhere )" : "( 2=2 )") . " AND " .
					"`$ChildTable`.`$ChildLookupField`='" . makeSafe($SelectedID) . "'" . 
					($SortBy !== false && $userPCConfig[$ChildTable][$ChildLookupField]['sortable-fields'][$SortBy] ? " ORDER BY {$userPCConfig[$ChildTable][$ChildLookupField]['sortable-fields'][$SortBy]} $SortDirection" : '') .
					" LIMIT $startRecord, {$userPCConfig[$ChildTable][$ChildLookupField]['records-per-page']}";
				$res = sql($data['query'], $eo);
				while($row = db_fetch_row($res)) {
					$data['records'][$row[$userPCConfig[$ChildTable][$ChildLookupField]['child-primary-key-index']]] = $row;
				}
			} else { // if no matching records
				$startRecord = 0;
			}

			if($Operation == 'get-records-printable') {
				$response = loadView($userPCConfig[$ChildTable][$ChildLookupField]['template-printable'], $data);
			} else {
				$response = loadView($userPCConfig[$ChildTable][$ChildLookupField]['template'], $data);
			}

			// change name space to ensure uniqueness
			$uniqueNameSpace = $ChildTable.ucfirst($ChildLookupField).'GetRecords';
			echo str_replace("{$ChildTable}GetChildrenRecordsList", $uniqueNameSpace, $response);
		/************************************************/
	}
