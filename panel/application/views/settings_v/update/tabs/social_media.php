<div role="tabpanel" class="tab-pane fade p-4" id="tab-5">
    <div class="row">
        <div class="form-group col-md-8">
            <label>E-posta Adresiniz</label>
            <input class="form-control" placeholder="Şirketinize ait e-posta adresi" name="email" value="<?= isset($form_error) ? set_value("email") : $item->email; ?>">
            <?php if (isset($form_error)) { ?>
                <small
                class="float-right input-form-error"> <?= form_error("email"); ?></small>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Facebook (Sadece Kullanıcı Adı Giriniz...)</label>
            <input class="form-control" placeholder="Facebook Adresiniz" name="facebook" value="<?= isset($form_error) ? set_value("facebook") : $item->facebook; ?>">
        </div>
        <div class="form-group col-md-4">
            <label>Twitter (Sadece Kullanıcı Adı Giriniz...)</label>
            <input class="form-control" placeholder="Twitter Adresiniz" name="twitter" value="<?= isset($form_error) ? set_value("twitter") : $item->twitter; ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Instagram (Sadece Kullanıcı Adı Giriniz...)</label>
            <input class="form-control" placeholder="Instagram Adresiniz" name="instagram" value="<?= isset($form_error) ? set_value("instagram") : $item->instagram; ?>">
        </div>
        <div class="form-group col-md-4">
            <label>Linkedin (Sadece Kullanıcı Adı Giriniz...)</label>
            <input class="form-control" placeholder="Linkedin Adresiniz" name="linkedin" value="<?= isset($form_error) ? set_value("linkedin") : $item->linkedin; ?>">
        </div>
    </div>
</div>