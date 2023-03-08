<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'natural';

		/* data for selected record, or defaults if none is selected */
		var data = {
			VcrIdSol: <?php echo json_encode(['id' => $rdata['VcrIdSol'], 'value' => $rdata['VcrIdSol'], 'text' => $jdata['VcrIdSol']]); ?>,
			VcrIdTip: <?php echo json_encode(['id' => $rdata['VcrIdTip'], 'value' => $rdata['VcrIdTip'], 'text' => $jdata['VcrIdTip']]); ?>,
			VcrIdMot: <?php echo json_encode(['id' => $rdata['VcrIdMot'], 'value' => $rdata['VcrIdMot'], 'text' => $jdata['VcrIdMot']]); ?>,
			VcrIdUbi: <?php echo json_encode(['id' => $rdata['VcrIdUbi'], 'value' => $rdata['VcrIdUbi'], 'text' => $jdata['VcrIdUbi']]); ?>,
			VcrIdBarVe: <?php echo json_encode(['id' => $rdata['VcrIdBarVe'], 'value' => $rdata['VcrIdBarVe'], 'text' => $jdata['VcrIdBarVe']]); ?>,
			VcrIdCorr: <?php echo json_encode(['id' => $rdata['VcrIdCorr'], 'value' => $rdata['VcrIdCorr'], 'text' => $jdata['VcrIdCorr']]); ?>,
			VcrIdCom: <?php echo json_encode(['id' => $rdata['VcrIdCom'], 'value' => $rdata['VcrIdCom'], 'text' => $jdata['VcrIdCom']]); ?>,
			VcrIdFen: <?php echo json_encode(['id' => $rdata['VcrIdFen'], 'value' => $rdata['VcrIdFen'], 'text' => $jdata['VcrIdFen']]); ?>,
			VcrIdCar: <?php echo json_encode(['id' => $rdata['VcrIdCar'], 'value' => $rdata['VcrIdCar'], 'text' => $jdata['VcrIdCar']]); ?>,
			VcrIdEdi: <?php echo json_encode(['id' => $rdata['VcrIdEdi'], 'value' => $rdata['VcrIdEdi'], 'text' => $jdata['VcrIdEdi']]); ?>,
			VcrIdAfe: <?php echo json_encode(['id' => $rdata['VcrIdAfe'], 'value' => $rdata['VcrIdAfe'], 'text' => $jdata['VcrIdAfe']]); ?>,
			VcrIdMat: <?php echo json_encode(['id' => $rdata['VcrIdMat'], 'value' => $rdata['VcrIdMat'], 'text' => $jdata['VcrIdMat']]); ?>,
			VcrIdLes: <?php echo json_encode(['id' => $rdata['VcrIdLes'], 'value' => $rdata['VcrIdLes'], 'text' => $jdata['VcrIdLes']]); ?>,
			VcrIdCap: <?php echo json_encode(['id' => $rdata['VcrIdCap'], 'value' => $rdata['VcrIdCap'], 'text' => $jdata['VcrIdCap']]); ?>,
			VcrIdTra1: <?php echo json_encode(['id' => $rdata['VcrIdTra1'], 'value' => $rdata['VcrIdTra1'], 'text' => $jdata['VcrIdTra1']]); ?>,
			VcrdTra2: <?php echo json_encode(['id' => $rdata['VcrdTra2'], 'value' => $rdata['VcrdTra2'], 'text' => $jdata['VcrdTra2']]); ?>,
			VcrIdTra3: <?php echo json_encode(['id' => $rdata['VcrIdTra3'], 'value' => $rdata['VcrIdTra3'], 'text' => $jdata['VcrIdTra3']]); ?>,
			VcrIdTra4: <?php echo json_encode(['id' => $rdata['VcrIdTra4'], 'value' => $rdata['VcrIdTra4'], 'text' => $jdata['VcrIdTra4']]); ?>,
			VcrIdSerP: <?php echo json_encode(['id' => $rdata['VcrIdSerP'], 'value' => $rdata['VcrIdSerP'], 'text' => $jdata['VcrIdSerP']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for VcrIdSol */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdSol' && d.id == data.VcrIdSol.id)
				return { results: [ data.VcrIdSol ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdTip */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdTip' && d.id == data.VcrIdTip.id)
				return { results: [ data.VcrIdTip ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdMot */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdMot' && d.id == data.VcrIdMot.id)
				return { results: [ data.VcrIdMot ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdUbi */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdUbi' && d.id == data.VcrIdUbi.id)
				return { results: [ data.VcrIdUbi ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdBarVe */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdBarVe' && d.id == data.VcrIdBarVe.id)
				return { results: [ data.VcrIdBarVe ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdCorr */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdCorr' && d.id == data.VcrIdCorr.id)
				return { results: [ data.VcrIdCorr ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdCom */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdCom' && d.id == data.VcrIdCom.id)
				return { results: [ data.VcrIdCom ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdFen */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdFen' && d.id == data.VcrIdFen.id)
				return { results: [ data.VcrIdFen ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdCar */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdCar' && d.id == data.VcrIdCar.id)
				return { results: [ data.VcrIdCar ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdEdi */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdEdi' && d.id == data.VcrIdEdi.id)
				return { results: [ data.VcrIdEdi ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdAfe */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdAfe' && d.id == data.VcrIdAfe.id)
				return { results: [ data.VcrIdAfe ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdMat */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdMat' && d.id == data.VcrIdMat.id)
				return { results: [ data.VcrIdMat ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdLes */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdLes' && d.id == data.VcrIdLes.id)
				return { results: [ data.VcrIdLes ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdCap */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdCap' && d.id == data.VcrIdCap.id)
				return { results: [ data.VcrIdCap ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdTra1 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdTra1' && d.id == data.VcrIdTra1.id)
				return { results: [ data.VcrIdTra1 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrdTra2 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrdTra2' && d.id == data.VcrdTra2.id)
				return { results: [ data.VcrdTra2 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdTra3 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdTra3' && d.id == data.VcrIdTra3.id)
				return { results: [ data.VcrIdTra3 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdTra4 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdTra4' && d.id == data.VcrIdTra4.id)
				return { results: [ data.VcrIdTra4 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for VcrIdSerP */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'VcrIdSerP' && d.id == data.VcrIdSerP.id)
				return { results: [ data.VcrIdSerP ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

