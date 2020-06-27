<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                <b><?= $item->title ?></b> kaydını düzenliyorsunuz
            </h4>
        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget">
                <hr class="widget-separator">
                <div class="widget-body">
                    <form action="<?= base_url("advertisement/update/$item->id/?type=estate"); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>İlan Başlığı</label>
                            <input class="form-control" value="<?= $item->title ?>" placeholder="İlan Başlığı" name="title">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("title"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Şehir </label>
                            <input class="form-control" value="<?= $item->city ?>" placeholder="Şehir" name="city">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("city"); ?></small>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label>Sektör </label>
                            <input class="form-control" value="<?= $item->sector ?>" placeholder="Sektör" name="sector">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("sector"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Firma Adı</label>
                            <input class="form-control" value="<?= $item->company_name ?>" placeholder="Firma Adı" name="company_name">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("company_name"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>İlan Şekli</label>
                            <input class="form-control" value="<?= $item->estate_type ?>" placeholder="İlan Şekli" name="estate_type">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("estate_type"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Ücret</label>
                            <input class="form-control" value="<?= $item->payment ?>" placeholder="Ücret" name="payment">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("payment"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>İlana Dahil Olanlar</label>
                            <input class="form-control" value="<?= $item->advertisement_in ?>" placeholder="İlana Dahil Olanlar" name="advertisement_in">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("advertisement_in"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>İlana Sahibi</label>
                            <input class="form-control" value="<?= $item->advertisement_owner ?>" placeholder="İlana Sahibi" name="advertisement_owner">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("advertisement_owner"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>İlan Linki</label>
                            <input class="form-control" value="<?= $item->url ?>" placeholder="İlan Linki" name="url">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("url"); ?></small>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="content" class="m-0 tinymce" data-plugin="summernote" data-options="{height: 250}"> <?= $item->content ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-1 image_upload_container">
                                <img src="<?= get_picture($viewFolder, $item->img_url, "255x157"); ?>" class="img-fluid">
                            </div>
                            <div class="col-md-7 form-group image_upload_container">
                                <label>Görsel Seçiniz</label>
                                <input type="file" name="img_url" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                        <a href="<?= base_url("activity"); ?>" class="btn btn-md btn-danger btn-outlinen">İptal</a>
                    </form>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
</div>