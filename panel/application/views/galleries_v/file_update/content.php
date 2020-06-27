<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                <img src="<?= base_url("uploads/galleries_v/images/$gallery->folder_name/350x216/"), $item->url ?>" alt="">
                <br>
                <br>
                <b>kaydını düzenliyorsunuz</b>
            </h4>
        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget">
                <hr class="widget-separator">
                <div class="widget-body">
                    <form action="<?= base_url("galleries/file_update/$item->id/$category"); ?>" method="post">
                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="description" class="m-0 tinymce" data-plugin="summernote" data-options="{height: 250}"><?= $item->description ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                        <a href="<?= base_url("galleries"); ?>" class="btn btn-md btn-danger btn-outlinen">İptal</a>
                    </form>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
</div>