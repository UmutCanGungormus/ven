<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                E-Posta Listesi
                <a href="<?= base_url("emailsettings/new_form"); ?>" class="float-right btn btn-outline btn-primary btn-sm"><i class="fa fa-plus"></i>Yeni Ekle</a>
            </h4>
        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget p-lg">
                <?php if (empty($items)) : ?>
                    <div class="alert alert-info text-center">
                        <h5 class="alert-title">Kayıt Bulunamadı</h5>
                        <p>Burada herhangi bir veri bulunmamaktadır. Ekleme için lütfen <a href="<?= base_url("emailsettings/new_form"); ?>">tıklayınız...</a></p>
                    </div>
                <?php else : ?>
                    <form id="filter_form" onsubmit="return false">
					<div class="d-flex flex-wrap">
						<label for="search" class="flex-fill mx-1">
							<input class="form-control" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'emailTable')" name="search">
						</label>
						<label for="clear_button" class="mx-1">
							<button class="btn btn-danger btn-md" onclick="clearFilter('filter_form','emailTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
						</label>
						<label for="search_button" class="mx-1">
							<button class="btn btn-success btn-md" onclick="reloadTable('emailTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Ürün Ara"><i class="fa fa-search"></i></button>
					</div>
			</div>

			</form>
                    <table class="table table-hover table-striped table-bordered content-container emailTable">

                        <thead>
                            <th class="w50">#id</th>
                            <th>E-Posta Başlık</th>
                            <th>Sunucu Adı</th>
                            <th>E-Posta</th>
                            <th>Kimden</th>
                            <th>Kime</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </thead>
                        <tbody>
                           
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
					TableInitializerV2("emailTable", obj, {}, "<?= base_url("emailsettings/datatable") ?>", "<?= base_url("emailsettings/rankSetter") ?>",true);

				});
			
			</script>