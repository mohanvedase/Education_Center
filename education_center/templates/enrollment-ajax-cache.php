<script>
	$j(function(){
		var tn = 'enrollment';

		/* data for selected record, or defaults if none is selected */
		var data = {
			stud_id: { id: '<?php echo $rdata['stud_id']; ?>', value: '<?php echo $rdata['stud_id']; ?>', text: '<?php echo $jdata['stud_id']; ?>' },
			course_id: { id: '<?php echo $rdata['course_id']; ?>', value: '<?php echo $rdata['course_id']; ?>', text: '<?php echo $jdata['course_id']; ?>' }
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for stud_id */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'stud_id' && d.id == data.stud_id.id)
				return { results: [ data.stud_id ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for course_id */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'course_id' && d.id == data.course_id.id)
				return { results: [ data.course_id ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

