<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                Haber İçi Widget Listesi
                <a href="<?= base_url("news_box/new_form"); ?>" class="btn btn-outline btn-primary btn-sm float-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
            </h4>
        </div>
        <div class="col-md-12">
            <div class="widget p-lg">
                <?php if (empty($items)) : ?>
                    <div class="alert alert-info text-center">
                        <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a href="<?= base_url("news_box/new_form"); ?>">tıklayınız</a></p>
                    </div>
                <?php else : ?>
                    <form id="filter_form" onsubmit="return false">
                        <div class="d-flex flex-wrap">
                            <label for="search" class="flex-fill mx-1">
                                <input class="form-control" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'widgetTable')" name="search">
                            </label>
                            <label for="clear_button" class="mx-1">
                                <button class="btn btn-danger btn-md" onclick="clearFilter('filter_form','widgetTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
                            </label>
                            <label for="search_button" class="mx-1">
                                <button class="btn btn-success btn-md" onclick="reloadTable('widgetTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Ürün Ara"><i class="fa fa-search"></i></button>
                        </div>
            </div>

            </form>
            <table class="table table-hover table-striped table-bordered content-container widgetTable">
                <thead>
                    <th class="order"><i class="fa fa-reorder"></i></th>
                    <th class="order nosort"><i class="fa fa-reorder"></i></th>
                    <th class="w50">#id</th>
                    <th>Widget Başlık</th>
                    <th>Widget Olan Haber</th>
                    <th>Widget Ekelenen Haber</th>
                    <th>Durumu</th>
                    <th>İşlem</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        <?php endif ?>
        </div>
    </div>
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
        TableInitializerV2("widgetTable", obj, {}, "<?= base_url("news_box/datatable") ?>", "<?= base_url("news_box/rankSetter") ?>", true);

    });
</script>