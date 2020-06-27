<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                Yeni Film Ekle
            </h4>
        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget">
                <hr class="widget-separator">
                <div class="widget-body">
                    <form action="<?= base_url("cinema/save"); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                        
                            <label>Kitap Kategori</label>
                            <select name="category_id[]" class="form-control js-example-responsive" multiple="multiple"  size="4" >
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category->id ?>"><?= $category->title ?> </option>
                                <?php endforeach ?>
                            </select>
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("category"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Orjinal Adı</label>
                            <input class="form-control" placeholder="Orjinal Adı" name="title">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("title"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Film Dili</label>
                            <input class="form-control" placeholder="Film Dili" name="language">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("language"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Yönetmen</label>
                            <input class="form-control" placeholder="Yönetmen" name="director">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("director"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Senarist</label>
                            <input class="form-control" placeholder="Senarist" name="scriptwriter">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("scriptwriter"); ?></small>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label>Yapım</label>
                            <input class="form-control" placeholder="Yapım" name="production">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("production"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Oyuncular</label>
                            <input class="form-control" placeholder="Oyuncular" name="players">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("players"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Bilet Alma Linki</label>
                            <input class="form-control" placeholder="Bilet Alma Linki" name="url">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("url"); ?></small>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="content" id="editor" class="m-0 tinymce" ></textarea>
                        </div>
                        <div class="row">

                            <div class="form-group image_upload_container col-md-8">
                                <label>Görsel Seçiniz</label>
                                <input type="file" name="img_url" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                        <a href="<?= base_url("cinema"); ?>" class="btn btn-md btn-danger btn-outlinen">İptal</a>
                    </form>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
</div>
