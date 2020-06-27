<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                Yeni Haber İçi Widget Ekle
            </h4>
        </div>
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-body">
                    <form action="<?= base_url("news_box/save"); ?>" method="post">
                    <div class="form-group">
                        <label>Widget Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                        <div class="form-group">
                            <label>Eklenecek Olan Widget </label>
                            <select class="selectpicker form-control" name="added_news_id" data-show-subtext="true" data-live-search="true">
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category->id ?>"><?= $category->title ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Widget Eklenecek Haber </label>
                            <select class="selectpicker form-control" name="which_news_id" data-show-subtext="true" data-live-search="true">
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category->id ?>"><?= $category->title ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                        <a href="<?= base_url("news_box"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>