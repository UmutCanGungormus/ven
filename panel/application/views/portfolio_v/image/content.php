<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-body">
                    <form data-url="<?= base_url("portfolio/refresh_image_list/$item->id"); ?>" action="<?= base_url("portfolio/image_upload/$item->id"); ?>" id="dropzone" class="dropzone" data-plugin="dropzone" data-options="{ url: '<?= base_url("portfolio/image_upload/$item->id"); ?>'}">
                        <div class="dz-message">
                            <h3 class="m-h-lg">Yüklemek istediğiniz resimleri buyara sürükleyiniz</h3>
                            <p class="mb-3 text-muted">(Yüklemek için dosyalarınızı sürükleyiniz yada buraya tıklayınız)</p>
                        </div>
                    </form>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                <b><?= $item->title; ?></b> kaydına ait Resimler
            </h4>
        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-body image_list_container">
                    <?php $this->load->view("{$viewFolder}/{$subViewFolder}/render_elements/image_list_v"); ?>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
</div>