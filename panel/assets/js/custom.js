$(document).ready(function () {
	$(document).on("click", ".my-check", function () {
		let id = $(this).data("id");
		let url = $(this).data("url");

		$.post(url, { "id": id }, function (data) {
			if (data.success) {
				iziToast.success({
					title: data.title,
					message: data.msg,
					position: "topCenter"
				})
			}
			else {
				iziToast.error({
					title: data.title,
					message: data.msg,
					position: "topCenter"
				});
			}
		}, "json");
	});



	$.fn.countTo = function (options) {
		options = options || {};

		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from: $(this).data('from'),
				to: $(this).data('to'),
				speed: $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals: $(this).data('decimals')
			}, options);

			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;

			// references & variables that will change with each update
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};

			$self.data('countTo', data);

			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);

			// initialize the element with the starting value
			render(value);

			function updateTimer() {
				value += increment;
				loopCount++;

				render(value);

				if (typeof (settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}

				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;

					if (typeof (settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}

			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
	};

	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};

	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}


	jQuery(function ($) {
		// custom formatting example
		$('.count-number').data('countToOptions', {
			formatter: function (value, options) {
				return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
			}
		});

		// start all the timers
		$('.timer').each(count);

		function count(options) {
			var $this = $(this);
			options = $.extend({}, options || {}, $this.data('countToOptions') || {});
			$this.countTo(options);
		}
	});

	$(".js-example-responsive").select2({
		width: 'resolve',
		theme: "classic",
		tags: true,
		tokenSeparators: [',', ' ']
	});
	$('input[name="finishedAt"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		locale: {
			format: 'MM/DD/YYYY HH:mm',
			separator: ' - ',
			applyLabel: 'Apply',
			cancelLabel: 'Cancel',
			fromLabel: 'From',
			toLabel: 'To',
			customRangeLabel: 'Custom',
			daysOfWeek: ['Paz', 'Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt'],
			monthNames: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
			firstDay: 1
		},
		"cancelClass": "btn-secondary",
		maxYear: parseInt(moment().format('YYYY'), 10)
	});




	TinyMCEInit();
	$('.owl-carousel').owlCarousel({ loop: true, items: 1, });
	$(".sortable").sortable();
	$(".content-container, .image_list_container").on('click', '.remove-btn', function (e) {
		let $data_url = $(this).data("url");
		swal({
			title: 'Emin Misiniz?',
			text: "Bu işlemi geri alamayacaksınız!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Evet, Sil!',
			cancelButtonText: "Hayır"
		}).then(function (result) {
			if (result.value) {
				window.location.href = $data_url;
			}
		})
	})

	$(".content-container, .image_list_container").on('change', '.isActive', function () {
		let $data = $(this).prop("checked");
		let $data_url = $(this).data("url");
		if (typeof $data !== "undefined" && typeof $data_url !== "undefined") {
			$.post($data_url, { data: $data }, function (response) { });
		}
	})
	$(".image_list_container").on('change', '.isCover', function () {
		let $data = $(this).prop("checked");
		let $data_url = $(this).data("url");
		if (typeof $data !== "undefined" && typeof $data_url !== "undefined") {
			$.post($data_url, { data: $data }, function (response) {
				$(".image_list_container").html(response);
				$('[data-switchery]').each(function () {
					let $this = $(this),
						color = $this.attr('data-color') || '#188ae2',
						jackColor = $this.attr('data-jackColor') || '#ffffff',
						size = $this.attr('data-size') || 'default'

					new Switchery(this, {
						color: color,
						size: size,
						jackColor: jackColor
					});
				});
				$(".sortable").sortable();
			});
		}
	})
	$(".content-container, .image_list_container").on("sortupdate", '.sortable', function (event, ui) {
		let $data = $(this).sortable("serialize");
		let $data_url = $(this).data("url");
		$.post($data_url, { data: $data }, function (response) { })
	})
	$(".button_usage_btn").change(function () {
		$(".button-information-container").slideToggle();
	})
	if ($("#dropzone").length > 0) {
		Dropzone.autoDiscover = false;
		let $uploadSection = Dropzone.forElement("#dropzone");
		$uploadSection.on("complete", function (file) {
			//console.log(file);
			let $data_url = $("#dropzone").data("url");
			$.post($data_url, {}, function (response) {
				$(".image_list_container").html(response);
				$('[data-switchery]').each(function () {
					let $this = $(this),
						color = $this.attr('data-color') || '#188ae2',
						jackColor = $this.attr('data-jackColor') || '#ffffff',
						size = $this.attr('data-size') || 'default'

					new Switchery(this, {
						color: color,
						size: size,
						jackColor: jackColor
					});
				});
				$(".sortable").sortable();
			});
		});
	}
});
function TinyMCEInit(height = 300, fullpage = false, selector = '.tinymce') {
	/* TinyMCE */
	if ($("textarea" + selector).length <= 0) { return false; }
	tinymce.remove();
	tinymce.init({
		selector: selector,
		entity_encoding: (fullpage ? "''" : "'raw'"),
		forced_root_block: "",
		paste_auto_cleanup_on_paste: true,
		language: 'tr_TR', // select language
		language_url: 'https://cdn.jsdelivr.net/npm/tinymce-lang/langs/tr_TR.js',
		branding: false,
		image_advtab: true,
		plugins: (fullpage ? "fullpage " : "") + 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable  charmap quickbars emoticons',
		height: height,
		mobile: {
			theme: 'silver'
		},
		setup: function (editor) {
			editor.on('change', function () {
				tinymce.triggerSave();
			});
		}
	});
	/* TinyMCE */
}

function TableInitializerV2(gelentablo, gelendata, gelencolumn, gelenurl, rankUrl, filterSearch = false, aocolumndefs = [
	{ "sClass": "text-center justify-content-center align-middle", "aTargets": "_all" },
	{ "type": 'turkish', "targets": '_all' },
	{ "targets": ['nosort'], "orderable": false, },

]) {

	$('table.' + gelentablo).on('draw.dt', function () {
		$('table.' + gelentablo).DataTable().columns.adjust();
		$('table.' + gelentablo).DataTable().responsive.recalc();

	});
	$('table.' + gelentablo).DataTable({
		"destroy": true,
		"rowReorder": { selector: 'td:nth-child(2)' },
		"renderer": "bootstrap",
		"deferRender": true,
		"stateSave": true,
		"bstateSave": true,
		"responsive": true,
		"dom": (filterSearch === false ? "<'d-flex align-content-center flex-wrap justify-content-between' <'justify-content-start' l><'justify-content-center'r><'justify-content-end'f>>t<'d-flex flex-wrap justify-content-between' <'justify-content-start'i> <'justify-content-end'p>>" : "<'d-flex align-content-center justify-content-between' <'justify-content-start'><'justify-content-center text-center flex-grow-1'r><'justify-content-end'>>t<'d-flex flex-wrap align-content-center justify-content-between' <'justify-content-start text-center' <'pt-2'l>><'justify-content-end text-center'p>><i>"),
		"language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Turkish.json"
		},
		"order": [],
		"aaSorting": [],
		"bSort": true,
		"aoColumnDefs": aocolumndefs,
		columnDefs: [
			{ "sClass": "text-center justify-content-center align-middle", "aTargets": "_all" },
			{ type: 'turkish', targets: '_all' },
			{ targets: ['nosort'], orderable: false, },
		],
		"search": {
			"caseInsensitive": false
		},
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"pageLength": 25,
		"iDisplayLength": 25,
		"lengthMenu": [[25, 50, 100, 250], [25, 50, 100, 250]],
		'ajax': {
			'url': gelenurl,
			'data': gelendata
		},
		//'columns': gelencolumn,
		"rowCallback": function (row, data) {
			if (data.satirrengi !== "" && data.satirrengi !== null) {
				$(row).addClass(data.satirrengi);
			}
			if (data.sutunrengi !== "" && data.sutunrengi !== null && data.sutunindex !== "" && data.sutunindex !== null) {

				$.each(data.sutunrengi, function (key, value) {
					$(row).find('td:eq(' + data.sutunindex + ')').css("background-color", value);
				});
			}
		},
	});
	$('table.' + gelentablo).on("responsive-display", function () {
		$('table.' + gelentablo).DataTable().columns.adjust();
		$('table.' + gelentablo).DataTable().responsive.recalc();
	});
	$('table.' + gelentablo).on("responsive-resize", function () {
		$('table.' + gelentablo).DataTable().columns.adjust();
		$('table.' + gelentablo).DataTable().responsive.recalc();
	});
	$('table.' + gelentablo).DataTable().on('row-reorder', function (e, details) {
		e.preventDefault();
		e.stopImmediatePropagation();
		if (details.length) {
			let rows = [];
			details.forEach(element => {
				let elm = $('table.' + gelentablo).DataTable().row(element.node).data();
				rows.push({
					id: $(elm[1]).data("id"),
					position: element.newData
				});
			});
			$.ajax({
				method: 'POST',
				url: rankUrl,
				data: { rows }
			}).done(function () { $('table.' + gelentablo).DataTable().ajax.reload() });
		}
	});
}

function runScript(e, table) {
	//See notes about 'which' and 'key'
	if (e.keyCode == 13) {
		reloadTable(table);
		return false;
	}
}

function reloadTable(table) {
	$('.' + table).DataTable().ajax.reload(null, false);
}
function clearFilter(form, table) {
	$("#" + form)[0].reset();
	reloadTable(table)
}