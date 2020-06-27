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
                    <form action="<?= base_url("cinema/update/$item->id"); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Film Adı</label>
                            <input class="form-control" placeholder="Kitap Adı" name="title" value="<?= $item->title; ?>">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("title"); ?></small>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label>Film Türü</label>
                            <select class="form-control selectpicker" size="4" multiple name="category_id[]">
                                <?php foreach ($categories as $category) : ?>
                                    <option <?php foreach (json_decode($item->category_id) as $cat) : ($category->id == $cat ? "selected" : null) ?> value="<?= $category->id ?>"><?= $category->title ?> </option>
                                <?php endforeach ?>
                            <?php endforeach ?>
                            </select>
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("category"); ?></small>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label>Film Dili</label>
                            <input class="form-control" placeholder="Film Dili" value="<?= $item->language; ?>" name="language">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("language"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label> Yönetmen</label>
                            <input class="form-control" placeholder="Yönetmen" value="<?= $item->director; ?>" name="director">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("director"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Senarist</label>
                            <input class="form-control" type="text" placeholder="Senarist" value="<?= $item->scriptwriter; ?>" name="scriptwriter">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("scriptwriter"); ?></small>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label>Yapım</label>
                            <input class="form-control" placeholder="Yapım" value="<?= $item->production; ?>" name="production">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("production"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Oyuncular</label>
                            <input class="form-control" placeholder="Oyuncular" value="<?= $item->players; ?>" name="players">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("players"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Bilet Alma Linki</label>
                            <input class="form-control" placeholder="Bilet Alma Linki" value="<?= $item->url; ?>" name="url">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("url"); ?></small>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label>Detyalar</label>
                            <textarea name="content" class="m-0 tinymce" data-plugin="summernote" data-options="{height: 250}"><?= $item->content; ?></textarea>
                        </div>
                        <div class="row">

                            <div class="col-md-1 image_upload_container">
                                <img src="<?= get_picture($viewFolder, $item->img_url, "255x157"); ?>" class="img-fluid">
                            </div>
                            <div class="col-md-7 form-group image_upload_container">
                                <label>Görsel Seçiniz</label>
                                <input type="file" name="img_url" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                        <a href="<?= base_url("cinema"); ?>" class="btn btn-md btn-danger btn-outlinen">İptal</a>
                    </form>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
</div>