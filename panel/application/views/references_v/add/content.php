<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                Yeni Ülke Ekle
            </h4>
        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget">
                <hr class="widget-separator">
                <div class="widget-body">
                    <form action="<?= base_url("references/save"); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Ülke Adı</label>
                            <input class="form-control" placeholder="Ülke Adı" name="title">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("title"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="description" class="m-0 tinymce" data-plugin="summernote" data-options="{height: 250}"></textarea>
                        </div>
                        <div class="form-group image_upload_container">
                            <label>Görsel Seçiniz</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Dil</label>
                            <select class="form-control" name="language">
                                <option value="TR">TR (Türkçe/Turkish)</option>
                                <option value="EN">EN (İngilizce/English)</option>
                                <option value="DE">DE (Almanca/German)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                        <a href="<?= base_url("references"); ?>" class="btn btn-md btn-danger btn-outlinen">İptal</a>
                    </form>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
</div>