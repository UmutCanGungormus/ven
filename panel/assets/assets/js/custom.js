$(document).ready(function () {
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

function TableInitializerV2(gelentablo, gelendata, gelencolumn, gelenurl, filterSearch = false, aocolumndefs = [
	{ "sClass": "text-center justify-content-center align-middle", "aTargets": "_all" },
	{ "type": 'turkish', "targets": '_all' },
	{ "targets": ['nosort'], "orderable": false, },
]) {

	$('table.' + gelentablo).on('draw.dt', function () {
		$('table.' + gelentablo).DataTable().columns.adjust();
		$('table.' + gelentablo).DataTable().responsive.recalc();
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
		"lengthMenu": [[25, 50, 100, 250, 500, 1000, 2000, 5000, -1], [25, 50, 100, 250, 500, 1000, 2000, 5000, "Tümü"]],
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
	$('table.' + gelentablo).on('row-reorder.dt', function (dragEvent, data, nodes) {
		let Postdata;
		for (let i = 0, ien = data.length; i < ien; i++) {
			let rowData = $('table.' + gelentablo).DataTable().row(data[i].node).data();
			let getId = $(rowData[1]).data("id");
			$.ajax({
				type: "POST",
				cache: false,
				url: window.location.origin + '/mypanel/product/rankSetter',
				data: { Id: getId, toPosition: data[i].newPosition },
				dataType: "json"
			}).done(function () {
				$('table.' + gelentablo).DataTable().ajax.reload(null, false);
			});
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