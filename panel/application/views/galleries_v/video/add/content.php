<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                Yeni Video Ekle
            </h4>
        </div>
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-body">
                    <form action="<?= base_url("galleries/gallery_video_save/$gallery_id"); ?>" method="post">
                        <div class="form-group">
                            <label>Video URL</label>
                            <input class="form-control" placeholder="Video bağlantısını (id) buraya yapıştırınız" name="url">
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("url"); ?></small>
                            <?php endif ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                        <a href="<?= base_url("galleries/gallery_video_list/$gallery_id"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>