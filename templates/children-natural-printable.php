<?php
	if(!isset($Translation)) die('No direct access allowed.');
	$current_table = 'natural';
	$cleaner = new CI_Input(datalist_db_encoding);
	$firstRecord = null;
?>
<script>
	// show child records count in badge in tab title
	$j(() => { $j('.child-count-<?php echo $parameters['ChildTable']; ?>-<?php echo $parameters['ChildLookupField']; ?>').text(<?php echo $totalMatches; ?>) });

	<?php echo $current_table; ?>GetChildrenRecordsList = function(command) {
		var param = {
			ChildTable: "<?php echo $parameters['ChildTable']; ?>",
			ChildLookupField: "<?php echo $parameters['ChildLookupField']; ?>",
			SelectedID: "<?php echo addslashes($parameters['SelectedID']); ?>",
			Page: <?php echo addslashes($parameters['Page']); ?>,
			SortBy: <?php echo ($parameters['SortBy'] === false ? '""' : $parameters['SortBy']); ?>,
			SortDirection: '<?php echo $parameters['SortDirection']; ?>',
			AutoClose: <?php echo ($config['auto-close'] ? 'true' : 'false'); ?>
		};
		var panelID = "panel_<?php echo "{$parameters['ChildTable']}-{$parameters['ChildLookupField']}"; ?>";
		var mbWidth = window.innerWidth * 0.9;
		var mbHeight = window.innerHeight * 0.8;
		if(mbWidth > 1000) { mbWidth = 1000; }
		if(mbHeight > 800) { mbHeight = 800; }

		switch(command.Verb) {
			case 'sort': /* order by given field index in 'SortBy' */
				post("parent-children.php", {
					ChildTable: param.ChildTable,
					ChildLookupField: param.ChildLookupField,
					SelectedID: param.SelectedID,
					Page: param.Page,
					SortBy: command.SortBy,
					SortDirection: command.SortDirection,
					Operation: 'get-records-printable'
				}, panelID, undefined, 'pc-loading', function() { AppGini.calculatedFields.init() });
				break;
			case 'page': /* next or previous page as provided by 'Page' */
				if(command.Page.toLowerCase() == 'next') { command.Page = param.Page + 1; }
				else if(command.Page.toLowerCase() == 'previous') { command.Page = param.Page - 1; }

				if(command.Page < 1 || command.Page > <?php echo ceil($totalMatches / $config['records-per-page']); ?>) { return; }
				post("parent-children.php", {
					ChildTable: param.ChildTable,
					ChildLookupField: param.ChildLookupField,
					SelectedID: param.SelectedID,
					Page: command.Page,
					SortBy: param.SortBy,
					SortDirection: param.SortDirection,
					Operation: 'get-records-printable'
				}, panelID, undefined, 'pc-loading', function() { AppGini.calculatedFields.init() });
				break;
			case 'reload': /* just a way of refreshing children, retaining sorting and pagination & without reloading the whole page */
				post("parent-children.php", {
					ChildTable: param.ChildTable,
					ChildLookupField: param.ChildLookupField,
					SelectedID: param.SelectedID,
					Page: param.Page,
					SortBy: param.SortBy,
					SortDirection: param.SortDirection,
					Operation: 'get-records-printable'
				}, panelID, undefined, 'pc-loading', function() { AppGini.calculatedFields.init() });
				break;
		}
	};
</script>

<div class="row">
	<div class="col-xs-12 col-md-12">

		<div class="page-header"><h1>
			<?php echo ($config['table-icon'] ? '<img src="' . $config['table-icon'] . '">' : ''); ?>
			<?php echo $config['tab-label']; ?>
		</h1></div>


		<div class="table-responsive">
			<table data-tablename="<?php echo $current_table; ?>" class="table table-striped table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<?php if(is_array($config['display-fields'])) foreach($config['display-fields'] as $fieldIndex => $fieldLabel) { ?>
							<th 
								<?php if($config['sortable-fields'][$fieldIndex]) { ?>
									onclick="<?php echo $current_table; ?>GetChildrenRecordsList({
										Verb: 'sort',
										SortBy: <?php echo $fieldIndex; ?>,
										SortDirection: '<?php echo ($parameters['SortBy'] == $fieldIndex && $parameters['SortDirection'] == 'asc' ? 'desc' : 'asc'); ?>'
									});"
									style="cursor: pointer;"
									tabindex="0"
								<?php } ?>
								class="<?php echo "{$current_table}-{$config['display-field-names'][$fieldIndex]}"; ?>">
								<?php echo $fieldLabel; ?>
								<?php if($parameters['SortBy'] == $fieldIndex && $parameters['SortDirection'] == 'desc') { ?>
									<i class="glyphicon glyphicon-sort-by-attributes-alt text-warning"></i>
								<?php } elseif($parameters['SortBy'] == $fieldIndex && $parameters['SortDirection'] == 'asc') { ?>
									<i class="glyphicon glyphicon-sort-by-attributes text-warning"></i>
								<?php } ?>
							</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($records)) foreach($records as $pkValue => $record) { ?>
					<tr data-id="<?php echo html_attr($pkValue); ?>">
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][0]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][0]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[0]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][1]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][1]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[1]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][2]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][2]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[2]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][3]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][3]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[3]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][4]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][4]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[4]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][5]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][5]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[5]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][6]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][6]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[6]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][7]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][7]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[7]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][8]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][8]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[8]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][9]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][9]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[9]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][10]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][10]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[10]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][11]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][11]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[11]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][12]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][12]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[12]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][13]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][13]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[13]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][14]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][14]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[14]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][15]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][15]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[15]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][16]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][16]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[16]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][17]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][17]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[17]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][18]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][18]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[18]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][19]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][19]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[19]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][20]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][20]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[20]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][21]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][21]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[21]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][22]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][22]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[22]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][23]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][23]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[23]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][24]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][24]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[24]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][25]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][25]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[25]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][26]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][26]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[26]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][27]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][27]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[27]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][28]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][28]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[28]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][29]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][29]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[29]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][30]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][30]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[30]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][31]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][31]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[31]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][32]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][32]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[32]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][33]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][33]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[33]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][34]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][34]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[34]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][35]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][35]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[35]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][36]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][36]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[36]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][37]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][37]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[37]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][38]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][38]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[38]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][39]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][39]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[39]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][40]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][40]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[40]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][41]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][41]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[41]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][42]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][42]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[42]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][43]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][43]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[43]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][44]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][44]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[44]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][45]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][45]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[45]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][46]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][46]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[46]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][47]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][47]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[47]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][48]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][48]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[48]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][49]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][49]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[49]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][50]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][50]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[50]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][51]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][51]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[51]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][52]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][52]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[52]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][53]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][53]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[53]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][54]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][54]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[54]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][55]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][55]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[55]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][56]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][56]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[56]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][57]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][57]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[57]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][58]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][58]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[58]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][59]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][59]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[59]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][60]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][60]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[60]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][61]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][61]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[61]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][62]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][62]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[62]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][63]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][63]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[63]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][64]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][64]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[64]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][65]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][65]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[65]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][66]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][66]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[66]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][67]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][67]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[67]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][68]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][68]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[68]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][69]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][69]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[69]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][70]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][70]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[70]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][71]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][71]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[71]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][72]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][72]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[72]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][73]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][73]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[73]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][74]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][74]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[74]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][75]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][75]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[75]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][76]}"; ?> text-right" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][76]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php echo safe_html($record[76]); ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][77]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][77]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php if($record[77]) { ?><a href="link.php?t=<?php echo $parameters['ChildTable']; ?>&f=VcrIma&i=<?php echo urlencode($record[$config['child-primary-key-index']]); ?>" target="_blank" class="btn btn-default" title="<?php echo html_attr($record[77]); ?>"><i class="glyphicon glyphicon-lg glyphicon-picture text-info"></i></a><?php } ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][78]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][78]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php if($record[78]) { ?><a href="link.php?t=<?php echo $parameters['ChildTable']; ?>&f=VcrVideo&i=<?php echo urlencode($record[$config['child-primary-key-index']]); ?>" target="_blank" class="btn btn-default" title="<?php echo html_attr($record[78]); ?>"><i class="glyphicon glyphicon-lg glyphicon-film text-info"></i></a><?php } ?></td>
						<td class="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][79]}"; ?>" id="<?php echo "{$parameters['ChildTable']}-{$config['display-field-names'][79]}-" . html_attr($record[$config['child-primary-key-index']]); ?>"><?php if($record[79]) { ?><a href="link.php?t=<?php echo $parameters['ChildTable']; ?>&f=VcrDoc&i=<?php echo urlencode($record[$config['child-primary-key-index']]); ?>" target="_blank" class="btn btn-default" title="<?php echo html_attr($record[79]); ?>"><i class="glyphicon glyphicon-lg glyphicon-file text-info"></i></a><?php } ?></td>
					</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="<?php echo count($config['display-fields']); ?>">
							<?php if($totalMatches) { ?>
								<?php if($config['show-page-progress']) { ?>
									<span style="margin: 10px;">
										<?php $firstRecord = ($parameters['Page'] - 1) * $config['records-per-page'] + 1; ?>
										<?php echo str_replace(['<FirstRecord>', '<LastRecord>', '<RecordCount>'], ['<span class="first-record locale-int">' . $firstRecord . '</span>', '<span class="last-record locale-int">' . ($firstRecord + count($records) - 1) . '</span>', '<span class="record-count locale-int">' . $totalMatches . '</span>'], $Translation['records x to y of z']); ?>
									</span>
								<?php } ?>
							<?php } else { ?>
								<span class="text-danger" style="margin: 10px;"><?php echo $Translation['No matches found!']; ?></span>
							<?php } ?>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<?php if($totalMatches > $config['records-per-page']) { ?>
			<div class="row hidden-print">
				<div class="col-xs-12">
					<button
						type="button" 
						class="btn btn-default btn-previous" 
						<?php echo $parameters['Page'] <= 1 ? 'disabled' : ''; ?>
						><i class="glyphicon glyphicon-chevron-left"></i>
					</button>
					<button
						type="button" 
						class="btn btn-default btn-next" 
						<?php echo ($firstRecord + count($records) - 1) == $totalMatches ? 'disabled' : ''; ?>
						><i class="glyphicon glyphicon-chevron-right"></i>
					</button>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<script>
	$j(function() {
		$j('img[src^="thumbnail.php?i=&"').parent().hide();

		$j('.btn-previous, .btn-next').on('click', function() {
			$j('.btn-previous, .btn-next')
				.prop('disabled', true);
			$j(this).find('.glyphicon')
				.removeClass('glyphicon-chevron-right glyphicon-chevron-left')
				.addClass('glyphicon-refresh loop-rotate');

			<?php echo $current_table; ?>GetChildrenRecordsList({
				Verb: 'page',
				Page: ($j(this).hasClass('btn-next') ? 'next' : 'previous')
			});
		});
	})
</script>
