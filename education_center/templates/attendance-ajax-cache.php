<script>
	$j(function(){
		var tn = 'attendance';

		/* data for selected record, or defaults if none is selected */
		var data = {
			student_course: { id: '<?php echo $rdata['student_course']; ?>', value: '<?php echo $rdata['student_course']; ?>', text: '<?php echo $jdata['student_course']; ?>' }
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for student_course */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'student_course' && d.id == data.student_course.id)
				return { results: [ data.student_course ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

