<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                Yeni Soru Şıkkı Ekle
            </h4>
        </div>
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-body">
                    <form action="<?= base_url("options/save"); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Başlık</label>
                            <input class="form-control" placeholder="Başlık" name="title">
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("title"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group image_upload_container">
                            <label>Görsel Seçiniz</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Test Seç</label>
                            <select class="form-control" name="test_id">
                                <option value="0">Seçiniz</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category->id; ?>"><?= $category->title; ?></option>
                                <?php endforeach ?>
                            </select>
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("category_id"); ?></small>
                            <?php endif ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                        <a href="<?= base_url("options"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>