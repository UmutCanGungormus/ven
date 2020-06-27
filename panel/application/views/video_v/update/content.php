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
                    <form action="<?= base_url("video/update/$item->id"); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Albüm & Single Adı</label>
                            <input class="form-control" placeholder="Albüm & Single Adı" name="title" value="<?= $item->title; ?>">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("title"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Yapımcı</label>
                            <input class="form-control" placeholder="Yapımcı" name="producer" value="<?= $item->producer; ?>">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("producer"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Çıkış Yılı</label>
                            <input class="form-control" placeholder="Çıkış Yılı" name="release_year" value="<?= $item->release_year; ?>">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("release_year"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="content" class="m-0 tinymce" ><?= $item->content; ?></textarea>
                        </div>

                </div><!-- .form-group -->
                <?php if (isset($form_error)) : ?>
                    <div class="form-group ">
                        <label>Görsel Seçiniz</label>
                        <input type="file" name="img_url" class="form-control">
                    </div>
                    <div class="form-group ">
                        <label>Video Url</label>
                        <input class="form-control" placeholder="Video bağlantısını buraya yapıştırınız." name="video_url">
                        <?php if (isset($form_error)) : ?>
                            <small class="input-form-error float-right"><?= form_error("video_url"); ?></small>
                        <?php endif ?>
                    </div>
                <?php else : ?>
                    <div class="row">
                        <div class="col-md-1 ">
                            <img src="<?= get_picture($viewFolder, $item->img_url, "370x297"); ?>" class="img-fluid">
                        </div>
                        <div class="col-md-9 form-group ">
                            <label>Görsel Seçiniz</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label>Video Url</label>
                        <input class="form-control" placeholder="Video bağlantısını buraya yapıştırınız." name="video_url" value="<?= $item->video_url; ?>">
                    </div>
                <?php endif ?>

                <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                <a href="<?= base_url("video"); ?>" class="btn btn-md btn-danger btn-outlinen">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>
</div>