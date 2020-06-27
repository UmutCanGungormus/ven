<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
	<div class="row">
		<div class="col-md-12">
			<h4 class="mb-3">
				Ürün Listesi
				<a href="<?= base_url("product/new_form"); ?>" class="float-right btn btn-outline btn-primary btn-sm"><i class="fa fa-plus"></i>Yeni Ekle</a>
			</h4>
		</div><!-- END column -->
		<div class="col-md-12">
			<div class="widget p-lg">
				<form id="filter_form" onsubmit="return false">
					<div class="d-flex flex-wrap">
						<label for="search" class="flex-fill mx-1">
							<input class="form-control" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'productTable')" name="search">
						</label>
						<label for="clear_button" class="mx-1">
							<button class="btn btn-danger btn-md" onclick="clearFilter('filter_form','productTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
						</label>
						<label for="search_button" class="mx-1">
							<button class="btn btn-success btn-md" onclick="reloadTable('productTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Ürün Ara"><i class="fa fa-search"></i></button>
					</div>
			</div>

			</form>
			<table class="table table-hover table-striped table-bordered content-container productTable">

				<thead>
					<th class=" w50">#</th>
					<th class="order nosort"><i class="fa fa-reorder"></i></th>
					<th>#id</th>
					<th>Başlık</th>
					<th>Kategori</th>
					<th>Görsel</th>
					<th width="10px">Durumu</th>
					<th width="10px">Anasayfa</th>
					<th class="text-center w300 nosort">İşlem</th>
				</thead>
				<tbody>

				</tbody>

			</table>

			<script>
				function obj(d) {
					let appendeddata = {};
					$.each($("#filter_form").serializeArray(), function() {
						d[this.name] = this.value;
					});
					return d;
				}
				$(document).ready(function() {
					TableInitializerV2("productTable", obj, {}, "<?= base_url("product/datatable") ?>", "<?= base_url("product/rankSetter") ?>",true);

				});
			
			</script>
		</div><!-- .widget -->
	</div><!-- END column -->
</div>
</div>