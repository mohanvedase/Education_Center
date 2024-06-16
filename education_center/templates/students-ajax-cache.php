<script>
	$j(function(){
		var tn = 'students';

		/* data for selected record, or defaults if none is selected */
		var data = {
			company: { id: '<?php echo $rdata['company']; ?>', value: '<?php echo $rdata['company']; ?>', text: '<?php echo $jdata['company']; ?>' }
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for company */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'company' && d.id == data.company.id)
				return { results: [ data.company ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

