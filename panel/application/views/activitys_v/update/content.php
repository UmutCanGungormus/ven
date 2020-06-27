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
                    <form action="<?= base_url("activity/update/$item->id"); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Referans Adı</label>
                            <input class="form-control" placeholder="Referans Adı" name="title" value="<?= $item->title; ?>">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("title"); ?></small>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label>Etkinlik Kategori</label>
                            <select class="form-control" name="category_id">
                                <?php foreach ($categories as $category) : ?>
                                    <option <?= ($category->id == $item->category_id ? "selected" : null) ?> value="<?= $category->id ?>"><?= $category->title ?> </option>
                                <?php endforeach ?>
                            </select>
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("category"); ?></small>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label>Etkinlik Mekan</label>
                            <input class="form-control" placeholder="Etkinlik Mekan Adı" value="<?= $item->place; ?>" name="place">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("place"); ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Etkinlik Şehri</label>
                            <input class="form-control" placeholder="Etkinlik Şehri" value="<?= $item->city; ?>" name="city">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("city"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Etkinlik Saati</label>
                            <input class="form-control" type="time" placeholder="Etkinlik Saati" value="<?= $item->hour; ?>" name="hour">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("hour"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Etkinlik Bilet Linki</label>
                            <input class="form-control" placeholder="Etkinlik Bilet Linki" value="<?= $item->url; ?>" name="url">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("url"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="content" class="m-0 tinymce" data-plugin="summernote" data-options="{height: 250}"><?= $item->content; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Detyalar</label>
                            <textarea name="info" class="m-0 tinymce" data-plugin="summernote" data-options="{height: 250}"><?= $item->info; ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="datetimepicker1">Eğitim Tarihi</label>
                                <input type="hidden" name="date" value="<?= $item->date; ?>" id="datetimepicker1" data-plugin="datetimepicker" data-options="{ inline: true, viewMode: 'days', format : 'YYYY-MM-DD HH:mm:ss' }" />
                            </div><!-- END column -->
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