<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                Yeni Portfolyo Ekle
            </h4>
        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-body">
                    <form action="<?= base_url("portfolio/save"); ?>" method="post">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Başlık</label>
                                <input class="form-control" placeholder="İşi anlatan başlık bilgisi" name="title">
                                <?php if (isset($form_error)) : ?>
                                    <small class="float-right input-form-error"> <?= form_error("title"); ?></small>
                                <?php endif ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Kategori</label>
                                <select class="form-control" name="category_id">
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category->id; ?>"><?= $category->title; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?php if (isset($form_error)) : ?>
                                    <small class="float-right input-form-error"> <?= form_error("category_id"); ?></small>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="datetimepicker1">Bitirme Tarihi</label>
                                <input type="text" class="form-control" name="finishedAt" />
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Müşeri</label>
                                    <input class="form-control" placeholder="İşi yaptığınız üşteri" name="client">
                                    <?php if (isset($form_error)) : ?>
                                        <small class="float-right input-form-error"> <?= form_error("client"); ?></small>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Yer/Mekan</label>
                                    <input class="form-control" placeholder="İşi yaptığınız Yer/Mekan bilgisi" name="place">
                                    <?php if (isset($form_error)) : ?>
                                        <small class="float-right input-form-error"> <?= form_error("place"); ?></small>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Yapılan işin Bağlantısı (URL)</label>
                                    <input class="form-control" placeholder="Yapılan işin internet üzerindeki bağlantısı" name="portfolio_url">
                                    <?php if (isset($form_error)) : ?>
                                        <small class="float-right input-form-error"> <?= form_error("portfolio_url"); ?></small>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="form-group">
                <label>Açıklama</label>
                <textarea name="description" class="m-0 tinymce" data-plugin="summernote" data-options="{height: 250}"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
            <a href="<?= base_url("portfolio"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
            </form>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->
</div>

<script>

</script>