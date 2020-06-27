<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                Yeni Slayt Ekle
            </h4>
        </div>
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-body">
                    <form action="<?= base_url("slides/save"); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Başlık</label>
                            <input class="form-control" placeholder="Başlık" name="title">
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("title"); ?></small>
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
                        <div class="custom-control custom-switch form-group">
                            <input type="checkbox" checked class="button_usage_btn custom-control-input" id="customSwitch1">
                            <label class="custom-control-label " for="customSwitch1">Buton Kullanımı</label>
                        </div>
                        
                        <div class="button-information-container">
                            <div class="form-group">
                                <label>Buton Başlık</label>
                                <input class="form-control" placeholder="Butonun üzerindeki yazı" name="button_caption">
                                <?php if (isset($form_error)) : ?>
                                    <small class="float-right input-form-error"> <?= form_error("button_caption"); ?></small>
                                <?php endif ?>
                            </div>
                            <div class="form-group">
                                <label>URL Bilgisi</label>
                                <input class="form-control" placeholder="Butona basıldığında gidilecek olan URL Bilgisi" name="button_url">
                                <?php if (isset($form_error)) : ?>
                                    <small class="float-right input-form-error"> <?= form_error("button_url"); ?></small>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Slider Dili</label>
                            <select class="form-control" name="language">
                                <option value="TR">TR (Türkçe/Turkish)</option>
                                <option value="EN">EN (İngilizce/English)</option>
                                <option value="DE">DE (Almanca/German)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                        <a href="<?= base_url("slides"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>