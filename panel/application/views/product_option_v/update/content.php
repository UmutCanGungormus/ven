<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                <b><?= get_news_title($item->added_news_id) ?></b> widget kaydını düzenliyorsunuz
            </h4>
        </div>
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-body">
                    <form action="<?= base_url("product_option/update/$item->id"); ?>" method="post">
                    <div class="form-group">
                        <label>Varyasyon Title</label>
                        <input type="text" class="form-control" value="<?=$item->title?>" name="title">
                    </div>
                    
                        <div class="form-group">
                            <label>Varyasyon Eklenecek Kategori </label>
                            <select class="selectpicker form-control" name="category_id" data-show-subtext="true" data-live-search="true">
                                <?php foreach ($categories as $category) : ?>
                                    <option <?= ($item->category_id == $category->id ? "selected" : null) ?> value="<?= $category->id ?>"><?= $category->title ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                        <a href="<?= base_url("product_option"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>