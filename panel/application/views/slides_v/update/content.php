<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                <b><?= $item->title ?></b> kaydını düzenliyorsunuz
            </h4>
        </div>
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-body">
                    <form action="<?= base_url("slides/update/$item->id"); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Başlık</label>
                            <input class="form-control" placeholder="Başlık" name="title" value="<?= $item->title; ?>">
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("title"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="description" class="m-0 tinymce"  data-plugin="summernote" data-options="{height: 250}"><?= $item->description; ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-1 image_upload_container">
                                <img src="<?= get_picture($viewFolder, $item->img_url, "857x505"); ?>" alt="" class="img-responsive">
                            </div>
                            <div class="col-md-9 form-group image_upload_container">
                                <label>Görsel Seçiniz</label>
                                <input type="file" name="img_url" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Buton Kullanımı</label><br>
                            <input class="form-control button_usage_btn" type="checkbox" data-switchery name="allowButton" <?= ($item->allowButton) ? "checked" : ""; ?> data-color="#10c469" />
                        </div>
                        <div class="button-information-container" style="display : <?= ($item->allowButton) ? "block" : "none"; ?>">
                            <div class="form-group">
                                <label>Buton Başlık</label>
                                <input class="form-control" placeholder="Butonun üzerindeki yazı" name="button_caption" value="<?= $item->button_caption; ?>">
                                <?php if (isset($form_error)) : ?>
                                    <small class="float-right input-form-error"> <?= form_error("button_caption"); ?></small>
                                <?php endif ?>
                            </div>
                            <div class="form-group">
                                <label>URL Bilgisi</label>
                                <input class="form-control" placeholder="Butona basıldığında gidilecek olan URL Bilgisi" name="button_url" value="<?= $item->button_url; ?>">
                                <?php if (isset($form_error)) : ?>
                                    <small class="float-right input-form-error"> <?= form_error("button_url"); ?></small>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Slider Dili</label>
                            <select class="form-control" name="language">
                                <?php if ($item->language == "TR") : ?>
                                    <option selected="selected" value="TR">TR (Türkçe/Turkish)</option>
                                    <option value="EN">EN (İngilizce/English)</option>
                                    <option value="DE">DE (Almanca/German)</option>
                                <?php elseif ($item->language == "EN") : ?>
                                    <option value="TR">TR (Türkçe/Turkish)</option>
                                    <option selected="selected" value="EN">EN (İngilizce/English)</option>
                                    <option value="DE">DE (Almanca/German)</option>
                                <?php else : ?>
                                    <option value="TR">TR (Türkçe/Turkish)</option>
                                    <option value="EN">EN (İngilizce/English)</option>
                                    <option selected="selected" value="DE">DE (Almanca/German)</option>
                                <?php endif ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                        <a href="<?= base_url("slides"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>