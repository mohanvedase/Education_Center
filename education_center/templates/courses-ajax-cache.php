<script>
	$j(function(){
		var tn = 'courses';

		/* data for selected record, or defaults if none is selected */
		var data = {
			course_name: { id: '<?php echo $rdata['course_name']; ?>', value: '<?php echo $rdata['course_name']; ?>', text: '<?php echo $jdata['course_name']; ?>' },
			description: '<?php echo $jdata['description']; ?>',
			instructor_id: { id: '<?php echo $rdata['instructor_id']; ?>', value: '<?php echo $rdata['instructor_id']; ?>', text: '<?php echo $jdata['instructor_id']; ?>' },
			lab_id: { id: '<?php echo $rdata['lab_id']; ?>', value: '<?php echo $rdata['lab_id']; ?>', text: '<?php echo $jdata['lab_id']; ?>' }
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for course_name */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'course_name' && d.id == data.course_name.id)
				return { results: [ data.course_name ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for course_name autofills */
		cache.addCheck(function(u, d){
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'course_name' && d.id == data.course_name.id){
				$j('#description' + d[rnd]).html(data.description);
				return true;
			}

			return false;
		});

		/* saved value for instructor_id */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'instructor_id' && d.id == data.instructor_id.id)
				return { results: [ data.instructor_id ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for lab_id */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'lab_id' && d.id == data.lab_id.id)
				return { results: [ data.lab_id ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

