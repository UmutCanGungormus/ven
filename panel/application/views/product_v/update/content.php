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
                    <form action="<?= base_url("product/update/$item->id"); ?>" method="post">
                        <div class="form-group">
                            <label>Ürün Adı</label>
                            <input class="form-control" placeholder="Ürün Adı" name="title" value="<?= $item->title; ?>">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("title"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="category_id">
                                <?php foreach ($categories as $category) : ?>
                                    <?php $category_id = isset($form_error) ? set_value("category_id") : $item->category_id; ?>
                                    <option <?= ($category->id === $category_id) ? "selected" : ""; ?> value="<?= $category->id; ?>"><?= $category->title; ?></option>
                                <?php endforeach ?>
                            </select>
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("category_id"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Ürün Fiyat</label>
                            <input type="number" min="0.00" max="10000.00" step="0.10" value="<?= $item->price?>"class="form-control" placeholder="Ürün Fiyatı" name="price">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("price"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="description" class="m-0 tinymce" data-plugin="summernote" data-options="{height: 250}"><?= $item->description; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                        <a href="<?= base_url("product"); ?>" class="btn btn-md btn-danger btn-outlinen">İptal</a>
                    </form>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
</div>