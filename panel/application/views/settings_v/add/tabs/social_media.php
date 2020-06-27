<div role="tabpanel" class="tab-pane fade" id="tab-5">
    <div class="row">
        <div class="form-group col-md-8">
            <label>E-posta Adresiniz</label>
            <input class="form-control" placeholder="Şirketinize ait e-posta adresi" name="email" value="<?= isset($form_error) ? set_value("email") : ""; ?>">
            <?php if (isset($form_error)) { ?>
                <small
                class="float-right input-form-error"> <?= form_error("email"); ?></small>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Facebook</label>
            <input class="form-control" placeholder="Facebook Adresiniz" name="facebook" value="<?= isset($form_error) ? set_value("facebook") : ""; ?>">
        </div>
        <div class="form-group col-md-4">
            <label>Twitter</label>
            <input class="form-control" placeholder="Twitter Adresiniz" name="twitter" value="<?= isset($form_error) ? set_value("twitter") : ""; ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Instagram</label>
            <input class="form-control" placeholder="Instagram Adresiniz" name="instagram" value="<?= isset($form_error) ? set_value("instagram") : ""; ?>">
        </div>
        <div class="form-group col-md-4">
            <label>Linkedin</label>
            <input class="form-control" placeholder="Linkedin Adresiniz" name="linkedin" value="<?= isset($form_error) ? set_value("linkedin") : ""; ?>">
        </div>
    </div>
</div>