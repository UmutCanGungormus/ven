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
                    <form action="<?= base_url("popups/update/$item->id"); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Hedef Sayfa</label>
                            <select name="page" class="form-control">
                                <?php foreach (get_page_list() as $page => $value) : ?>
                                    <?php $page_value =  isset($form_error) ? set_value("page") : $item->page; ?>
                                    <option <?= ($page == $page_value) ? "selected" : ""; ?> value="<?= $page; ?>"><?= $value; ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("page"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Başlık</label>
                            <input class="form-control" placeholder="Başlık" name="title" value="<?= isset($form_error) ? set_value("title") : $item->title; ?>">
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("title"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="description" class="m-0 tinymce" data-plugin="summernote" data-options="{height: 250}"><?= isset($form_error) ? set_value("description") : $item->description; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                        <a href="<?= base_url("popups"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>