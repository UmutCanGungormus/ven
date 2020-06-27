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
                    <form action="<?= base_url("product_option_category/update/$item->id"); ?>" method="post">
                        <div class="form-group">
                            <label>Başlık </label>
                            <input class="form-control" placeholder="Başlık" name="title" value="<?= $item->title; ?>">
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("title"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Üst Kategori</label>
                            <select class="form-control" name="ust_id">
                                <option <?= ($item->ust_id == 0 ? "selected" : null) ?> value="0">Ana Kategori</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option <?= ($item->ust_id == $category->id ? "selected" : null) ?> value="<?= $category->id; ?>"><?= $category->title; ?></option>
                                <?php endforeach ?>
                            </select>
                            <?php if (isset($form_error)) { ?>
                                <small class="float-right input-form-error"> <?= form_error("category_id"); ?></small>
                            <?php } ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                        <a href="<?= base_url("product_option_category"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>