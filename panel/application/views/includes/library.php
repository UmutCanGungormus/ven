<script>
	var LIBS = {
		plot: [
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/excanvas.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.colorhelpers.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.resize.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.canvas.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.categories.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.crosshair.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.errorbars.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.fillbetween.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.image.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.navigate.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.pie.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.resize.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.selection.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.stack.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.symbol.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.threshold.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.time.min.js"
		],
		chart: [
			"https://cdnjs.cloudflare.com/ajax/libs/echarts/4.8.0/echarts.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/echarts/4.8.0/extension/bmap.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/echarts/4.8.0/extension/dataTool.min.js"
		],
		circleProgress: [
			"https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"
		],
		sparkline: [
			"https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"
		],
		maxlength: [
			"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-maxlength/1.10.0/bootstrap-maxlength.min.js"
		],
		tagsinput: [
			"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css",
			"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"
		],
		TouchSpin: [
			"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js"
		],
		selectpicker: [
			"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/css/bootstrap-select.min.css",
			"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/js/bootstrap-select.min.js"
		],
		filestyle: [
			"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/2.1.0/bootstrap-filestyle.min.js"
		],
		timepicker: [
			"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"
		],
		datetimepicker: [
			"https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js",
			"../libs/bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css",
			"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
		],
		select2: [
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css",
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.full.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/i18n/tr.min.js"
		],
		vectorMap: [
			"https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.min.css",
			"https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.min.js"
		],
		summernote: [
			"https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css",
			"https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/plugin/databasic/summernote-ext-databasic.min.css",
			"https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"
		],
		fullCalendar: [
			"https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.css",
			"https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales-all.min.js"
		],
		dropzone: [
			"https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.css",
			"https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/min/dropzone.min.js"
		],
		counterUp: [
			"https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"
		],
		others: [
			"https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css",
			"https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css",
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js",
			"https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js",
		]
	};
</script>