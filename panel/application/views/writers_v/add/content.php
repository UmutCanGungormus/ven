<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                Yeni Yazar / Editör Ekle
            </h4>
        </div>
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-body">
                    <form action="<?= base_url("writers/save"); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Ad Soyad</label>
                            <input class="form-control" placeholder="Ad Soyad" name="name">
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("name"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Görevi</label>
                            <input class="form-control" placeholder="Görevi" name="type">
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("type"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>E-Mail</label>
                            <input class="form-control" type="email" placeholder="E-Mail" name="email">
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("email"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Şifre</label>
                            <input class="form-control" type="password" placeholder="****" name="password">
                            <?php if (isset($form_error)) : ?>
                                <small class="float-right input-form-error"> <?= form_error("password"); ?></small>
                            <?php endif ?>
                        </div>
                        <div class="form-group image_upload_container">
                            <label>Görsel Seçiniz</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                        <a href="<?= base_url("writers"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>