<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
	<div class="row">
		<div class="col-md-12">
			<h4 class="mb-3">
				Haber Listesi
				<a href="<?= base_url("news/new_form"); ?>" class="float-right btn btn-outline btn-primary btn-sm"><i class="fa fa-plus"></i>Yeni Ekle</a>
			</h4>
		</div><!-- END column -->
		<div class="col-md-12">
			<div class="widget p-lg">
				<?php if (empty($items)) : ?>
					<div class="alert alert-info text-center">
						<h5 class="alert-title">Kayıt Bulunamadı</h5>
						<p>Burada herhangi bir veri bulunmamaktadır. Ekleme için lütfen <a href="<?= base_url("news/new_form"); ?>">tıklayınız...</a></p>
					</div>
				<?php else : ?>
					<form id="filter_form" onsubmit="return false">
						<div class="d-flex flex-wrap">
							<label for="search" class="flex-fill mx-1">
								<input class="form-control" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'newsTable')" name="search">
							</label>
							<label for="clear_button" class="mx-1">
								<button class="btn btn-danger btn-md" onclick="clearFilter('filter_form','newsTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
							</label>
							<label for="search_button" class="mx-1">
								<button class="btn btn-success btn-md" onclick="reloadTable('newsTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Ürün Ara"><i class="fa fa-search"></i></button>
						</div>
			</div>

			</form>
			<table class="table table-hover table-striped table-bordered content-container newsTable">

				<thead>
					<th class="order"><i class="fa fa-reorder"></i></th>
					<th class="order"><i class="fa fa-reorder"></i></th>
					<th class="w50">#id</th>
					<th>Başlık</th>

					<!--<th>Açıklama</th>-->
					<th>Görsel</th>
					<th>Durumu</th>
					<th>İşlem</th>
				</thead>
				<tbody class="sortable" data-url="<?= base_url("news/rankSetter"); ?>">

				</tbody>

			</table>
		<?php endif ?>
		</div><!-- .widget -->
	</div><!-- END column -->
</div>
</div>
<script>
	function obj(d) {
		let appendeddata = {};
		$.each($("#filter_form").serializeArray(), function() {
			d[this.name] = this.value;
		});
		return d;
	}
	$(document).ready(function() {
		TableInitializerV2("newsTable", obj, {}, "<?= base_url("news/datatable") ?>", "<?= base_url("news/rankSetter") ?>", true);

	});
</script>