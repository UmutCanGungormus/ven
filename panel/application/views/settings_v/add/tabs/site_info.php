<div role="tabpanel" class="tab-pane in active fade" id="tab-1">
    <div class="row">
        <div class="form-group col-md-8">
            <label>Şirket Adı</label>
            <input class="form-control" placeholder="Şirketin ya da Sitenizin adı" name="company_name" value="<?= isset($form_error) ? set_value("company_name") : ""; ?>">
            <?php if (isset($form_error)) { ?>
                <small
                class="float-right input-form-error"> <?= form_error("company_name"); ?></small>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Telefon 1</label>
            <input class="form-control" placeholder="Telefon numaranız" name="phone_1" value="<?= isset($form_error) ? set_value("phone_1") : ""; ?>">
            <?php if (isset($form_error)) { ?>
                <small
                class="float-right input-form-error"> <?= form_error("phone_1"); ?></small>
            <?php } ?>
        </div>
        <div class="form-group col-md-4">
            <label>Telefon 2</label>
            <input class="form-control" placeholder="Diğer telefon numaranız (opsiyonel)" name="phone_2">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Fax 1</label>
            <input class="form-control" placeholder="Fax numaranız"
            name="fax_1">
        </div>
        <div class="form-group col-md-4">
            <label>Fax 2</label>
            <input class="form-control" placeholder="Diğer fax numaranız (opsiyonel)" name="fax_2">
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label class="col-md-4">Site Dili</label>
            <div class="col-md-4">
                <select class="form-control" name="language">
                    <option value="TR">TR (Türkçe/Turkish)</option>
                    <option value="EN">EN (İngilizce/English)</option>
                    <option value="DE">DE (Almanca/German)</option>
                </select>
            </div>
        </div>
    </div>
</div>