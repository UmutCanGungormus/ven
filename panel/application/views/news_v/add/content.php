<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                Yeni Haber Ekle

            </h4>
        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget">
                <hr class="widget-separator">
                <div class="widget-body">
                    <form action="<?= base_url("news/save"); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Haber Adı</label>
                            <input class="form-control" placeholder="Haber Adı" name="title">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("title"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="content" class="m-0 tinymce" data-plugin="summernote" data-options="{height: 250}"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Haber Kategori</label>
                            <select class="form-control" name="category_id">

                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category->id; ?>"><?= $category->title; ?></option>
                                <?php endforeach ?>
                            </select>
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("category_id"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <div class="alert alert-info">Not:Her Etiket Kelimesi Yazıldıktan Sonra Virgül Yada Enter Tuşuna Basın!</div>

                            <label>Haber Etiketleri</label>
                            <input type="text" name="tags" class="form-control" >
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right js-example-tokenizer"><?= form_error("title"); ?></small>
                            <?php endif ?>
                        </div>
                                


                        <div class="form-group">
                            <label>Yazar / Editör</label>
                            <select class="form-control" name="writer_id">

                                <?php foreach ($writers as $category) : ?>
                                    <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                                <?php endforeach ?>
                            </select>
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("writer_id"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Emoji</label>
                            <select class="form-control" name="emoji">
                                <option value="cok-iyi">Kahkaha</option>

                                <option value="yerim">Kalpli Göz</option>
                                <option value="rocket">Roket</option>
                            </select>
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("emoji"); ?></small>
                            <?php endif ?>
                        </div>

                        <?php if (isset($form_error)) : ?>
                            <div class="form-group ">
                                <label>Görsel Seçiniz</label>
                                <input type="file" name="img_url" class="form-control">
                            </div>
                            <div class="form-group ">
                                <label>Video Url</label>
                                <input class="form-control" placeholder="Video bağlantısını buraya yapıştırınız." name="video_url">
                                <?php if (isset($form_error)) : ?>
                                    <small class="input-form-error float-right"><?= form_error("video_url"); ?></small>
                                <?php endif ?>
                            </div>
                        <?php else : ?>
                            <div class="form-group ">
                                <label>Görsel Seçiniz</label>
                                <input type="file" name="img_url" class="form-control">
                            </div>
                            <div class="form-group ">
                                <label>Video Url</label>
                                <input class="form-control" placeholder="Video bağlantısını buraya yapıştırınız." name="video_url">
                            </div>
                        <?php endif ?>

                        <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                        <a href="<?= base_url("news"); ?>" class="btn btn-md btn-danger btn-outlinen">İptal</a>
                    </form>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
</div>