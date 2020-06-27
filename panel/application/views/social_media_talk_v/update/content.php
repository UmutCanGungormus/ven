<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                <b><?= $item->id ?></b> kaydını düzenliyorsunuz
            </h4>
        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget">
                <hr class="widget-separator">
                <div class="widget-body">
                    <form action="<?= base_url("social_media_talk/update/$item->id"); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Haber Seç</label>
                            <select class="form-control" name="news_id">
                                <?php foreach ($categories as $category) : ?>
                                    <option <?= ($item->news_id == $category->id ? "selected" : null) ?> value="<?= $category->id ?>"><?= $category->title ?></option>
                                <?php endforeach ?>
                            </select>
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("news_id"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group video_url_container">
                                <label>Widget Title</label>
                                <input class="form-control" placeholder="Başlık Giriniz" value="<?= $item->title?>" name="title">
                            </div>
                        <div class="form-group">
                            <label for="control-demo-6" class="">Widget Türü</label>
                            <div id="control-demo-6" class="">
                                <?php if (isset($form_error)) : ?>
                                    <select class="form-control social_media_talk_type_select" name="social_media_talk_type">
                                        <option <?= ($social_media_talk_type == "image") ? "selected" : ""; ?> value="image">Resim</option>
                                        <option <?= ($social_media_talk_type == "video") ? "selected" : ""; ?> value="video">Video</option>
                                    </select>
                                <?php else : ?>
                                    <select class="form-control social_media_talk_type_select" name="social_media_talk_type">
                                        <option <?= ($item->social_media_talk_type == "image") ? "selected" : ""; ?> value="image">Resim</option>
                                        <option <?= ($item->social_media_talk_type == "video") ? "selected" : ""; ?> value="video">Video</option>
                                    </select>
                                <?php endif ?>

                            </div>
                        </div><!-- .form-group -->
                        <?php if (isset($form_error)) : ?>
                            <div class="form-group image_upload_container" style="display: <?= ($social_media_talk_type == "image") ? "block" : "none"; ?>">
                                <label>Görsel Seçiniz</label>
                                <input type="file" name="img_url" class="form-control">
                            </div>
                            <div class="form-group video_url_container" style="display: <?= ($social_media_talk_type == "video") ? "block" : "none"; ?>">
                                <label>Video Url</label>
                                <input class="form-control" placeholder="Video bağlantısını buraya yapıştırınız." name="video_url">
                                <?php if (isset($form_error)) : ?>
                                    <small class="input-form-error float-right"><?= form_error("video_url"); ?></small>
                                <?php endif ?>
                            </div>
                        <?php else : ?>
                            <div class="row">
                                <div class="col-md-1 image_upload_container" style="display: <?= ($item->social_media_talk_type == "video") ? "none" : "block"; ?>">
                                    <img src="<?= get_picture($viewFolder, $item->img_url, "370x297"); ?>" class="img-fluid">
                                </div>
                                <div class="col-md-9 form-group image_upload_container" style="display: <?= ($item->social_media_talk_type == "image") ? "block" : "none"; ?>">
                                    <label>Görsel Seçiniz</label>
                                    <input type="file" name="img_url" class="form-control">
                                </div>
                            </div>
                            <div class="form-group video_url_container" style="display: <?= ($item->social_media_talk_type == "video") ? "block" : "none"; ?>">
                                <label>Video Url</label>
                                <input class="form-control" placeholder="Video bağlantısını buraya yapıştırınız." name="video_url" value="<?= $item->video_url; ?>">
                            </div>
                        <?php endif ?>

                        <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                        <a href="<?= base_url("social_media_talk"); ?>" class="btn btn-md btn-danger btn-outlinen">İptal</a>
                    </form>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
</div>