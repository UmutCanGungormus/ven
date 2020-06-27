<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                Yeni Ürün Opsiyon Ekle
            </h4>

        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget">
                <hr class="widget-separator">
                <div class="widget-body">
                    <div class="table-responsive">
                        <form onsubmit="return false" enctype="multipart/form-data">

                            <table class="optionTable table table-striped table-bordered table-hover">
                                <thead>
                                    <tr class="optionTr">
                                        <td>Satır Ekle</td>
                                        <td>Satır Sil</td>
                                        <td>Ürün</td>
                                        <td>Varyasyon Kategori</td>
                                        <td>Varyasyon</td>
                                        <td>Varyasyon Adı</td>
                                        <td>Fiyat</td>
                                        <td>Resim</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><button class="plus btn btn-success"><i class="fa fa-plus"></i></button></td>
                                        <td><button class="minus btn btn-danger"><i class="fa fa-minus"></i></button></td>
                                        <td><input type="hidden" class="autocomplete" value="<?= $product->id ?>" name="product_id[]"><?= $product->title ?></td>
                                        <td><select class="form-control" name="options_category[]">
                                                <?php foreach ($option_categories as $category) { ?>
                                                    <option value="<?= $category->id ?>"><?= $category->title ?></option>

                                                <?php } ?>
                                            </select></td>
                                        <td><select class="form-control" name="options[]">
                                                <?php foreach ($options as $option) { ?>
                                                    <option value="<?= $option->id ?>"><?= $option->title ?></option>

                                                <?php } ?>
                                            </select></td>
                                        <td><input class="form-control" type="text" name="stocks[]"></td>
                                        <td><input class="form-control" type="text" name="prices[]"></td>
                                        <td><input type="file" class="form-control"  name="photos[]"><input type="hidden" name="photosCounter[]" value=""></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <button class="product_option btn btn-primary">Varyasyonları Ekle</button>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on("click", ".plus", function() {
            $this = $(this);
            let tr = $this.closest("tr").clone();
            $(".optionTable>tbody").append(tr)
        });
        $(document).on("click", ".minus", function() {

            if ($(".optionTable>tbody>tr").length > 1) {
                $this = $(this);
                let tr = $this.closest("tr").remove();
            }
        });
        $(document).on("change", "input[name='photos[]']", function() {
            let filesCount = $(this)[0].files.length;
            let closest = $(this).closest("td").find("input[name='photosCounter[]']");
            $(closest).val(filesCount);
        });
    });

    function get_data() {
        let formData = new FormData();
        $("input[name='product_id[]']").each(function() {
            formData.append('product_id', $(this).val());
        });
        $("select[name='options_category[]']").each(function() {
            formData.append('options[]', $(this).val());
        });
        $("select[name='options[]']").each(function() {
            formData.append('options_category[]', $(this).val());
        });
        $("input[name='stocks[]']").each(function() {
            formData.append('stocks[]', $(this).val());
        });
        $("input[name='prices[]']").each(function() {
            formData.append('prices[]', $(this).val());
        });
        $("input[name='photos[]']").each(function() {
            $.each($(this)[0].files, function(i, file) {
                formData.append('photos[]', file);
            });
        });
        $("input[name='photosCounter[]']").each(function() {
            formData.append('photosCounter[]', $(this).val());
        });


        return formData;
    }

    $(document).on("click", ".product_option", function() {
        let product_w_options = get_data();
        

        $.ajax({
            url: window.location.origin + '/ven/panel/product_option/umut',

            type: 'POST',
            cache: false,
            dataType:"JSON",
            contentType: false,
            processData: false,
            data:  product_w_options
        }).done(function() {
            alert();
        });
    });
</script>